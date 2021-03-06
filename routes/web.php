<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app/listing', 'Apps\ListingController@index');
Route::get('/app/disc', 'Apps\DiscController@index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('kpi/form-department', 'Admin\Kpi\FormDepartmentController@index');
    Route::get('kpi/form-department/detail', 'Admin\Kpi\FormDepartmentController@detail');
    Route::get('kpi/form-department/create', 'Admin\Kpi\FormDepartmentController@create');
    Route::post('kpi/form-department/save', 'Admin\Kpi\FormDepartmentController@save');
    Route::get('kpi/form-department/edit', 'Admin\Kpi\FormDepartmentController@edit');
    Route::post('kpi/form-department/update', 'Admin\Kpi\FormDepartmentController@update');
    Route::delete('kpi/form-department/cancel/{id}', 'Admin\Kpi\FormDepartmentController@cancel');

    Route::get('kpi/form-department/report', 'Admin\Kpi\FormDepartmentController@report');
    Route::get('kpi/form-department/modal_value_notes', 'Admin\Kpi\FormDepartmentController@modal_value_notes');

    Route::get('kpi/form-employee', 'Admin\Kpi\FormEmployeeController@index');
    Route::get('kpi/form-employee/create', 'Admin\Kpi\FormEmployeeController@create');
    Route::post('kpi/form-employee/save', 'Admin\Kpi\FormEmployeeController@save');
    Route::get('kpi/form-employee/edit', 'Admin\Kpi\FormEmployeeController@edit');
    Route::post('kpi/form-employee/update', 'Admin\Kpi\FormEmployeeController@update');
    Route::get('kpi/form-employee/modal_value_notes', 'Admin\Kpi\FormEmployeeController@modal_value_notes');

    Route::get('rekers/rpt/key', 'Admin\Reker\RekerController@rpt_key');
    Route::get('rekers/{id}/detail_card', 'Admin\Reker\RekerController@detail_card');

    Route::get('reker-routines/rpt/key', 'Admin\Reker\RekerRoutineController@rpt_key');
    Route::get('reker-routines/{id}/detail_card', 'Admin\Reker\RekerRoutineController@detail_card');
});
