<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dailies;
use App\Daily_detail;

class DailiesController extends Controller
{
    public function index()
    {
        return Dailies::all();
    }

    public function store(Request $request)
    {
        // dailies
        $dailies = new Dailies();
        $dailies->line_name = $request->line_name;
        $dailies->worked_on = $request->worked_on;
        if ($dailies->save()){
            // daily_details
            $daily_detail = new Daily_detail();
            $daily_detail->product_dailies_id = $dailies->id;
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
                return redirect('daily.create');
            }
        } else {
            return redirect('daily.create');
        }
    }
}
