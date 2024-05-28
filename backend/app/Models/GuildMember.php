<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{
    HasOne,
    BelongsTo,
    BelongsToMany,
    HasMany
};
class GuildMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'guild_id',
        'guild_member',
        'name',
        'lv',
        'job',
    ];

    /**
     * Get the guild that owns the member.
     *
     * @return BelongsTo
     */
    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

}
