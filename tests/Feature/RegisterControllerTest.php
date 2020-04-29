<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    private $testingUser = NULL;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testingUser = factory(\App\User::class)->create(['instructor' => 0]);

    }

    public function test()
    {
        $this->assertTrue(True);
    }
}
