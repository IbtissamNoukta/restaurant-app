<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['servant_id', 'total_price',
     'total_recieved', 'change', 'payment_type','payment_status'];

    /**
     * The menus that belong to the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class)->withPivot(['quantity']);
    }

    /**
     * The tables that belong to the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class);
    }

    /**
     * Get the servant that owns the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servant(): BelongsTo
    {
        return $this->belongsTo(Servant::class);
    }

}
