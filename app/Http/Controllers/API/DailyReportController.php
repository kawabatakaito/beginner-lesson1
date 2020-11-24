<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DailyReportForList as DailyReportForListResource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\DailyReport;
use App\DailyDetail;
use App\Item;

    
class DailyReportController extends Controller
{
    public function index(Request $request)
    {
        // $daily_details = DailyDetail::join('daily_reports', 'daily_details.daily_report_id' , '=', 'daily_reports.id')
        // ->select('daily_reports.id', 'daily_reports.line_name', 'daily_reports.worked_on', 'daily_details.item_id', 'daily_details.workers_number', 'daily_details.started_on', 'daily_details.pass_amount', 'daily_details.state')
        // ->get();
        // ↑↑ 基本は同じテーブルのデータを返すので上の書き方はNG--DailyDetail::join

        $from_worked_on = $request->from_worked_on;
        $to_worked_on = $request->to_worked_on;
        $line_name = $request->line_name;
        $item_id = $request->item_id;

        $query = DailyReport::query();
        
        $daily_reports = $query
        // select('daily_reports.*')がないとidカラムが重複してエラーになる
        ->select('daily_reports.*')
        ->join('daily_details', 'daily_reports.id', '=', 'daily_details.daily_report_id')
        ->where('daily_details.item_id', 'like', '%'.$item_id.'%')
        ->where('line_name', 'like', '%'.$line_name.'%')
        ->whereDate('worked_on' , '>=', $from_worked_on)
        ->whereDate('worked_on' , '<=', $to_worked_on)
        ->get();

        foreach ($daily_reports as $daily_report) {
            foreach ($daily_report->daily_details as $daily_detail) {
                // item_nameを取得してdaily_detail->item_nameに代入
                $item = Item::find($daily_detail->item_id);
                $daily_detail->item_name = $item->name;
                //  作業時間を計算してdaily_detail->production_timeに代入
                if($daily_detail->started_on && $daily_detail->finished_on){
                    $daily_detail->production_time = gmdate("H:i", (strtotime($daily_detail->finished_on) - strtotime($daily_detail->started_on)));
                } else {
                    $daily_detail->production_time = '未入力';
                }
            }
        }
        
        return DailyReportForListResource::collection($daily_reports);
    }

    public function show($id)
    {
            // daily_detailsのデータのみを取得
                // return DailyReport::find($id)->daily_details;
            // daily_detailsの全データも取得してしまう
                // return DailyReport::find($id)->with('daily_details')->get();
        $daily_reports = DailyReport::with('daily_details')->find($id);
        // $item = Item::find($daily_report->item_id);
        // $daily_report->item_code = $item->code;
        // $daily_report->item_name = $item->name;
        return $daily_reports;
    }

    public function store(Request $request)
    {
        $daily_report = DB::transaction(function() use ($request) {
            // daily_report
            $daily_report = new DailyReport;
            $daily_report->line_name = $request->daily_report['line_name'];
            $daily_report->worked_on = $request->daily_report['worked_on'];
            $daily_report->save();

            // daily_details
            foreach ($request->daily_report['daily_details'] as $daily_detail) {
                $daily_detail = $daily_report->daily_details()->create($daily_detail);
            }
            return $daily_report;
        });
    }

    public function destroy($id)
    {
        $daily_report = DB::transaction(function() use ($id) {
            $daily_report = DailyReport::find($id);
            if ($daily_report->daily_details()->delete()) {
                if ($daily_report->delete()){
                    return;
                }
            }
        return;
    });
    }

    public function update(Request $request, $id)
    {
        $daily_report = DB::transaction(function() use ($request, $id) {
            // daily_report
            $daily_report = DailyReport::find($id);
            $daily_report->line_name = $request->daily_report['line_name'];
            $daily_report->worked_on = $request->daily_report['worked_on'];
            $daily_report->update();

            foreach ($request->daily_report['daily_details'] as $daily_detail) {
                if ($daily_detail['id']) {
                        $daily_report->daily_details()->where('id', $daily_detail['id'])->update($daily_detail);
                } else {
                    $daily_report->daily_details()->create($daily_detail);
                }
            }
            return $daily_report;
        });
    }


}