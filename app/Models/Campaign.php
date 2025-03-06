<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    /**
     * Campaign types
     */
    const TYPE_VOLUNTEER = 'volunteer';
    const TYPE_HELP = 'help';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'creator_id',
        'type',
        'target_amount',
        'current_amount',
        'start_date',
        'end_date',
        'image',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
    ];

    /**
     * Get the user that created the campaign
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Get the donations for the campaign
     */
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the comments for the campaign
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes for the campaign
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the participation requests for the campaign
     */
    public function participationRequests(): HasMany
    {
        return $this->hasMany(ParticipationRequest::class);
    }

    /**
     * Check if campaign is a volunteer campaign
     */
    public function isVolunteerCampaign(): bool
    {
        return $this->type === self::TYPE_VOLUNTEER;
    }

    /**
     * Check if campaign is a help campaign
     */
    public function isHelpCampaign(): bool
    {
        return $this->type === self::TYPE_HELP;
    }
}
