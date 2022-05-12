<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poblacio extends Model
{
    use HasFactory;

    protected $table = 'poblacions';
    protected $primaryKey = 'poblacio_id';

    public function persones () {
        return $this->hasMany(Persona::class, 'poblacio_id');
    }
}
