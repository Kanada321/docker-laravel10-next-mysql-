<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
};

class EventAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guild_id',
        'guild_event_no',
        'event_id',
        'guild_member_id',
        'status',
        'comment'
    ];

    /**
     * Get the guild that owns the attendance.
     *
     * @return BelongsTo
     */
    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    /**
     * Get the event that owns the attendance.
     *
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the guild member that owns the attendance.
     *
     * @return BelongsTo
     */
    public function guildMember(): BelongsTo
    {
        return $this->belongsTo(GuildMember::class);
    }

}
