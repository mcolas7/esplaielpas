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

    public function grup() {
        return $this->belongsTo(Grup::class, 'grup_id');
    }

    public function curs() {
        return $this->belongsTo(Curs::class, 'curs_id');
    }

    public function persona() {
        return $this->belongsTo(Persona::class,'persona_id');
    }

    public function infantSalut() {
        return $this->hasOne(InfantSalut::class,'infant_id');
    }

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class,'tutors_infants','infant_id','tutor_id');
    }
}
