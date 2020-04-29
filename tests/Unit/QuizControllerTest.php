<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuizControllerTest extends TestCase

{
    use DatabaseTransactions;
    private $quiz;
    private $question;
    private $testUser;
    private $clientTimeIndex;

    /**
     * Creates a quiz with one question and no attempts on it
     *
     * @return void
     */
    public function setUp() : void {

        parent::setUp();
        $quiz = factory(\App\Quiz::class)->create();
        $question = factory(\App\Question::class)->create([
            'question_text' => "What is the air speed of an unladen swallow?",
            'option_a' => '50',
            'option_b' => '100',
            'option_c' => 'How should I know?',
            'option_d' => NULL,
            'option_e' => NULL,
            'question_ans' => 'c',
            'quiz_id' => $quiz->id
        ]);


        $this->quiz = $quiz;
        $this->question = $question;
        $this->testUser = factory(\App\User::class)->create(['instructor' => 0]);
        $this->clientTimeIndex = 1;

        $this->testInstructor = factory(\App\User::class)->create(['instructor' => 1, 'id' => 12]);
    }

    /**
     *
     *  Tests for the quiz launching and submission process go here
     *
     */

    /**
     * This tests that the quiz can be started by a student who has never launched the quiz before
     *
     * @return void
     */
    public function testLaunchingQuizSucceeds()
    {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
    }

    /**
     * This tests that trying to start the quiz results in a forbidden error
     */
    public function testCannotLaunchTwice(){
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertForbidden();
    }

    /**
     * This tests that submitting the quiz works
     */
    public function testSubmission(){
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->assertEquals(0,$this->quiz->attempts()->where('quiz_id',$this->quiz->id)->get()[0]->finalized);
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/submit');
        $response->assertRedirect('/studentquizlist/1');
        $this->assertEquals(1,$this->quiz->attempts()->where('quiz_id',$this->quiz->id)->get()[0]->finalized);
    }

    /**
     * This tests that attempting a submission before trying the quiz fails
     */
    public function testPrematureSubmissionForbidden(){
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/submit');
        $response->assertForbidden();
    }

    /**
     * This tests that attempting to submit twice fails
     */
    public function testDoubleSubmissionFails(){
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/submit');
        $response->assertRedirect('/studentquizlist/1');
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/submit');
        $response->assertForbidden();
    }

    /**
     * This tests that attempting to view an expired quiz fails
     */
    public function testEnteringExpiredQuizFails(){
        $this->quiz->timelimit = -5000;
        $this->quiz->save();
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/show');
        $response->assertForbidden();
    }

    /**
     *
     *  Tests for the question answering process go here
     *
     */

    /**
     * This function is a helper function that will call the question answering backend for the test
     */
    private function answerQuestion($ans, $clientTime = 0) {
        return $this->actingAs($this->testUser)->get('/ajax/submitanswer/' . $this->question->id . '/' . $ans . '/' . ($clientTime === 0 ? $this->clientTimeIndex++ : $clientTime));
    }

    /**
     * This helper function returns the QuestionAttempt for the question
     */
    private function getQuestionAttempt() {
        return $this->question->attempts()->get()[0];
    }


    /**
     * This function tests that trying to answer a question results in it changing in the submission database
     */
    public function testQuestionAnsweringWorks() {
        $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $this->answerQuestion('b')->assertJson(['success' => True]);
        $this->assertEquals('b', $this->getQuestionAttempt()->selected_answer);
    }

    /**
     * This function tests that trying to answer a question without a running attempt fails
     */
    public function testQuestionAnsweringForNotBegunQuizErrors(){
        $this->answerQuestion('b')->assertJson(['success' => False, 'code' => 1]);
    }

    /**
     * This function tests that trying to answer a question on a submitted quiz fails
     */
    public function testQuestionAnsweringForSubmittedQuizErrors() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/submit');
        $response->assertRedirect('/studentquizlist/1');
        $this->answerQuestion('b')->assertJson(['success' => False, 'code' => 2]);
    }

    /**
     * This function test that trying to submit for a quiz that is past the time limit fails
     */
    public function testQuestionAnsweringAfterTimeLimitErrors() {
        $this->quiz->timelimit = -5000;
        $this->quiz->save();
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->answerQuestion('b')->assertJson(['success' => False, 'code' => 3]);
    }

    /**
     * This function tests that trying to answer a question with no attempt fails
     * This isn't actually achievable by normal user interaction so the entry is deleted manually - we still want to handle this error
     */
    public function testQuestionAnsweringWithoutAttemptFails() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->getQuestionAttempt()->delete();
        $this->answerQuestion('b')->assertJson(['success' => False, 'code' => 4]);
    }

    /**
     * This tests that a finalized question attempt cannot be updated - i.e. more post submission security
     */
    public function testModifyingFinalizedQuestionFails() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $attempt = $this->getQuestionAttempt();
        $attempt->finalized = 1;
        $attempt->save();
        $this->answerQuestion('b')->assertJson(['success' => False, 'code' => 5]);
    }

    /**
     * This tests that out of order old submissions are rejected
     */
    public function testOldAnswerFails() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->answerQuestion('b', 10)->assertJson(['success' => True]);
        $this->answerQuestion('d', 5)->assertJson(['success' => False, 'code' => 6]);
    }

    /**
     * This tests that invalid answers are rejected
     */
    public function testInvalidAnswerFails() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->answerQuestion('IAm1337HackerPro')->assertJson(['success' => False, 'code' => 7]);
    }

    /**
     * This tests that answers that are not available for this question are rejected
     */

    public function testUnavailableAnswerFails() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->answerQuestion('e')->assertJson(['success' => False, 'code' => 8]);
    }

    /**
     * This tests the (unused) time limit functionality for question attempts
     */

    public function testOutOfTimeAnswerFails() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->question->timelimit = -5000;
        $this->question->save();
        $this->answerQuestion('b')->assertJson(['success' => False, 'code' => 9]);
    }

    /**
     * Finally, tests that if we do get an error, the answer on the attempt doesn't change
     */
    public function testFailDoesntWrite() {
        $response = $this->actingAs($this->testUser)->get('/active/' . $this->quiz->id . '/confirmlaunch');
        $response->assertRedirect('/active/' . $this->quiz->id . '/show');
        $this->answerQuestion('b')->assertJson(['success' => True]);
        $this->answerQuestion('c')->assertJson(['success' => True]);
        $this->answerQuestion('e')->assertJson(['success' => False]);
        $this->assertEquals('c',$this->getQuestionAttempt()->selected_answer);
    }

    /**
    * Check the created quiz from the database
    */
    public function testInsertToDatabaseQuizzes() {
        $quiz = factory(\App\Quiz::class)->create([
          'quiz_name'=>'test_quiz',
          'timelimit'=>'60000'
        ]);
        $this->assertDatabaseHas('quizzes', ['quiz_name' => 'test_quiz', 'timelimit'=>'60000']);
    }

    /**
    * Check the created question from the database
    */
    public function testInDatabaseQuestions() {
      $quiz = factory(\App\Quiz::class)->create();
      $question = factory(\App\Question::class)->create([
          'question_text' => "What is the name of the instructor?",
          'option_a' => 'Sam',
          'option_b' => 'Jack',
          'option_c' => 'Jay',
          'option_d' => 'None of the above',
          'option_e' => NULL,
          'question_ans' => 'a',
          'quiz_id' => $quiz->id
      ]);
      $this->assertDatabaseHas('questions', ['question_text' => 'What is the name of the instructor?']);
    }

    /**
    * Check the deleted quiz is removed from the database
    */
    public function testDeleteQuizFromDatabase() {
      $quiz = factory(\App\Quiz::class)->create([
        'quiz_name'=>'test_quiz'
      ]);
      $response = $this->actingAs($this->testInstructor)->post('/q/' . $quiz->id . '/responses',
       ['delete_button'=>"Delete Quiz", 'quiz' => $quiz])->assertStatus(200);
       $this->assertDatabaseMissing('quizzes', ['id'=>$quiz->id]);
       $response->assertDontSeeText('test_quiz');
    }

    /**
    * Check the deleted question is remove from the quiz by removing the quiz_id = 0
    */
    public function testRemoveQuestionFromQuiz() {
      $quiz = factory(\App\Quiz::class)->create(['id'=>100]);
      $question = factory(\App\Question::class)->create([
          'question_text' => "What is ?",
          'option_a' => 'Sam',
          'option_b' => 'Jack',
          'option_c' => 'Jay',
          'option_d' => 'None of the above',
          'option_e' => NULL,
          'question_ans' => 'a',
          'quiz_id' => $quiz->id
      ]);
      $response = $this->actingAs($this->testInstructor)->call('POST','/q/' . $quiz->id,
       ['delete_question'=>"Delete", 'question_id'=>$question->id,'quiz' => $quiz]);
       $this->assertDatabaseHas('questions', ['quiz_id'=>0]);
    }

    /**
    * Check the added question is inserted to the existing quiz
    */
    public function testAddQuestionToQuiz() {
      $quiz = factory(\App\Quiz::class)->create();
      $question = factory(\App\Question::class)->create([
          'question_text' => "What is ?",
          'option_a' => 'Sam',
          'option_b' => 'Jack',
          'option_c' => 'Jay',
          'option_d' => 'None of the above',
          'option_e' => NULL,
          'question_ans' => 'a',
          'quiz_id' => $quiz->id
      ]);
      $question2 = factory(\App\Question::class)->create([
          'question_text' => "question2?",
          'option_a' => 'Dad',
          'option_b' => 'Jack',
          'option_c' => 'Jay',
          'option_d' => 'None of the above',
          'option_e' => NULL,
          'question_ans' => 'a',
          'quiz_id' => $quiz->id
      ]);
      $this->assertDatabaseHas('questions', ['quiz_id'=>$quiz->id, 'question_text'=>"What is ?", 'option_a'=>"Sam"]);
      $this->assertDatabaseHas('questions', ['quiz_id'=>$quiz->id, 'question_text'=>"question2?", 'option_a'=>"Dad"]);
    }

    /**
    * Check the editted question is updated
    */
    public function testEditQuiz() {
      $quiz = factory(\App\Quiz::class)->create();
      $question = factory(\App\Question::class)->create([
          'question_text' => "What is ?",
          'option_a' => 'Sam',
          'option_b' => 'Jack',
          'option_c' => 'Jay',
          'option_d' => 'None of the above',
          'option_e' => NULL,
          'question_ans' => 'a',
          'quiz_id' => $quiz->id
      ]);
      $question -> update([
          'question_text' => "What is what?",
          'option_a' => 'Sam',
          'option_b' => 'Jack',
          'option_c' => 'Jay',
          'option_d' => 'None of the above',
          'option_e' => NULL,
          'question_ans' => 'b',
          'quiz_id' => $quiz->id
      ]);
      $this->assertDatabaseHas('questions', ['quiz_id'=>$quiz->id, 'question_text'=>"What is what?", 'question_ans'=>"b"]);
    }
}
