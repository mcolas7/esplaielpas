<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfantSalut extends Model
{
    use HasFactory;
    protected $table = 'infants_salut';
    protected $primaryKey = 'infant_salut_id';
    protected $fillable = ['infant_id', 'alergies', 'alergia'];
    protected $guarded = ['infant_salut_id'];

    public function infant() {
        return $this->belongsTo(Infant::class,'infant_id');
    }
}
