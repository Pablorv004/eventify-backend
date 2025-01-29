<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class EventTest extends TestCase
{
    use RefreshDatabase;

    ###-------- EVENT CREATION TESTS --------###

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
        $this->clearModels($user, $category, $eventData['title']);
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
        $this->clearModels($user, $category, $eventData['title']);
    }

    # Test to check if a normal user cannot create an event
    # Assertion 1: The user is redirected to /home
    # Assertion 2: The petition receives a 302 status code (Redirection due to not having the correct role)
    # Assertion 3: The event is not created in the database
    # 302 Code: This code means that the user is being redirected to /home due to not having the correct role
    public function test_normal_user_cannot_create_event()
    {
        $user = $this->createUser();
        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $user->id;
        $eventData['category_id'] = $category->id;

        $response = $this->actingAs($user)->post('/events', $eventData);
        $response->assertRedirect('/home');
        $response->assertStatus(302);
        $this->assertDatabaseMissing('events', $eventData);

        # Clean up created models
        $this->clearModels($user, $category, null);
    }

    # Test to check if an event can be created with invalid data
    # Assertion 1: Some of the fields are invalid
    # Assertion 2: The event is not created in the database
    public function test_create_event_with_invalid_data()
    {
        $user = $this->createOrganizerUser();
        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $user->id;
        $eventData['category_id'] = $category->id;
        $eventData['start_date'] = 'invalid date';
        $eventData['end_date'] = 'invalid date';
        $eventData['location'] = 35;

        $response = $this->actingAs($user)->post('/events', $eventData);

        $response->assertSessionHasErrors(['location', 'start_date', 'end_date']);
        $this->assertDatabaseMissing('events', $eventData);

        # Clean up created models
        $this->clearModels($user, $category, null);
    }

    # Test to check if a guest cannot create an event
    # Assertion 1: The user is redirected to /login
    # Assertion 2: The petition receives a 302 status code (Redirection due to not being logged in)
    # Assertion 3: The event is not created in the database
    public function test_guest_cannot_create_event()
    {
        $organizer = $this->createOrganizerUser();
        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $organizer->id;
        $eventData['category_id'] = $category->id;

        $response = $this->post('/events', $eventData);

        $response->assertRedirect('/login');
        $response->assertStatus(302);
        $this->assertDatabaseMissing('events', ['title' => $eventData['title']]);

        # Clean up created models
        $this->clearModels($organizer, $category, null);
    }




    ###-------- EVENT DELETION TESTS --------###

    # Test to check if an organizer can delete an event
    # Due to our application design, the event is not actually deleted from the database so we will check if the event is marked as deleted
    # Assertion 1: The event is marked as deleted in the database
    public function test_delete_event()
    {
        $user = $this->createOrganizerUser();
        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $user->id;
        $eventData['category_id'] = $category->id;

        $event = Event::create($eventData);

        $this->actingAs($user)->delete('/events/' . $event->id);

        $eventData['deleted'] = 1;
        $this->assertDatabaseHas('events', $eventData);

        # Clean up created models
        $this->clearModels($user, $category, $event->title);
    }

    # Test to check if a normal user cannot delete an event
    # Assertion 1: The user is redirected to /home
    # Assertion 2: The petition receives a 302 status code (Redirection due to not having the correct role)
    # Assertion 3: The event is still not marked as deleted in the database
    # 302 Code: This code means that the user is being redirected to /home due to not having the correct role
    public function test_normal_user_cannot_delete_event()
    {
        $organizer = $this->createOrganizerUser();
        $user = $this->createUser();
        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $organizer->id;
        $eventData['category_id'] = $category->id;

        $event = Event::create($eventData);

        $response = $this->actingAs($user)->delete('/events/' . $event->id);
        $response->assertRedirect('/home');
        $response->assertStatus(302);
        $this->assertDatabaseHas('events', $eventData);

        # Clean up created models
        $user->delete();
        $this->clearModels($organizer, $category, $event->title);
    }

    # Test to check if an organizer can delete an event that does not exist
    # Due to our application redirecting the user to index if the event does not exist, we will check if the user is redirected to index
    # Assertion 1: The user is redirected to index
    # Assertion 2: The petition receives a 302 status code
    public function test_organizer_cannot_delete_not_existing_event()
    {
        $user = $this->createOrganizerUser();

        $response = $this->actingAs($user)->delete('/events/1');
        $response->assertRedirect('/');
        $response->assertStatus(302);

        # Clean up created models
        $user->delete();
    }

    # Test to check if a guest cannot delete an event
    # Assertion 1: The user is redirected to /login
    # Assertion 2: The petition receives a 302 status code (Redirection due to not being logged in)
    # Assertion 3: The event is not marked as deleted in the database
    public function test_guest_cannot_delete_event()
    {
        $organizer = $this->createOrganizerUser();
        $category = $this->createCategory();

        $eventData = $this->getEventData();
        $eventData['organizer_id'] = $organizer->id;
        $eventData['category_id'] = $category->id;

        $event = Event::create($eventData);

        $response = $this->delete('/events/' . $event->id);

        $response->assertRedirect('/login');
        $response->assertStatus(302);

        $this->assertDatabaseHas('events', $eventData);

        # Clean up created models
        $this->clearModels($organizer, $category, $event->title);
    }


    ###-------- AUXILIARY FUNCTIONS --------###

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

    private function clearModels($user, $category, $title)
    {
        $user->delete();
        $category->delete();
        if ($title != null)
            Event::where('title', $title)->delete();
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
}
