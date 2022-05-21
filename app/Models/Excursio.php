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

    //Scope

    public function scopeNom ($query, $nom)
    {
        if ($nom) 
            return $query->where('nom', 'LIKE', "%$nom%");
    
    }

    public function scopeExcursio ($query, $tipoExcursio)
    {
        if ($tipoExcursio) 
            return $query->where('tipo_excursio_id', $tipoExcursio);
    
    }

    public function scopeExcursiogrups ($query, $grup_id) {

        if ($grup_id)
            return $query->join('excursions_grups as eg','excursions.excursio_id','=','eg.excursio_id')->where('eg.grup_id', $grup_id);
    }

}
