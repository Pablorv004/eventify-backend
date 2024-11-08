<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\CustomVerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The table associated with the model.
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
        'activated',
        'email_confirmed',
        'deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Method to verify if user is admin
    public function isAdmin()
    {
        return $this->role === 'a';
    }

    // Method to verify if user is user
    public function isUser()
    {
        return $this->role === 'u';
    }

    // Method to verify if user is organizer
    public function isOrganizer()
    {
        return $this->role === 'o';
    }

    // Define the relationship with events
    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60), ['id' => $this->id, 'hash' => sha1($this->email)]
        );

        Mail::to($this->email)->send(new CustomVerifyEmail($verificationUrl, $this));
    }
}
