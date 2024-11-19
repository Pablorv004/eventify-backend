<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Attendee extends Model
{
    use HasFactory;

    protected $table = 'event_attendees';

    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'registered_at',
        'deleted',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
