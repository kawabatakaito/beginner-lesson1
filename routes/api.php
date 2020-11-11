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
<<<<<<< HEAD
=======
    Route::post('customer/store', 'API\CustomerController@store');
>>>>>>> 752a138a5cf1ad22a3da12cdccbd09e010a9355a
    Route::delete('customer/{customer_id}', 'API\CustomerController@destroy');

});
