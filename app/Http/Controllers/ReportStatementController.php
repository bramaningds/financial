<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportStatementController extends Controller
{


    public function __invoke()
    {

        request()->merge([
            'period_start' => request('period_start') ?? now()->subMonth(5)->format('Y-m'),
            'period_end' => request('period_end') ?? now()->format('Y-m'),
        ]);

        $period_options = collect(DB::select('
            SELECT MONTH(activity_date) AS `month`, YEAR(activity_date) AS `year`
            FROM activities
            GROUP BY `year`, `month`
            ORDER BY `year`, `month`
        '))->mapWithKeys(function ($period) {
            $period = Carbon::parse("{$period->year}-{$period->month}-01");
            $key = $period->format('Y') . '-' . $period->format('m');
            $value = $period->translatedFormat('F Y');

            return [$key => $value];
        });

        $statements = collect(DB::select('
            SELECT A.activity_type, A.category_id, C.name, A.activity_year, A.activity_month, A.mutation
            FROM (
                SELECT activity_type, category_id, YEAR(activity_date) AS activity_year, MONTH(activity_date) AS activity_month, SUM(debit - credit) mutation
                FROM activities
                GROUP BY activity_year, activity_month, activity_type, category_id
                ORDER BY activity_year, activity_month, activity_type, category_id
            ) AS A
            JOIN categories AS C ON C.id = A.category_id
            WHERE activity_year * 100 + activity_month BETWEEN ? AND ?
        ', [
            str_replace('-', '', request('period_start')),
            str_replace('-', '', request('period_end'))
        ]))->map(fn($item) => (object) [
            'activity_type_id' => $item->activity_type == 'income' ? 1 : 2,
            'activity_type' => $item->activity_type,
            'category_id' => $item->category_id,
            'category_name' => $item->name,
            'year' => $item->activity_year,
            'month' => $item->activity_month,
            'month_name' => Carbon::parse("{$item->activity_year}-{$item->activity_month}")->translatedFormat('F'),
            'period' => $item->activity_year * 100 + $item->activity_month,
            'period_string' => Carbon::parse("{$item->activity_year}-{$item->activity_month}")->translatedFormat('F Y'),
            'mutation' => $item->mutation,
            'mutation_string' => money_format($item->mutation, '')
        ]);

        $balances = collect(DB::select('
			SELECT activity_year, activity_month
                 , opening_balance                                           AS `opening_balance`
                 , mutation + opening_balance                                AS `closing_balance`
			FROM (
                SELECT YEAR(activity_date)                                   AS `activity_year`
                     , MONTH(activity_date)                                  AS `activity_month`
                     , SUM(debit - credit)                                   AS `mutation`
                     , (SELECT IFNULL(SUM(debit - credit), 0)
                        FROM activities AS t
                        WHERE TRUE
                        AND (YEAR(activity_date) < activity_year
                            OR (YEAR(activity_date) = activity_year
                                AND MONTH(activity_date) < activity_month))) AS `opening_balance`
                FROM activities
                GROUP BY activity_year, activity_month
                ORDER BY activity_year, activity_month
            ) AS T
        '))->map(fn($item) => (object) [
            ...(array) $item,
            'year_month' => $item->activity_year * 100 + $item->activity_month,
            'opening_balance_string' => money_format($item->opening_balance, ''),
            'closing_balance_string' => money_format($item->closing_balance, ''),
        ])->whereBetween('year_month', [
            str_replace('-', '', request('period_start')),
            str_replace('-', '', request('period_end'))
        ]);

        // dd($balances);

        // dd($statements->groupBy(['activity_type', 'category_name']));

        return view('report-statement', [
            'period_options' => $period_options,
            'statements' => $statements,
            'balances' => $balances,
        ]);
    }
}
