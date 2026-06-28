<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

<<<<<<< HEAD
        $response->assertStatus(200);
=======
        $response->assertRedirect(route('login'));
>>>>>>> d959ad24edda2faacd434ad042d52e081eb02510
    }
}
