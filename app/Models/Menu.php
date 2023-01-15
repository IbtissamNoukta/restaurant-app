<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug', 'description', 'image', 'price', 'category_id'];

        //use slug instead id for expl in seach
        public function getRouteKeyName(){
            return "slug";
        }

        /**
         * Get the category that owns the Menu
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class);
        }

        /**
         * The sales that belong to the Menu
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function sales(): BelongsToMany
        {
            return $this->belongsToMany(Sales::class);
        }
}
