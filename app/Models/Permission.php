<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $table ='permissions';

    public function children()
	{
		return $this->hasMany(Permission::class, 'parent_id');
	}

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }

}
