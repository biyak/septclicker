<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccessControlTest extends TestCase
{
    /**
     * Tests that without authentication, we are redirected to login
     */
    public function testUnauthenticatedRedirect()
    {
        $response = $this->get('/studenthome');

        $response->assertRedirect("/login");
    }

    /**
     * Tests that after logging in as a student, we can access studenthome
     */
    public function testAuthenticatedStudentHome(){
        $testUser = factory(\App\User::class)->create(['instructor' => 0]);

        $response = $this->actingAs($testUser)->get('/studenthome');
        $response->assertStatus(200);
    }

    /**
     * Tests that a logged in student cannot access protected pages (instructorhome in this case)
     */
    public function testAuthenticatedStudentForbiddenFromInstructorPages(){
        $testUser = factory(\App\User::class)->create(['instructor' => 0]);

        $response = $this->actingAs($testUser)->get('/instructorhome');
        $response->assertForbidden();
    }

    /**
     * Tests that a logged in instructor can access protected pages
     */
    public function testAuthenticatedInstructorHome(){
        $testUser = factory(\App\User::class)->create(['instructor' => 1]);

        $response = $this->actingAs($testUser)->get('/instructorhome');
        $response->assertStatus(200);
    }


}
