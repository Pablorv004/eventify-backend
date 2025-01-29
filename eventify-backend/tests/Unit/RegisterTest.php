<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected $validatorRules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];


    /** @test */
    public function it_displays_registration_form()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }
    /** @test */
    public function it_validates_registration_data()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $validator = Validator::make($data, $this->validatorRules);

        $this->assertFalse($validator->fails());

        User::where('email', 'test@example.com')->delete();
    }

    /** @test */
    public function it_creates_a_new_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));

        $user->delete();
    }

    /** @test */
    public function it_registers_a_user_and_redirects()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/email/verify');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        User::where('email', 'test@example.com')->delete();
    }

    /** @test */
    public function it_fails_validation_when_name_is_missing()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $validator = Validator::make($data, $this->validatorRules);

        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function it_fails_validation_when_email_is_invalid()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $validator = Validator::make($data, $this->validatorRules);

        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function it_fails_validation_when_password_is_too_short()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ];

        $validator = Validator::make($data, $this->validatorRules);

        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function it_fails_validation_when_password_confirmation_does_not_match()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'different_password',
        ];

        $validator = Validator::make($data, $this->validatorRules);

        $this->assertTrue($validator->fails());
    }
}
