<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasMany
};

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'related_inquiry_id',
        'user_id',
        'subject',
        'inquiry_content',
        'public_flag',
        'complet_flag',
        'published_at',
        'completed_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(InquiryReply::class);
    }

}
