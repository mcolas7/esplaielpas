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

    public function infant() {
        return $this->hasOne(Infant::class,'persona_id');
    }

    public function tutor() {
        return $this->hasOne(Tutor::class,'persona_id');
    }

    public function monitor() {
        return $this->hasOne(Monitor::class,'persona_id');
    }

    public function poblacio() {
        return $this->belongsTo(Poblacio::class, 'poblacio_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'persona_id');
    }
}
