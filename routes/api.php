<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * @author yangsiqi <github.com/Double-R111>
 */
Route::prefix('approval')->namespace('Approval')->group(function () {//审批历史路由组
    Route::get('showall', 'ApproveHistoryController@showAll');//展示所有审批过的表单
    Route::get('searchform', 'ApproveHistoryController@searchForm');//根据表单编号和申请人姓名模糊查询表单
    Route::get('selecttype', 'ApproveHistoryController@selectType');//通过表单类型查询表单
    Route::get('reshowall', 'ApproveHistoryController@reshowAll');//回显表单详情
});

/*
 * @auther ZhongChun <github.com/RobbEr929>
 */
Route::prefix('approval')->namespace('Approval')->group(function () {//审批展示路由组
    Route::get('show','ApprovalController@show');//展示所有待审批表单
    Route::get('classify','ApprovalController@classify');//分类查询待审批表单
    Route::get('select','ApprovalController@select');//根据表单编号和姓名模糊查询表单
    Route::get('reshow','ApprovalController@reShow');//分类回显
});

/**
 * @author Dujingwen <github.com/DJWKK>
 */
Route::prefix('approval')->namespace('Approval')->group(function(){
    Route::get('pass','ExamController@pass');//审核通过
    Route::post('noPass','ExamController@noPass');//审核不通过
});
