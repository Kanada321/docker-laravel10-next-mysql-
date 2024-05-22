<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['guild_id', 'name', 'date', 'participant_limit', 'details'];

    public function guild()
    {
        return $this->belongsTo(Guild::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user')->withPivot('status', 'comment');
    }

}
