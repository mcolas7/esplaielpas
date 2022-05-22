<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $table = 'tutors';
    protected $primaryKey = 'tutor_id';
    protected $fillable = ['persona_id'];
    protected $guarded = ['tutor_id'];

    /**
     * This function returns the relationship between the current model and the model specified in the
     * first parameter.
     * 
     * @return The relationship between the two models.
     */
    public function persona() {
        return $this->belongsTo(Persona::class,'persona_id');
    }

    /**
     * This function returns a collection of Infant objects that are related to the Tutor object that
     * called the function.
     * 
     * @return A collection of infant objects.
     */
    public function infants()
    {
        return $this->belongsToMany(Infant::class,'tutors_infants','tutor_id','infant_id');
    }

    /**
     * This function returns a relationship between the tutor and the inscripcio model.
     * 
     * @return The relationship between the tutor and the inscripcio.
     */
    public function inscripcio() {
        return $this->hasOne(Inscripcio::class,'tutor_id');
    }
}
