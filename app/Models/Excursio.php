<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excursio extends Model
{
    use HasFactory;
    protected $table = 'excursions';
    protected $primaryKey = 'excursio_id';
    protected $fillable = ['tipo_excursio_id', 'nom', 'preu','descripcio','data_inici','data_fi','localitzacio','imatge','autoritzacio','lat','long'];
    protected $guarded = ['excursio_id'];

    public function tipoExcursio() {
        return $this->belongsTo(TipoExcursio::class, 'tipo_excursio_id');
    }

    public function grups()
    {
        return $this->belongsToMany(Grup::class,'excursions_grups','excursio_id','grup_id');
    }

    public function inscripcio() {
        return $this->hasOne(Inscripcio::class,'excursio_id');
    }

}
