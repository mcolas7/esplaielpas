<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;
    protected $table = 'monitors';
    protected $primaryKey = 'monitor_id';
    protected $fillable = ['persona_id','grup_id'];
    protected $guarded = ['monitor_id'];

    /**
     * This function returns the relationship between the current model and the model specified in the
     * first parameter.
     * 
     * @return The relationship between the two models.
     */
    public function persona() {
        return $this->belongsTo(Persona::class,'persona_id');
    }
}
