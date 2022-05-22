<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'rols';
    protected $primaryKey = 'rol_id';
    protected $guarded = ['rol_id','nom'];

    /**
     * > The users() function returns all the users that belong to the role
     * 
     * @return A collection of users.
     */
    public function users () {
        return $this->hasMany(User::class, 'id');
    }
}
