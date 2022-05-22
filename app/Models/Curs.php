<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curs extends Model
{
    use HasFactory;
    protected $table = 'cursos';
    protected $primaryKey = 'curs_id';
    protected $guarded = ['curs_id','nom'];

    /**
     * This function returns all the infants that belong to this course.
     * 
     * @return collection of Infant objects.
     */
    public function infants () {
        return $this->hasMany(Infant::class, 'curs_id');
    }
}
