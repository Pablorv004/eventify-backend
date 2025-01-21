<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class EventTest extends TestCase
{
    use RefreshDatabase;

    # Test to check if an organizer can create an event
    # Assertion 1: The application redirects the user to /events
    # Assertion 2: The event is created in the database
    public function test_create_event()
    {
        $user = $this->createOrganizerUser();

        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $user->id;
        $eventData['category_id'] = $category->id;

        $response = $this->actingAs($user)->post('/events', $eventData);

        $response->assertRedirect('/events');
        $this->assertDatabaseHas('events', $this->getEventData());

        # Clean up created models
        $this->deleteEvent($this->getEventData());
        $user->delete();
        $category->delete();
    }

    # Test to check if an organizer can create an event without an image
    # Assertion 1: The application redirects the user to /events
    # Assertion 2: The event is created in the database
    public function test_create_event_without_image()
    {
        $user = $this->createOrganizerUser();

        $category = $this->createCategory();

        $eventData = $this->getNoImageEventData();
        $eventData['organizer_id'] = $user->id;
        $eventData['category_id'] = $category->id;

        $response = $this->actingAs($user)->post('/events', $eventData);

        $response->assertRedirect('/events');
        $this->assertDatabaseHas('events', $this->getEventData());

        # Clean up created models
        $this->deleteEvent($this->getEventData());
        $user->delete();
        $category->delete();
    }

    # Test to check if a normal user cannot create an event
    # Assertion 1: The user is redirected to /home
    # Assertion 2: The event is not created in the database
    # 302 Code: This code means that the user is being redirected to /home due to not having the correct role
    public function test_normal_user_cannot_create_event()
    {
        $user = $this->createUser();

        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $user->id;
        $eventData['category_id'] = $category->id;

        $response = $this->actingAs($user)->post('/events', $eventData);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('events', $eventData);

        # Clean up created models
        $user->delete();
        $category->delete();
    }

    private function createUser()
    {
        return User::factory()->create([
            'role' => 'u',
            'activated' => 1,
            'email_verified_at' => now(),
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);
    }

    private function createOrganizerUser()
    {
        return User::factory()->create([
            'role' => 'o',
            'activated' => 1,
            'email_verified_at' => now(),
            'email' => 'organizeruser@example.com',
            'password' => Hash::make('password123'),
        ]);
    }

    private function createCategory($id = 1, $name = 'Test Category')
    {
        return Category::factory()->create([
            'id' => $id,
            'name' => $name,
        ]);
    }

    private function getEventData()
    {
        return [
            'title' => 'Test Event',
            'description' => 'This is a test event description',
            'start_date' => '2021-12-01 12:00:00',
            'end_date' => '2021-12-01 14:00:00',
            'location' => 'Test Location',
            'latitude' => 25.545433,
            'longitude' => 67.545633,
            'max_attendees' => 100,
            'price' => 7.89,
            'image_url' => 'event-placeholder.png',
        ];
    }

    private function getNoImageEventData()
    {
        return [
            'title' => 'Test Event',
            'description' => 'This is a test event description',
            'start_date' => '2021-12-01 12:00:00',
            'end_date' => '2021-12-01 14:00:00',
            'location' => 'Test Location',
            'latitude' => 25.545433,
            'longitude' => 67.545633,
            'max_attendees' => 100,
            'price' => 7.89,
        ];
    }

    private function deleteEvent($eventData)
    {
        \App\Models\Event::where('title', $eventData['title'])->delete();
    }
}
