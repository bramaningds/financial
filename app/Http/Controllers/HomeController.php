<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $monthly_activities = collect(DB::select('
			SELECT *, mutation + opening_balance AS closing_balance
			FROM (
                SELECT YEAR(activity_date)                                   AS activity_year
                     , MONTH(activity_date)                                  AS activity_month
                     , SUM(debit)                                            AS debit
                     , SUM(credit)                                           AS credit
                     , SUM(debit - credit)                                   AS mutation
                     , (SELECT IFNULL(SUM(debit - credit), 0)
                        FROM activities AS t
                        WHERE TRUE
                        AND (YEAR(activity_date) < activity_year
                            OR (YEAR(activity_date) = activity_year
                                AND MONTH(activity_date) < activity_month))) AS opening_balance
                FROM activities
                GROUP BY activity_year, activity_month
                ORDER BY activity_year, activity_month
            ) AS T
        '));

        $this_month = $monthly_activities->where('activity_year', date('Y'))->where('activity_month', date('m'))->first();
        $last_month = $monthly_activities->where('activity_year', date('Y'))->where('activity_month', date('m') - 1)->first();
        $except_this_month = $monthly_activities->reject(fn($item) => $item == $this_month);
        $last_6_month = $monthly_activities->where(function ($activity) {
            return $activity->activity_year >= now()->subMonth(6)->year
                && $activity->activity_month >= now()->subMonth(6)->month;
        });

        $average = [
            'balance' => $except_this_month->avg('closing_balance'),
            'income' => $except_this_month->avg('debit'),
            'expense' => $except_this_month->avg('credit'),
            'mutation' => $except_this_month->avg('mutation'),
        ];

        $balance = [
            'this_month' => $this_month->closing_balance ?? $monthly_activities->last()->closing_balance ?? 0,
            'last_month' => $this_month->opening_balance ?? $monthly_activities->last()->closing_balance ?? 0,
            'average' => $average['balance'],
        ];
        $balance = array_merge($balance, [
            'from_last_month' => $balance['this_month'] - $balance['last_month'],
            'from_average' => $balance['this_month'] - $balance['average'],
            'status' => $this->makeStatus($balance['this_month'] >= $balance['last_month'], $balance['this_month'] >= $balance['average']),
        ]);

        $income = [
            'this_month' => $this_month->debit ?? 0,
            'last_month' => $last_month->debit ?? 0,
            'average' => $except_this_month->avg('debit'),
        ];
        $income = array_merge($income, [
            'from_last_month' => $income['this_month'] - $income['last_month'],
            'from_average' => $income['this_month'] - $income['average'],
            'status' => $this->makeStatus($income['this_month'] >= $income['last_month'], $income['this_month'] >= $income['average']),
        ]);

        $expense = [
            'this_month' => $this_month->credit ?? 0,
            'last_month' => $last_month->credit ?? 0,
            'average' => $except_this_month->avg('credit'),
        ];
        $expense = array_merge($expense, [
            'from_last_month' => $expense['this_month'] - $expense['last_month'],
            'from_average' => $expense['this_month'] - $expense['average'],
            'status' => $this->makeStatus($expense['this_month'] < $expense['last_month'], $expense['this_month'] < $expense['average']),
        ]);

        $mutation = [
            'this_month' => $this_month->mutation ?? 0,
            'last_month' => $last_month->mutation ?? 0,
            'average' => $except_this_month->avg('mutation'),
        ];
        $mutation = array_merge($mutation, [
            'from_last_month' => $mutation['this_month'] - $mutation['last_month'],
            'from_average' => $mutation['this_month'] - $mutation['average'],
            'status' => $this->makeStatus($mutation['this_month'] >= $mutation['last_month'], $mutation['this_month'] >= $mutation['average']),
        ]);

        $months = [
            1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni",
            7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember",
        ];

        $years = $monthly_activities->pluck('activity_year')->unique()->values();

        $this_month_activities = Activity::with('category')->thisMonth()->get();
        $this_month_expense_by_category = $this_month_activities->groupBy('category_id')->map(fn($activities) => [
            'category' => $activities->first()->category->name,
            'total' => $activities->sum('credit'),
        ])->values();

        $last_activities = [
            'income' => Activity::with('category', 'account')->isIncome()->limit(5)->orderBy('activity_date', 'desc')->orderBy('id', 'desc')->get(),
            'expense' => Activity::with('category', 'account')->isExpense()->limit(5)->orderBy('activity_date', 'desc')->orderBy('id', 'desc')->get(),
        ];
        $accounts = Account::all();

        // return dd($balance);

        return view('home', compact(
            'last_6_month', 'last_activities',
            'monthly_activities', 'accounts', 'balance', 'income', 'expense', 'mutation', 'this_month_activities', 'months', 'years',
            'this_month_expense_by_category',
        ));
    }

    private function makeStatus($condition_1, $condition_2)
    {
        if ($condition_1 && $condition_2) {
            return 'success';
        } elseif ($condition_1 || $condition_2) {
            return 'warning';
        } else {
            return 'danger';
        }
    }
}
