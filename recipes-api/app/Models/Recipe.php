<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'likes',
        'readyTime',
        'servings',
        'image',
        'sourceUrl',
        'summary',
        'steps',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class)->as('ingredient')->withPivot('amount');
        // return $this->belongsToMany(Ingredient::class);
    }

    public function cuisines(){
        return $this->belongsToMany(Cuisine::class);
    }

    public function diets(){
        return $this->belongsToMany(Diet::class);
    }

    public function occasions(){
        return $this->belongsToMany(Occasion::class);
    }

    public function dish_types(){
        return $this->belongsToMany(DishType::class);
    }

}
