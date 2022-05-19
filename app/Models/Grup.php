<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;
    protected $table = 'grups';
    protected $primaryKey = 'grup_id';
    protected $guarded = ['grup_id','nom'];

    public function infants () {
        return $this->hasMany(Infant::class, 'grup_id');
    }

    public function excursions()
    {
        return $this->belongsToMany(Grups::class,'excursions_grups','grup_id','excursio_id');
    }
}
