<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendee extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
