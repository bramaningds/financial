<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportExpenseController extends Controller
{

    public function __invoke()
    {
        request()->merge([
            'period_start' => request('period_start') ?? now()->subMonth(6)->format('Y-m'),
            'period_end' => request('period_end') ?? now()->format('Y-m'),
        ]);

        $periodOptions = collect(DB::select('
            SELECT MONTH(activity_date) AS `month`, YEAR(activity_date) AS `year`
            FROM activities
            GROUP BY `year`, `month`
            ORDER BY `year`, `month`
        '))->mapWithKeys(function($period) {
            $period = Carbon::parse("{$period->year}-{$period->month}-01");
            $key = $period->format('Y') . '-' . $period->format('m');
            $value = $period->translatedFormat('F Y');
            
            return [$key => $value];
        });

        $statement = collect(DB::select('
            SELECT A.activity_type, C.name, A.activity_year, A.activity_month, A.mutation
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
        ]));

        return $statement;
        return view('report-expense');
    }
}
