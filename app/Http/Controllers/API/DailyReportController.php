<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\DailyReport;
use App\DailyDetail;

class DailyReportController extends Controller
{
    public function index()
    {
        $daily_details = DailyDetail::join('daily_reports', 'daily_details.daily_report_id' , '=', 'daily_reports.id')
        ->select('daily_reports.id', 'daily_reports.line_name', 'daily_reports.worked_on', 'daily_details.item_id', 'daily_details.workers_number', 'daily_details.started_on', 'daily_details.pass_amount', 'daily_details.state')
        ->get();
        return $daily_details;
    }

    public function show($id)
    {
            // daily_detailsのデータのみを取得
            // return DailyReport::find($id)->daily_details;
            // daily_detailsの全データも取得してしまう
            // return DailyReport::find($id)->with('daily_details')->get();
        return DailyReport::with('daily_details')->find($id);
    }

    public function store(Request $request)
    {
        // daily_report
        $daily_report = new DailyReport();
        $daily_report->line_name = $request->line_name;
        $daily_report->worked_on = $request->worked_on;
        if ($daily_report->save()){
            // daily_details
            $daily_detail = new DailyDetail();
            $daily_detail->daily_report_id = $daily_report->id;
            $daily_detail->item_id = $request->item_id;
            $daily_detail->employee_id = $request->employee_id;
            $daily_detail->is_oxygen_scavenger = $request->is_oxygen_scavenger;
            $daily_detail->is_packaging_material = $request->is_packaging_material;
            $daily_detail->is_filling_gas = $request->is_filling_gas;
            $daily_detail->workers_number = $request->workers_number;
            $daily_detail->start_metal_detector_fe_check = $request->start_metal_detector_fe_check;
            $daily_detail->start_metal_detector_sus_check = $request->start_metal_detector_sus_check;
            $daily_detail->start_x_detector_fe_check = $request->start_x_detector_fe_check;
            $daily_detail->start_x_detector_sus_check = $request->start_x_detector_sus_check;
            $daily_detail->start_x_detector_gi_check = $request->start_x_detector_gi_check;
            $daily_detail->start_x_detector_pvc_check = $request->start_x_detector_pvc_check;
            $daily_detail->started_on = $request->started_on;
            $daily_detail->finished_on = $request->finished_on;
            $daily_detail->pass_amount = $request->pass_amount;
            $daily_detail->repack_amount = $request->repack_amount;
            $daily_detail->lightweight = $request->lightweight;
            $daily_detail->appearance = $request->appearance;
            $daily_detail->metal_removal = $request->metal_removal;
            $daily_detail->x_removal = $request->x_removal;
            $daily_detail->stop_metal_detector_fe_check = $request->stop_metal_detector_fe_check;
            $daily_detail->stop_metal_detector_sus_check = $request->stop_metal_detector_sus_check;
            $daily_detail->stop_x_detector_fe_check = $request->stop_x_detector_fe_check;
            $daily_detail->stop_x_detector_sus_check = $request->stop_x_detector_sus_check;
            $daily_detail->stop_x_detector_gi_check = $request->stop_x_detector_gi_check;
            $daily_detail->stop_x_detector_pvc_check = $request->stop_x_detector_pvc_check;
            $daily_detail->state = $request->state;
            $daily_detail->is_finished = $request->is_finished;
            if ($daily_detail->save()){
                return;
            } else {
                return redirect('daily_report.create');
            }
        } else {
            return redirect('daily_report.create');
        }
    }

    public function store2(Request $request)
    {
        $daily_report = DB::transaction(function() use ($request) {
            // daily_report
            $daily_report = new DailyReport;
            $daily_report->line_name = $request->daily_report['line_name'];
            $daily_report->worked_on = $request->daily_report['worked_on'];
            $daily_report->save();

            // daily_details
            foreach ($request->daily_report['daily_details'] as $daily_detail) {
                $daily_detail = $daily_report->daily_details()->create([
                    'item_id'                 => $daily_detail['item_id'],
                    'employee_id'             => $daily_detail['employee_id'],
                    'is_oxygen_scavenger'     => $daily_detail['is_oxygen_scavenger'],
                    'is_packaging_material'   => $daily_detail['is_packaging_material'],
                    'is_filling_gas'          => $daily_detail['is_filling_gas'],
                    'workers_number'          => $daily_detail['workers_number'],
                    'start_metal_detector_fe_check'  => $daily_detail['start_metal_detector_fe_check'],
                    'start_metal_detector_sus_check' => $daily_detail['start_metal_detector_sus_check'],
                    'start_x_detector_fe_check'      => $daily_detail['start_x_detector_fe_check'],
                    'start_x_detector_sus_check'     => $daily_detail['start_x_detector_sus_check'],
                    'start_x_detector_gi_check'      => $daily_detail['start_x_detector_gi_check'],
                    'start_x_detector_pvc_check'     => $daily_detail['start_x_detector_pvc_check'],
                    'started_on'     => $daily_detail['started_on'],
                    'finished_on'    => $daily_detail['finished_on'],
                    'pass_amount'    => $daily_detail['pass_amount'],
                    'repack_amount'  => $daily_detail['repack_amount'],
                    'lightweight'    => $daily_detail['lightweight'],
                    'appearance'     => $daily_detail['appearance'],
                    'metal_removal'  => $daily_detail['metal_removal'],
                    'x_removal'      => $daily_detail['x_removal'],
                    'stop_metal_detector_fe_check'  => $daily_detail['stop_metal_detector_fe_check'],
                    'stop_metal_detector_sus_check' => $daily_detail['stop_metal_detector_sus_check'],
                    'stop_x_detector_fe_check'      => $daily_detail['stop_x_detector_fe_check'],
                    'stop_x_detector_sus_check'     => $daily_detail['stop_x_detector_sus_check'],
                    'stop_x_detector_gi_check'      => $daily_detail['stop_x_detector_gi_check'],
                    'stop_x_detector_pvc_check'     => $daily_detail['stop_x_detector_pvc_check'],
                    'state'       => $daily_detail['state'],
                    'is_finished' => $daily_detail['is_finished'],
                ]);
            }
            return $daily_report;
        });
    }

    public function destroy($id)
    {
        $daily_report = DailyReport::find($id);
        if ($daily_report->daily_detail->delete()) {
            if ($daily_report->delete()){
                return;
            }
        }
    }

    public function update(Request $request, $id)
    {
        $daily_report = DB::transaction(function() use ($request, $id) {
            // daily_report
            $daily_report = DailyReport::find($id);
            $daily_report->line_name = $request->daily_report['line_name'];
            $daily_report->worked_on = $request->daily_report['worked_on'];
            // $daily_report['daily_details'] = $request->daily_report['daily_details'];
            $daily_report->save();


            foreach ($request->daily_report['daily_details'] as $daily_detail) {
                // $daily_report->daily_details()->saveMany(new DailyDetail($request->daily_report['daily_details']));
                $daily_report->daily_details()->update(new DailyDetail($daily_detail));
            }


            // $daily_report->refresh();

            // 新規に保存したコメントを含む、全コメント
            // $daily_report->daily_details;

            

            // $daily_report->daily_details()->saveMany($daily_details);

            // foreach ($request->daily_report['daily_details'] as $daily_detail) {
            //     $daily_detail = $daily_report->daily_details()->save([
            //         'item_id'                 => $daily_detail['item_id'],
            //         'employee_id'             => $daily_detail['employee_id'],
            //         'is_oxygen_scavenger'     => $daily_detail['is_oxygen_scavenger'],
            //         'is_packaging_material'   => $daily_detail['is_packaging_material'],
            //         'is_filling_gas'          => $daily_detail['is_filling_gas'],
            //         'workers_number'          => $daily_detail['workers_number'],
            //         'start_metal_detector_fe_check'  => $daily_detail['start_metal_detector_fe_check'],
            //         'start_metal_detector_sus_check' => $daily_detail['start_metal_detector_sus_check'],
            //         'start_x_detector_fe_check'      => $daily_detail['start_x_detector_fe_check'],
            //         'start_x_detector_sus_check'     => $daily_detail['start_x_detector_sus_check'],
            //         'start_x_detector_gi_check'      => $daily_detail['start_x_detector_gi_check'],
            //         'start_x_detector_pvc_check'     => $daily_detail['start_x_detector_pvc_check'],
            //         'started_on'     => $daily_detail['started_on'],
            //         'finished_on'    => $daily_detail['finished_on'],
            //         'pass_amount'    => $daily_detail['pass_amount'],
            //         'repack_amount'  => $daily_detail['repack_amount'],
            //         'lightweight'    => $daily_detail['lightweight'],
            //         'appearance'     => $daily_detail['appearance'],
            //         'metal_removal'  => $daily_detail['metal_removal'],
            //         'x_removal'      => $daily_detail['x_removal'],
            //         'stop_metal_detector_fe_check'  => $daily_detail['stop_metal_detector_fe_check'],
            //         'stop_metal_detector_sus_check' => $daily_detail['stop_metal_detector_sus_check'],
            //         'stop_x_detector_fe_check'      => $daily_detail['stop_x_detector_fe_check'],
            //         'stop_x_detector_sus_check'     => $daily_detail['stop_x_detector_sus_check'],
            //         'stop_x_detector_gi_check'      => $daily_detail['stop_x_detector_gi_check'],
            //         'stop_x_detector_pvc_check'     => $daily_detail['stop_x_detector_pvc_check'],
            //         'state'       => $daily_detail['state'],
            //         'is_finished' => $daily_detail['is_finished'],
            //     ]);
            // }
            return $daily_report;
        });
    }
}