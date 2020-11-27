<?php

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy machine your API!
|
*/

Route::middleware('auth:api')->get('/user/info', function (Request $request) {
    return new UserResource($request->user());
});
Route::middleware(['auth:api'])->group(function () {
    
    // レポート
    Route::get('report', 'API\ReportController@index');
    Route::post('report', 'API\ReportController@store');
    Route::get('report/{report}', 'API\ReportController@show');
    Route::put('report/{report}', 'API\ReportController@update');
    Route::delete('report/{report}', 'API\ReportController@destroy');
    Route::put('report/sendback/{report}', 'API\ReportController@sendback');
    Route::post('report/download/', 'API\ReportController@download');
    Route::put('report/{report}/correct', 'API\ReportController@correct');

    Route::get('report/line/selector', 'API\ReportController@lineSelector');

    // 従業員
    Route::get('employee', 'API\EmployeeController@index');
    Route::post('employee', 'API\EmployeeController@store');
    Route::get('employee/{employee}', 'API\EmployeeController@show');
    Route::put('employee/{employee}', 'API\EmployeeController@update');
    Route::delete('employee/{employee}', 'API\EmployeeController@destroy');
    Route::get('employee/selector', 'API\EmployeeController@selector');
    Route::get('employee/full_name', 'API\EmployeeController@fullname');

    // 商品
    Route::get('item', 'API\ItemController@index');
    Route::post('item', 'API\ItemController@store');
    Route::get('item/{item}', 'API\ItemController@show');
    Route::put('item/{item}', 'API\ItemController@update');
    Route::delete('item/{item}', 'API\ItemController@destroy');
    Route::get('item/selector', 'API\ItemController@selector');
    Route::get('lesson/selector', 'API\LessonController@index');
    ////

    Route::get('customer', 'API\CustomerController@index');
    Route::get('customer/{customer_id}', 'API\CustomerController@show');
    Route::post('customer/store', 'API\CustomerController@store');
    Route::delete('customer/{customer_id}', 'API\CustomerController@destroy');
    Route::put('customer/{customer_id}', 'API\CustomerController@update');

    // DailyReport
    Route::get('daily_report', 'API\DailyReportController@index');
    Route::get('daily_report/{daily_report_id}', 'API\DailyReportController@show');
    Route::put('daily_report/{daily_report_id}', 'API\DailyReportController@update');
    Route::get('daily_report/create', 'API\DailyReportController@create');
    Route::post('daily_report/store', 'API\DailyReportController@store');
    Route::delete('daily_report/{daily_report_id}', 'API\DailyReportController@destroy');
    Route::post('daily_report/download', 'API\DailyReportController@download');

    // item
    Route::get('item/search_item', 'API\ItemController@searchItem');
    Route::get('item/get_item_name', 'API\ItemController@getItemName');

    // daily_details
    Route::get('daily_details', 'API\DailyDetailController@index');
    Route::delete('daily_detail/{daily_detail_id}', 'API\DailyDetailController@destroy');

});
