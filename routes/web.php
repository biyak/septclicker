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

Route::get('/quizlist/{user}', 'QuizListController@index')->name('QuizList');

Route::get('/quiztest', 'QuizTestController@index')->name('QuizTest');

Route::get('/prlist', 'PRListController@index')->name('PRList');

Route::get('/peerreview', 'PeerReviewController@index')->name('PeerReview');

Route::get('/quizinteractive', 'QuizInteractiveController@index')->name('QuizInteractive');

Route::get('/instructor/home', 'InstructorHomeController@index')->name('InstructorHome');


Route::group(['prefix' => 'instructor'], function () {
  Route::get('/login', 'InstructorAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'InstructorAuth\LoginController@login');
  Route::post('/logout', 'InstructorAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'InstructorAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'InstructorAuth\RegisterController@register');

  Route::post('/password/email', 'InstructorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'InstructorAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'InstructorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'InstructorAuth\ResetPasswordController@showResetForm');

  Route::get('quizlist/{user}', 'InstructorQuizListController@index')->name('instructorquizlist.show');


//Creating and displaying questions
Route::get('{quiz}/question/create', 'QuestionController@create');
Route::post('{quiz}/question', 'QuestionController@store');
Route::get('question/{question}/q', 'QuestionController@show');

//Editing question
Route::get('question/{question}/edit', 'QuestionController@edit')->name('{question}.edit');
Route::patch('question/{question}/q', 'QuestionController@update')->name('{question}.update');

  Route::get('/instructorprlist', 'InstructorPRListController@index')->name('InstructorPRList');

  Route::get('/createpr', 'CreatePRController@index')->name('CreatePR');

Route::get('midterm1', 'Midterm1Controller@index')->name('M1');

//Displaying quizzes for students
Route::get('/active/{quiz}/conf', 'ActiveQuizController@create')->name('ActiveQuiz');
Route::get('/active/{quiz}/show', 'ActiveQuizController@show')->name('ActiveQuiz');
Route::post('/active', 'QuizController@store');

  //Creating and displaying quizzes!
  Route::get('/q/create', 'QuizController@create');
  Route::post('/q', 'QuizController@store');
  Route::get('/q/{quiz}', 'QuizController@show');

  //Editing quiz
  Route::get('/q/{quiz}/edit', 'QuizController@edit')->name('{quiz}.edit');
  Route::patch('/q/{quiz}/', 'QuizController@update')->name('{quiz}.update');

  //Creating and displaying questions
  Route::get('{quiz}/question/create', 'TFQuestionController@create');
  Route::post('{quiz}/question', 'TFQuestionController@store');

  Route::get('/testbank', 'TestBankController@index')->name('TestBank');

  Route::get('midterm1', 'Midterm1Controller@index')->name('M1');
});

Route::group(['prefix' => 'student'], function () {
  Route::get('/login', 'StudentAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'StudentAuth\LoginController@login');
  Route::post('/logout', 'StudentAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'StudentAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'StudentAuth\RegisterController@register');

  Route::post('/password/email', 'StudentAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'StudentAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'StudentAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'StudentAuth\ResetPasswordController@showResetForm');
});
