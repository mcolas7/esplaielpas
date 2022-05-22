<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persones';
    protected $primaryKey = 'persona_id';
    protected $fillable = ['poblacio_id', 'nom', 'cognoms','email','telefon','carrer','codi_postal','data_naixement','targeta_sanitaria','dni'];
    protected $guarded = ['persona_id'];

    /**
     * This function returns a relationship between the current model and the Infant model, where the
     * foreign key is the persona_id column.
     * 
     * @return The infant model.
     */
    public function infant() {
        return $this->hasOne(Infant::class,'persona_id');
    }

    /**
     * This function returns a relationship between the Persona model and the Tutor model, where the
     * foreign key is persona_id.
     * 
     * @return A collection of all the tutors that have the same persona_id as the current persona.
     */
    public function tutor() {
        return $this->hasOne(Tutor::class,'persona_id');
    }

    /**
     * A persona has one monitor, and the monitor is related to the persona by the persona_id column.
     * 
     * @return A collection of all the monitors that have the same persona_id as the persona.
     */
    public function monitor() {
        return $this->hasOne(Monitor::class,'persona_id');
    }

    /**
     * This function returns the Poblacio model that belongs to the current model.
     * 
     * @return The relationship between the two models.
     */
    public function poblacio() {
        return $this->belongsTo(Poblacio::class, 'poblacio_id');
    }

    /**
     * This function returns a relationship between the current model and the User model, where the
     * foreign key is the persona_id column on the User model and the local key is the id column on the
     * current model.
     * 
     * @return A collection of users.
     */
    public function user() {
        return $this->hasOne(User::class, 'persona_id');
    }

    /**
     * If the  variable is not empty, then return the query with the where clause
     * 
     * @param query The query builder instance.
     * @param nom The name of the scope.
     */
    public function scopeNom ($query, $nom)
    {
        if ($nom) 
            return $query->where('persones.nom', 'LIKE', "%$nom%");
    
    }

    /**
     * If the user has entered a value in the search box, then return the query with the value in the
     * search box.
     * 
     * @param query The query builder instance.
     * @param cognoms the name of the column in the database
     * 
     * @return A query builder instance.
     */
    public function scopeCognoms ($query, $cognoms)
    {
        if ($cognoms) 
            return $query->where('persones.cognoms', 'LIKE', "%$cognoms%");
    
    }

    /**
     * If the  variable is set, then join the infants_salut table and filter the results based
     * on the value of the  variable.
     * 
     * @param query the query builder instance
     * @param alergies 1 or 2
     * 
     * @return A query builder object.
     */
    public function scopeAlergies ($query, $alergies) {

        if ($alergies)

            if ($alergies == 1) {
                return $query->join('infants_salut as is', 'i.infant_id','=','is.infant_id')->where('is.alergies', 1);
            } else if ($alergies == 2) {
                return $query->join('infants_salut as is', 'i.infant_id','=','is.infant_id')->where('is.alergies', 0);
            }
    }

    /**
     * If the excursio_id is not null, then join the infants and inscripcions tables to the persones
     * table and return the query.
     * 
     * @param query the query builder instance
     * @param excursio_id 1
     * 
     * @return A query builder object.
     */
    public function scopeInscripcio ($query, $excursio_id) {

        if ($excursio_id)
            return $query->join('infants as i','persones.persona_id','=','i.persona_id')->join('inscripcions as in', 'i.infant_id','=','in.infant_id')->where('in.excursio_id', $excursio_id);
           
    }
}
