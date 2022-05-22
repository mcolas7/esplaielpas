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

    /**
     * This function returns all the infants that belong to this group.
     * 
     * @return A collection of Infant objects.
     */
    public function infants () {
        return $this->hasMany(Infant::class, 'grup_id');
    }

    /**
     * The excursions() function returns a collection of excursions that belong to the grup
     * 
     * @return A collection of excursions.
     */
    public function excursions()
    {
        return $this->belongsToMany(Grups::class,'excursions_grups','grup_id','excursio_id');
    }
}
