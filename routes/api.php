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
// header('Access-Control-Allow-Origin:*');

//fastdfs
Route::get('fastdfsClientVersion','FastdfsController@fastdfsClientVersion');
Route::get('getFileInfo','FastdfsController@getFileInfo');
Route::get('fileExist','FastdfsController@fileExist');
Route::post('uploadFile','FastdfsController@uploadFile');
Route::post('deleteFile','FastdfsController@deleteFile');
Route::post('setMetadata','FastdfsController@setMetadata');
Route::get('getMetadata','FastdfsController@getMetadata');
Route::post('downloadFile','FastdfsController@downloadFile');