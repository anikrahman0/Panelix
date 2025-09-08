<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PermissionGroup extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='permission_groups';
    
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_id');
    }

    public function parentPermissions()
    {
        return $this->hasMany(Permission::class, 'group_id')->where('parent_id',0);
    }
}
