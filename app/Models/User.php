<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\PasswordReset;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission){
        return $this->role->permissions->contains('meta_name', $permission);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
        });
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function sendPasswordResetNotification($token)
    {
        // dd($this->user());
        $this->notify(new PasswordReset($token, $this->name, $this->email));
    }

    public function emailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification($this->id, $this->name, $this->email_verify_token));
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
