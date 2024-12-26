<?php

namespace Tests\Unit\Models;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if an address belongs to a user.
     */
    public function test_address_belongs_to_user()
    {
        // Arrange: Create a user and an associated address
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        // Act: Fetch the related user from the address
        $relatedUser = $address->user;

        // Assert: Verify the relationship
        $this->assertInstanceOf(User::class, $relatedUser);
        $this->assertEquals($user->id, $relatedUser->id);
    }

    /**
     * Test if the address has correct fillable attributes.
     */
    public function test_address_has_correct_fillable_attributes()
    {
        // Arrange: Create an Address instance
        $address = new Address();

        // Assert: Verify the fillable attributes
        $this->assertEquals(
            ['user_id', 'name', 'address', 'zipcode', 'city', 'country', 'created_at'],
            $address->getFillable()
        );
    }
}
