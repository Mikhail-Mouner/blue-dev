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


Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'course'], function () {
    ######################## get all remain && Add && Delete Coures ########################
    Route::get('/remain', 'HomeController@remainCourses')->name('remainCourses');
    Route::post('/add', 'HomeController@addCourse')->name('addCourse');
    Route::delete('/delete/{id}', 'HomeController@deleteCourse')->name('deleteCourse');
    ######################## end get all remain && Add && Delete Coures ########################
});

Auth::routes(['verify'=>true]);



Route::group(['prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
        Route::get('/login', 'AdminController@getLogin')->name('admin.getLogin'); 
        Route::post('/login', 'AdminController@login')->name('admin.login'); 
    });
    
    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
        ######################## Dashboard Routes ########################
        Route::get('/', function () { return redirect()->route('admin.course.index'); })->name('admin.home'); 
        ######################## /Dashboard Routes ########################
        
        ######################## courses Routes ########################
        
        Route::group(['prefix' => 'course'], function () {
            Route::get('',  'CourseController@index'  )->name('admin.course.index'); 
            Route::post('', 'CourseController@store' )->name('admin.course.store'); 
            Route::delete('/{id}', 'CourseController@destroy' )->name('admin.course.destroy');
            Route::post('/update', 'CourseController@update' )->name('admin.course.update'); 
        });
        ######################## /courses Routes ########################
        

    });
});