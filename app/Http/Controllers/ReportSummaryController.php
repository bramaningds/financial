<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportSummaryController extends Controller
{

    public function __invoke()
    {
        request()->merge([
            'period_start' => request('period_start') ?? now()->subMonth(6)->format('Y-m'),
            'period_end' => request('period_end') ?? now()->format('Y-m'),
        ]);

        $period_options = collect(DB::select('
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

        $summary = collect(DB::select('
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
            WHERE activity_year * 100 + activity_month BETWEEN ? AND ?
        ', [
            str_replace('-', '', request('period_start')), 
            str_replace('-', '', request('period_end'))
        ]));

        return view('report-summary', [
            'summary' => $summary,
            'period_options' => $period_options,
            'period_start' => Carbon::parse(request('period_start', now()->subMonth(6)->toDateString()))->translatedFormat('F Y'),
            'period_end' => Carbon::parse(request('period_end', now()->toDateString()))->translatedFormat('F Y'),
        ]);
    }
}
