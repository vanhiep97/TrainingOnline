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
Route::group(['namespace' => 'Api'], function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'AuthController@login');
    Route::post('forgotPassword', 'ForgotPasswordController@getCodeVerify');
    Route::post('set-new-password', 'ForgotPasswordController@resetPassword');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('users', 'UserController@users');
        Route::post('changePwd', 'UserController@changePwd');
        Route::post('updateProfile', 'UserController@updateProfile');
        Route::post('logout', 'AuthController@logout');
        Route::get('courses', 'CourseController@index');
        Route::get('coursed-register', 'CourseController@coursedRegister');
        Route::post('createCourse', 'CourseController@store');
        Route::post('updateCourse/{id}', 'CourseController@update');
        Route::post('deleteCourse/{id}', 'CourseController@destroy');
        Route::get('showCourse/{id}', 'CourseController@show');
        Route::post('createLesson', 'LessonController@create');
        Route::post('updateLesson/{id}', 'LessonController@update');
        Route::post('deleteLesson/{id}', 'LessonController@destroy');
        Route::post('feedbackCourse', 'FeedbackController@feedbackCourse');
        Route::post('feedbackLesson', 'FeedbackController@feedbackLesson');
        Route::get('getFeedback', 'FeedbackController@getFeedback');
    });
});
