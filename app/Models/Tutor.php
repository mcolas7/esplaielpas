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

    public function persona() {
        return $this->belongsTo(Persona::class,'persona_id');
    }

    public function infants()
    {
        return $this->belongsToMany(Infant::class,'tutors_infants','tutor_id','infant_id');
    }

    public function inscripcio() {
        return $this->hasOne(Inscripcio::class,'tutor_id');
    }
}
