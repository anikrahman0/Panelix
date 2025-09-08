<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser  extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded =[];
    protected $table ='admin_users';

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
}
