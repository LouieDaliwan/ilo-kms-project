<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Users\Remark;
use App\Models\Users\UserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        UserAttributes,
        HasRoles,
        SoftDeletes;

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
        'is_temporary_password' => 'boolean',
    ];
    
    public function saveRemarks(User $author, string $remarks)
    {
        return $this->remarks()->create([
            'author_id' => $author->id,
            'remarks' => $remarks,
        ]);
    }

    public function remarks(): HasMany
    {
        return $this->hasMany(Remark::class, 'user_id');
    }

    public function dgroup(): HasOne
    {
        return $this->hasOne(Dgroup::class, 'leader_id');
    }
}
