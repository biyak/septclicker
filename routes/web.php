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

Auth::routes();

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

Route::get('/studenthome', 'HomeController@index')->name('Home');

Route::get('/quizlist', 'QuizListController@index')->name('QuizList');

Route::get('/quiztest', 'QuizTestController@index')->name('QuizTest');

Route::get('/prlist', 'PRListController@index')->name('PRList');

Route::get('/peerreview', 'PeerReviewController@index')->name('PeerReview');

Route::get('/quizinteractive', 'QuizInteractiveController@index')->name('QuizInteractive');

Route::get('/instructorhome', 'InstructorHomeController@index')->name('InstructorHome');

Route::get('/instructorquizlist/{user}', 'InstructorQuizListController@index')->name('instructorquizlist.show');

Route::get('/instructorprlist', 'InstructorPRListController@index')->name('InstructorPRList');

Route::get('/createquiz', 'CreateQuizController@index')->name('CreateQuiz');

Route::get('/createpr', 'CreatePRController@index')->name('CreatePR');

//Creating and displaying quizzes!
Route::get('/q/create', 'QuizController@create');
Route::post('/q', 'QuizController@store');

Route::get('/q/{quiz}', 'QuizController@show');

Route::get('/testbank', 'TestBankController@index')->name('TestBank');

Route::get('midterm1', 'Midterm1Controller@index')->name('M1');