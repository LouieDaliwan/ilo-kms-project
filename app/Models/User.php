<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Users\Remark;
use App\Models\Users\UserAttributes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,
    HasFactory,
    Notifiable,
    UserAttributes,
    HasRoles;

    protected static function booted(): void
    {
        static::created(function (User $user) {
            $user->status = 'For Placement';

            $user->metadata = [
                'phone_number' => '',
                'age' => '',
                'address' => '',
                'company' => '',
                'source' => '',
                'social_media' => '',
            ];

            $user->save();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'metadata' => 'array',
        'is_temporary_password' => 'boolean'
    ];

    public function remarks()
    {
        return $this->hasMany(Remark::class, 'user_id');
    }

    public function saveRemarks(User $author, string $remarks)
    {
        return $this->remarks()->create([
            'author_id' => $author->id,
            'remarks' => $remarks
        ]);
    }
}
