<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration.
     */
    public function testUserCanRegister()
    {
        // Arrange
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ];

        // Act
        $response = $this->postJson(route('auth.register'), $data);

        // Assert
        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'token_type',
                'token',
                'user_id',
            ]);
        $this->assertDatabaseHas('users', ['email' => $data['email']]);
    }

    /**
     * Test user login.
     */
    public function testUserCanLogin()
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
        ]);

        $data = [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token_type',
                'token',
                'user_id',
            ]);
    }

    /**
     * Test fetching profile.
     */
    public function test_user_can_fetch_profile()
    {
        // Arrange:
        $user = User::factory()->create();
        $token = $user->createToken('Test Token')->plainTextToken;

        // Act:
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson(route('auth.profile'));

        // Assert:
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                ],
            ]);
    }


    /**
     * Test logout functionality.
     */
    public function test_user_can_logout()
    {
        // Arrange:
        $user = User::factory()->create();
        $token = $user->createToken('Test Token')->plainTextToken;

        // Act: 
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson(route('auth.logout'));

        // Assert: 
        $response->assertStatus(200)
            ->assertJson(['message' => 'Logout successful.']);
    }
}
