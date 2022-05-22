<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poblacio extends Model
{
    use HasFactory;

    protected $table = 'poblacions';
    protected $primaryKey = 'poblacio_id';

    /**
     * This model has many Personas, and the foreign key is poblacio_id.
     * 
     * @return A collection of Persones.
     */
    public function persones () {
        return $this->hasMany(Persona::class, 'poblacio_id');
    }
}
