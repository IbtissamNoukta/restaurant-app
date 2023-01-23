<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Table extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status'];

    public function getRouteKeyName(){
        return "slug";
    }

    /**
     * The sales that belong to the Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class);
    }
}
