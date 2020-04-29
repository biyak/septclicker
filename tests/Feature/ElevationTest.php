<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ElevationTest extends TestCase
{
    use RefreshDatabase;

    private $elevation = NULL;
    private $testingUser = NULL;

    protected function setUp(): void
    {
        parent::setUp();

        $this->elevation = factory(\App\Elevations::class)->create([
            'code' => 'SuperSecretCode',
            'used' => False
        ]);
        $this->elevation->save();

        $this->testingUser = factory(\App\User::class)->create(['instructor' => 0]);

    }

    /**
     * Tests that accessing the page as a student works
     */
    public function testElevateStudentAccessWorks()
    {
        $this->actingAs($this->testingUser)->get('/elevate')->assertStatus(200);
    }

    /**
     * Tests that a student can elevate with a valid code
     */
    public function testElevateElevationWorks()
    {
        $this->actingAs($this->testingUser)->call('POST','/elevate',['code' => 'SuperSecretCode','course_code' => '4AM2', 'course_name' => 'Advanced Testing'])->assertRedirect('/instructorhome');
        $this->assertEquals(1, $this->testingUser->instructor);
        $this->elevation->refresh();
        $this->assertEquals(True, $this->elevation->used);
    }

    /**
     * Tests that an instructor gets redirected
     */
    public function testElevateRedirectionWorks()
    {
        $this->testingUser->instructor = 1;
        $this->actingAs($this->testingUser)->get('/elevate')->assertRedirect('/instructorhome');
    }

    /**
     * Tests that redirections from POST requests works
     */
    public function testElevatePOSTRedirectionWorks()
    {
        $this->testingUser->instructor = 1;
        $this->actingAs($this->testingUser)->call('POST','/elevate',['code' => 'ThisISNotAValidCode','course_code' => '4AM2', 'course_name' => 'Advanced Testing'])->assertRedirect('/instructorhome');
    }

    /**
     * Tests that an invalid code does not work
     */
    public function testElevateInvalidCodeFails()
    {
        $request = $this->actingAs($this->testingUser)->call('POST','/elevate',['code' => 'WrongCode', 'course_code' => '4AM2', 'course_name' => 'Advanced Testing']);
        $request->assertStatus(200);
        $request->assertSee("This code is invalid");
        $this->assertEquals(0, $this->testingUser->instructor);
    }

    /**
     * Tests that a code can't be used twice
     */
    public function testElevateDoubleUseFails()
    {
        $this->actingAs($this->testingUser)->call('POST','/elevate',['code' => 'SuperSecretCode', 'course_code' => '4AM2', 'course_name' => 'Advanced Testing'])->assertRedirect('/instructorhome');
        $this->assertEquals(1, $this->testingUser->instructor);
        $this->elevation->refresh();
        $this->assertEquals(True, $this->elevation->used);
        $this->testingUser->instructor = 0;
        $request = $this->actingAs($this->testingUser)->call('POST','/elevate',['code' => 'SuperSecretCode']);
        $request->assertStatus(200);
        $request->assertSee("This code has already been used");
    }

}
