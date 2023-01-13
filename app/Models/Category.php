<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug'];

    //use slug instead id for expl in seach
    public function getRouteKeyName(){
        return "slug";
    }
    /**
     * Get all of the menus for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menu(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
