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
        $item_id = $request->item_id;
        $line_name = $request->line_name;
        $from_worked_on = $request->from_worked_on;
        $to_worked_on = $request->to_worked_on;

        $daily_reports = DailyReport::join('daily_details', 'daily_reports.id', '=', 'daily_details.daily_report_id')
        ->when($item_id, function ($query) use ($item_id) {
            return $query->where('daily_details.item_id', '=', $item_id);
        })
        ->when($line_name, function ($query) use ($line_name) {
            return $query->where('line_name', 'like', '%'.$line_name.'%');
        })
        ->when($from_worked_on, function ($query) use ($from_worked_on) {
            return $query->whereDate('worked_on' , '>=', $from_worked_on);
        })
        ->when($to_worked_on, function ($query) use ($to_worked_on) {
            return $query->whereDate('worked_on' , '<=', $to_worked_on);
        })
        ->groupBy('daily_details.daily_report_id')
        ->select('daily_reports.*')
        ->get();
        
        foreach ($daily_reports as $daily_report) {
            foreach ($daily_report->daily_details as $daily_detail) {
                $daily_detail->line_name = $daily_report->line_name;
                $daily_detail->worked_on = $daily_report->worked_on;
                // item_nameを取得
                $item = Item::find($daily_detail->item_id);
                if ($item) {
                    $daily_detail->item_name = $item->name;
                } else {
                    $daily_detail->item_name = 'NoData(item_id:'.$daily_detail->item_id.')';
                }
                //  作業時間を計算
                if ($daily_detail->started_on && $daily_detail->finished_on) {
                    $daily_detail->production_time = gmdate("H:i", (strtotime($daily_detail->finished_on) - strtotime($daily_detail->started_on)));
                } else {
                    $daily_detail->production_time = '-';
                }
            }
        }
        return DailyReportForListResource::collection($daily_reports);
    }

    public function show($id)
    {
        $daily_report = DailyReport::with('daily_details')->find($id);
        foreach ($daily_report->daily_details as $daily_detail) {
            // item_nameを取得
            $item = Item::find($daily_detail->item_id);
            if ($item) {
                $daily_detail->item_name = $item->name;
                $daily_detail->item_code = $item->code;
            } else {
                $daily_detail->item_name = 'deleted item(item_id:'.$daily_detail->item_id.')';
                $daily_detail->item_code = 'deleted item(item_id:'.$daily_detail->item_id.')';
            }
        }
        return $daily_report;
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

    public function download(Request $request)
    {
        $report = $request->report;

        echo '包装ライン日報';
        echo "\n"."\n";
        echo 'ライン'."\t".$report['line_name']."\t".'号機';
        echo "\n";
        echo '作業日'."\t".$report['worked_on'];
        echo "\n"."\n"."\n";

        foreach($report['daily_details'] as $detail) {
            echo '品番'."\t".$detail['item_id']."\t"."\t".'担当者'."\t".$detail['employee_id'];
            echo "\n"."\n";

            echo '脱酸素剤'."\t".$detail['is_oxygen_scavenger'];
            echo "\n";
            echo '包装材料'."\t".$detail['is_packaging_material'];
            echo "\n";
            echo '充填ガス'."\t".$detail['is_filling_gas'];
            echo "\n";
            echo '作業員数'."\t".$detail['workers_number'];
            echo "\n";

            echo "\n"."\n";
        }

        return;

    }


}