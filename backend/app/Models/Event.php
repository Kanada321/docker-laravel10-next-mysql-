<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasOne,
    BelongsTo,
    BelongsToMany,
    HasMany
};
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'guild_id',
        'name',
        'event_date',
        'event_time',
        'maximum_people',
        'explanation'
    ];

    /**
     * Get the guild that owns the event.
     * @return BelongsTo
     */
    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    /**
     * The users that belong to the event.
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user')->withPivot('status', 'comment');
    }

    // EventAttendanceと１対多のリレーションをする

    /**
     * Get the eventAttendances for the event.
     * @return HasMany
     */
    public function eventAttendances(): HasMany
    {
        return $this->hasMany(EventAttendance::class);
    }
}
