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

//Route::get('/studenthome', 'HomeController@index')->name('Home');

Route::get('/quizlist/{user}', 'QuizListController@index')->name('QuizList');

Route::get('/quiztest', 'QuizTestController@index')->name('QuizTest');

Route::get('/prlist', 'PRListController@index')->name('PRList');

Route::get('/peerreview', 'PeerReviewController@index')->name('PeerReview');

//Route::get('/quizinteractive', 'QuizInteractiveController@index')->name('QuizInteractive');

Route::get('/instructorhome', 'InstructorHomeController@index')->name('InstructorHome');

Route::get('/instructorquizlist/{user}', 'InstructorQuizListController@index')->name('instructorquizlist.show');

Route::get('/instructorprlist', 'InstructorPRListController@index')->name('InstructorPRList');

Route::get('/createpr', 'CreatePRController@index')->name('CreatePR');

//Creating and displaying quizzes!
Route::get('/q/{quiz}/launch', 'QuizController@launch')->name('{quiz}.launch');
Route::get('/q/create', 'QuizController@create');
Route::post('/q', 'QuizController@store');
Route::get('/q/{quiz}', 'QuizController@show');

//Editing quiz
Route::get('/q/{quiz}/edit', 'QuizController@edit')->name('{quiz}.edit');
Route::patch('/q/{quiz}/', 'QuizController@update')->name('{quiz}.update');


//Creating and displaying questions
Route::get('{quiz}/question/create', 'QuestionController@create');
Route::post('{quiz}/question', 'QuestionController@store');
Route::get('{quiz}/question/{question}', 'QuestionController@show');

//Editing question
Route::get('{quiz}/question/{question}/edit', 'QuestionController@edit')->name('{question}.edit');
Route::patch('{quiz}/question/{question}', 'QuestionController@update')->name('{question}.update');

//Live quizzes
Route::get('{quiz}/question/{question}/live', 'SubmittedQuestionController@live')->name('{question}.live');
Route::post('{quiz}/question/{question}', 'SubmittedQuestionController@store')->name('{question}.store');
Route::get('{quiz}/question/{question}/responses', 'SubmittedQuestionController@show')->name('{question}.show');

Route::get('/testbank', 'TestBankController@index')->name('TestBank');

//STUDENT SIDE

//Displaying quizzes for students
Route::get('/active/{quiz}/conf', 'ActiveQuizController@create')->name('ActiveQuiz');
Route::get('/active/{quiz}/show', 'ActiveQuizController@show')->name('ActiveQuiz');
Route::post('/active', 'QuizController@store');

//Creating and displaying CLICK quizzes!
//Route::get('/cq/{quiz}/{clickquiz}', 'ClickQuizController@show');
//Route::post('/cq', 'QuizController@store');

//Displaying quiz list for student
Route::get('/studentquizlist/{user}', 'InstructorQuizListController@index')->name('instructorquizlist.show');
Route::get('/studenthome', 'StudentHomeController@index')->name('studenthome.show');
