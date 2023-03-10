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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout');
/*
Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/pages', 'Admin\PagesController');
Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
    'index', 'show', 'destroy'
]);
Route::resource('admin/settings', 'Admin\SettingsController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

Route::resource('admin/maindata', 'Admin\\maindataController');
Route::resource('admin/cartype', 'Admin\\cartypeController');
Route::resource('admin/transaction', 'Admin\\transactionController');
Route::resource('admin/history', 'Admin\\HistoryController');
Route::resource('admin/attachment', 'Admin\\attachmentController');
*/
Route::get('/add', 'MainDataController@add');
Route::post('/insert', 'MainDataController@insert');
Route::get('/listing', 'MainDataController@listing');
Route::get('/delete/{id}', 'MainDataController@destroy');
Route::get('/detail/{id}', 'MainDataController@detail');
Route::post('/insertTransectionNext', 'TransectionController@insertnext');
Route::post('/edittransection', 'TransectionController@edittransection');
Route::get('/updatetransection','UpdateTransectionController@updatetransection');
Route::get('/deletetransection/{id}','TransectionController@delete');
Route::get('/usermanager','StaffController@index');
Route::post('/adduser', 'StaffController@adduser');
Route::post('/edituser', 'StaffController@edituser');
Route::post('/editmaindata', 'MainDataController@editmaindata');
Route::get('/checkdupcode/{code}', 'MainDataController@checkcode');
Route::get('/countdata/{type}', 'MainDataController@countdata');
Route::get('/history/{type}', 'MainDataController@history');
Route::get('/owed', 'MainDataController@owed');
Route::get('/report', 'MainDataController@report');

//------ สำหรับป้องกันการเข้าผ่าน get error
//Route::get('/updatetransection',function(){return redirect('/home');});
Route::get('/insert',function(){return redirect('/home');});
Route::get('/insertTransectionNext',function(){return redirect('/home');});
Route::get('/edittransection',function(){return redirect('/home');});
Route::get('/editmaindata',function(){return redirect('/home');});
Route::get('/adduser',function(){return redirect('/home');});
Route::get('/edituser',function(){return redirect('/home');});

Route::get('/note', 'noteController@index');
Route::post('/editnote', 'noteController@editnote');
Route::post('/addnote', 'noteController@addnote');
Route::post('/shownote', 'noteController@shownote');
Route::get('/delnote/{id}', 'noteController@delnote');