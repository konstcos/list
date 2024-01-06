<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the userData method.
     */
    public function testUserData(): void
    {
        // Create a user
        $user = factory(User::class)->create();

        // Mock the authenticated user
        $this->actingAs($user);

        // Send a request to the userData endpoint
        $response = $this->get('/user-data');

        // Assert that the response is successful
        $response->assertOk();

        // Assert that the response contains the expected data
        $response->assertJson([
            'status' => 'success',
            'info' => 'user data',
            'data' => [
                'user' => $user->toMainArrayData()
            ]
        ]);
    }
}