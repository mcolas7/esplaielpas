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


    public function infant() {
        return $this->belongsTo(Infant::class,'infant_id');
    }

    public function tutor() {
        return $this->belongsTo(Tutor::class,'tutor_id');
    }

    public function excursio() {
        return $this->belongsTo(Excursio::class,'excursio_id');
    }
}
