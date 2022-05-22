<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcio extends Model
{
    use HasFactory;
    protected $table = 'inscripcions';
    protected $primaryKey = 'inscripcio_id';
    protected $fillable = ['excursio_id', 'tutor_id', 'infant_id','data'];
    protected $guarded = ['inscripcio_id'];

    /**
     * The function infant() returns a relationship between the current model and the Infant model
     * 
     * @return The infant that is associated with the infant_id
     */
    public function infant() {
        return $this->belongsTo(Infant::class,'infant_id');
    }

    /**
     * The tutor() function returns the tutor that belongs to the student
     * 
     * @return The tutor that is associated with the lesson.
     */
    public function tutor() {
        return $this->belongsTo(Tutor::class,'tutor_id');
    }

    /**
     * The excursio() function returns the relationship between the Excursio model and the Excursio
     * model
     * 
     * @return The relationship between the two models.
     */
    public function excursio() {
        return $this->belongsTo(Excursio::class,'excursio_id');
    }
}
