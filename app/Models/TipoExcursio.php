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

    public function excursions () {
        return $this->hasMany(Excursio::class, 'tipo_excursio_id');
    }
}
