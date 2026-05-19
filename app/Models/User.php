<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */


     protected $fillable = [
        'name', 'email', 'password', 'timezone', 'avatar_url',
        'preferences' // JSON: { default_team_id, notification_settings }
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'preferences' => 'array',
        ];
    }

    // === RELATIONSHIPS ===
    public function teams() {
        return $this->belongsToMany(Team::class, 'team_user')
                        ->withPivot('role', 'joined_at')
                        ->withTimestamps();
    }

    public function currentTeam() {
        return $this-teams()->where('id', $this->preferences['default_team_id'] ?? null)->first();
    }

    public function socialAccounts() {
        return $this->hasMany(SocialAccount::class);
    }

    public function createdPosts() {
        return $this->hasMany(Post::class, 'user_id');
    }

    // Permission helpers
    public function canManageTeam(Team $team): bool {
        $pivot = $this->teams()->where('team_id', $team->id)->first();
        return $pivot && in_array($pivot->pivot->role, ['owner', 'admin']);
    }

    public function canViewAnalytics(Team $team): bool
    {
        $pivot = $this->teams()->where('team_id', $team->id)->first();
        return $pivot && in_array($pivot->pivot->role, ['owner', 'admin', 'analyst', 'creator']);
    }

    // === SOCIAL ACCOUNT HELPERS ===
    public function getActiveSocialAccountsForTeam(Team $team, ?string $platform = null)
    {
        $query = $team->socialAccounts()->where('is_active', true);
        if ($platform) {
            $query->where('platform', $platform);
        }
        return $query->get();
    }
}
