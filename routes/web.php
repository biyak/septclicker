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

Route::get('/password/reset/{token}/{email}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

//Route::get('/studenthome', 'HomeController@index')->name('Home');

Route::get('/quizlist/{user}', 'QuizListController@index')->name('QuizList');

Route::get('/quiztest', 'QuizTestController@index')->name('QuizTest');

Route::get('/registercompleted', 'RegistrationCompleteController@completedpage')->name('RegisterCompleted');

Route::get('/prlist', 'PRListController@index')->name('PRList');

Route::get('/peerreview', 'PeerReviewController@index')->name('PeerReview');

//Route::get('/quizinteractive', 'QuizInteractiveController@index')->name('QuizInteractive');

Route::get('/instructorhome', 'InstructorHomeController@index')->name('InstructorHome')->middleware("BlockStudents");

Route::get('/instructorquizlist/{user}', 'InstructorQuizListController@index')->name('instructorquizlist.show')->middleware("BlockStudents");

Route::get('/instructorprlist', 'InstructorPRListController@index')->name('InstructorPRList')->middleware("BlockStudents");

Route::get('/createpr', 'CreatePRController@index')->name('CreatePR');

//Creating and displaying quizzes!
Route::get('/q/{quiz}/launch', 'QuizController@launch')->name('{quiz}.launch')->middleware("BlockStudents");
Route::get('/q/create', 'QuizController@create')->middleware("BlockStudents");
Route::post('/q', 'QuizController@store')->middleware("BlockStudents");
Route::get('/q/{quiz}', 'QuizController@show')->middleware("BlockStudents");
Route::post('/q/{quiz}', 'QuizController@delete')->name('{quiz}.delete')->middleware("BlockStudents");

//Editing quiz
Route::get('/q/{quiz}/edit', 'QuizController@edit')->name('{quiz}.edit')->middleware("BlockStudents");
Route::patch('/q/{quiz}/', 'QuizController@update')->name('{quiz}.update')->middleware("BlockStudents");
//See quiz result
Route::get('/q/{quiz}/responses/result','QuizController@result')->name('{quiz}.result')->middleware("BlockStudents");
Route::get('/q/{quiz}/responses/result-csv','QuizController@download')->name('{quiz}.download')->middleware("BlockStudents");
Route::post('/q/{quiz}/responses','QuizController@changeStatus')->name('{quiz}.changeStatus')->middleware("BlockStudents");

//Creating and displaying questions
Route::get('{quiz}/question/create', 'QuestionController@create')->middleware("BlockStudents");
Route::post('{quiz}/question', 'QuestionController@store')->middleware("BlockStudents");
Route::get('{quiz}/question/{question}', 'QuestionController@show')->middleware("BlockStudents");

//Editing question
Route::get('{quiz}/question/{question}/edit', 'QuestionController@edit')->name('{question}.edit')->middleware("BlockStudents");
Route::patch('{quiz}/question/{question}', 'QuestionController@update')->name('{question}.update')->middleware("BlockStudents");

// Seeing quiz responses
Route::get('/q/{quiz}/responses', 'QuizController@responses')->name('{quiz}.responses');
Route::post('/q/{quiz}/responses', 'QuizController@changeStatus')->name('{quiz}.changeStatus');


//Live quizzes
Route::get('{quiz}/question/{question}/live', 'SubmittedQuestionController@live')->name('{question}.live');
Route::post('{quiz}/question/{question}', 'SubmittedQuestionController@store')->name('{question}.store');
Route::get('{quiz}/question/{question}/responses', 'SubmittedQuestionController@show')->name('{question}.show')->middleware("BlockStudents");

//TestBank
Route::get('/testbank', 'TestBankController@index')->name('TestBank')->middleware("BlockStudents");
Route::post('/testbank/create', 'TestBankController@create')->name("create")->middleware("BlockStudents");
Route::post('/testbank/review', 'TestBankController@show')->middleware("BlockStudents");


//STUDENT SIDE

//Displaying quizzes for students
Route::get('/active/{quiz}/conf', 'ActiveQuizController@create')->name('ActiveQuiz');
Route::get('/active/{quiz}/show', 'ActiveQuizController@show')->name('ActiveQuiz');
Route::get('/active/{quiz}/submit', 'ActiveQuizController@submit')->name('ActiveQuiz');
Route::get('/active/{quiz}/launch', 'ActiveQuizController@showConfirmation')->name('ActiveQuiz');
Route::get('/active/{quiz}/confirmlaunch', 'ActiveQuizController@launchQuiz')->name('ActiveQuiz');
Route::post('/active', 'QuizController@store');

//Creating and displaying CLICK quizzes!
//Route::get('/cq/{quiz}/{clickquiz}', 'ClickQuizController@show');
//Route::post('/cq', 'QuizController@store');

//Displaying quiz list for student
Route::get('/studentquizlist/{user}', 'StudentQuizListController@index')->name('studentquizlist.show');
Route::get('/studenthome', 'StudentHomeController@index')->name('studenthome.show');

//Routes for elevating users to instructor status
Route::get('/elevate', 'ElevationController@index')->name('elevate.show');
Route::post('/elevate', 'ElevationController@elevate')->name('elevate.post');

// Backend routes - these aren't meant for humans to use and will return JSON
Route::get("/ajax/submitanswer/{question}/{answer}/{clientTime}","QuestionAttemptController@submitAnswer");

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
