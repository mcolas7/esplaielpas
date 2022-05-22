<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infant extends Model
{
    use HasFactory;
    protected $table = 'infants';
    protected $primaryKey = 'infant_id';
    protected $fillable = ['persona_id', 'grup_id', 'curs_id'];
    protected $guarded = ['infant_id'];

    /**
     * This function returns the Grup model that is associated with this model.
     * 
     * @return The relationship between the two models.
     */
    public function grup() {
        return $this->belongsTo(Grup::class, 'grup_id');
    }

    /**
     * This function returns the Curs model that is associated with the current model.
     * 
     * @return The relationship between the two models.
     */
    public function curs() {
        return $this->belongsTo(Curs::class, 'curs_id');
    }

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
     * This function returns a relationship between the Infant model and the InfantSalut model, where
     * the infant_id in the InfantSalut model is equal to the id in the Infant model.
     * 
     * @return The infantSalut() method returns a relationship between the Infant model and the
     * InfantSalut model.
     */
    public function infantSalut() {
        return $this->hasOne(InfantSalut::class,'infant_id');
    }

    /**
     * This infant belongs to many tutors, and the relationship is stored in the tutors_infants table,
     * where the infant_id is the foreign key and the tutor_id is the primary key.
     * 
     * @return A collection of Tutor objects.
     */
    public function tutors()
    {
        return $this->belongsToMany(Tutor::class,'tutors_infants','infant_id','tutor_id');
    }

    /**
     * This function returns a relationship between the infant and the inscripcio model
     * 
     * @return The relationship between the two models.
     */
    public function inscripcio() {
        return $this->hasOne(Inscripcio::class,'infant_id');
    }
}
