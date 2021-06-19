<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->guest('login');
});

Auth::routes();


Route::group(['middleware' => ['auth', 'subscriber', 'active']], function () {
    Route::get('/member-dashboard', 'DashboardController@member_dashboard')->name('member_dashboard');
    Route::get('/attempt-exam/{id}', 'ExamAttemptController@index')->name('exam_attempt');
    Route::get('/get-questions/{id}', 'ExamAttemptController@get_questions');
    Route::get('/update-score/{id}/{score}', 'ExamAttemptController@update_score');
    Route::get('/get-score-chart', 'DashboardController@get_score_chart')->name('get_score_chart');
    Route::get('/get-subcategory-based-on-category/{id}', 'CategoryController@get_cat_based_subcats')->name('get_cat_based_subcat');
    Route::get('/filter-category', 'ExamController@filter_exam')->name('filter_exam');
});

Route::group(['middleware' => ['auth', 'admin', 'active']], function() {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::get('/all-exams', 'ExamController@all_exams')->name('all_exams');
    Route::get('/create-exam', 'ExamController@create_exam')->name('create_exam');
    Route::post('/create-exam', 'ExamController@store_exam')->name('store_exam');
    Route::delete('/create-exam/{id}', 'ExamController@destroy_exam')->name('delete_exam');

    Route::get('/all-users', 'UserController@index')->name('all_users');
    Route::get('/change-status/{id}/{status}', 'UserController@change_status')->name('change_status');
    Route::delete('/delete-user/{id}','UserController@destroy_user')->name('destroy_user');

    Route::get('/all-categories', 'CategoryController@index')->name('all_categories');
    Route::post('/create-category', 'CategoryController@create_category')->name('create_category');

    Route::get('/all-subcategories', 'CategoryController@all_subcategories')->name('all_subcategories');
    Route::post('/create-subcategory', 'CategoryController@create_subcategory')->name('create_subcategory');
});