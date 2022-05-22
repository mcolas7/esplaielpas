<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoExcursio extends Model
{
    use HasFactory;
    protected $table = 'tipo_excursions';
    protected $primaryKey = 'tipo_excursio_id';
    protected $guarded = ['tipo_excursio_id','nom'];

    /**
     * The excursions() function returns all the excursions that belong to the current tipo_excursio
     * 
     * @return The excursions method returns all of the excursions that belong to the tipo_excursio.
     */
    public function excursions () {
        return $this->hasMany(Excursio::class, 'tipo_excursio_id');
    }
}
