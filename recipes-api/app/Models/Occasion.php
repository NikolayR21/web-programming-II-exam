<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function recipes(){
        return $this->belongsToMany(Recipe::class);
    }
}
