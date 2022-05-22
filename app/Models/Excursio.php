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

    /**
     * The tipoExcursio() function returns the TipoExcursio model that is associated with the Excursio
     * model
     * 
     * @return relationship between the model and the tipoExcursio model.
     */
    public function tipoExcursio() {
        return $this->belongsTo(TipoExcursio::class, 'tipo_excursio_id');
    }

    /**
     * The function returns a collection of all the groups that are associated with the excursion
     * 
     * @return The relationship between the excursions and the groups.
     */
    public function grups()
    {
        return $this->belongsToMany(Grup::class,'excursions_grups','excursio_id','grup_id');
    }

    /**
     * It returns the inscripcio that belongs to the excursio.
     * 
     * @return The relationship between the excursion and the inscription.
     */
    public function inscripcio() {
        return $this->hasOne(Inscripcio::class,'excursio_id');
    }

    /**
     * It takes a query and a name as parameters, and if the name is not empty, it returns the query
     * with a where clause that looks for the name in the database
     * 
     * @param query The query object that is being built.
     * @param nom The name of the scope.
     */
    public function scopeNom ($query, $nom)
    {
        if ($nom) 
            return $query->where('nom', 'LIKE', "%$nom%");
    
    }

    /**
     * If the user has selected a type of excursion, return the query with the type of excursion
     * selected
     * 
     * @param query The query builder instance.
     * @param tipoExcursio The name of the parameter that will be passed to the scope.
     */
    public function scopeExcursio ($query, $tipoExcursio)
    {
        if ($tipoExcursio) 
            return $query->where('tipo_excursio_id', $tipoExcursio);
    
    }

    /**
     * I want to join the table excursions_grups with the table excursions, and then filter the results
     * by the grup_id
     * 
     * @param query The query builder instance.
     * @param grup_id the id of the group
     * 
     * @return A query builder object.
     */
    public function scopeExcursiogrups ($query, $grup_id) {

        if ($grup_id)
            return $query->join('excursions_grups as eg','excursions.excursio_id','=','eg.excursio_id')->where('eg.grup_id', $grup_id);
    }

}
