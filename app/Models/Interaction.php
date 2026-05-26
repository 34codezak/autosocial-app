<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $post_id
 * @property string $type
 * @property string|null $content
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Interaction extends Model
{
    use HasFactory;

    /**
     * Interaction type constants
     */
    public const TYPE_LIKE    = 'like';
    public const TYPE_COMMENT = 'comment';
    public const TYPE_SHARE   = 'share';

    /**
     * Valid interaction types for validation/reference
     */
    public const VALID_TYPES = [
        self::TYPE_LIKE,
        self::TYPE_COMMENT,
        self::TYPE_SHARE,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'type',
        'content',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who performed the interaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that was interacted with.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // ──────────────────────────────────────────────────────────────────────
    // SCOPES (Reusable Query Constraints)
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Scope query to a specific interaction type.
     */
    public function scopeOfType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    /**
     * Scope query to interactions by a specific user.
     */
    public function scopeForUser(Builder $query, int $userId): void
    {
        $query->where('user_id', $userId);
    }

    /**
     * Scope query to interactions on a specific post.
     */
    public function scopeForPost(Builder $query, int $postId): void
    {
        $query->where('post_id', $postId);
    }

    /**
     * Scope query to only recent interactions (last 30 days).
     */
    public function scopeRecent(Builder $query, int $days = 30): void
    {
        $query->where('created_at', '>=', now()->subDays($days));
    }

    // ──────────────────────────────────────────────────────────────────────
    // HELPER METHODS
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Check if this interaction is a like.
     */
    public function isLike(): bool
    {
        return $this->type === self::TYPE_LIKE;
    }

    /**
     * Check if this interaction is a comment.
     */
    public function isComment(): bool
    {
        return $this->type === self::TYPE_COMMENT;
    }

    /**
     * Check if this interaction is a share.
     */
    public function isShare(): bool
    {
        return $this->type === self::TYPE_SHARE;
    }

    /**
     * Get a human-readable label for the interaction type.
     */
    public function getTypeLabel(): string
    {
        return match($this->type) {
            self::TYPE_LIKE    => 'Like',
            self::TYPE_COMMENT => 'Comment',
            self::TYPE_SHARE   => 'Share',
            default            => ucfirst($this->type),
        };
    }
}