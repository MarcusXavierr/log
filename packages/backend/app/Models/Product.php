<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price'
    ];

    //TODO test
    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, 'product_sale_items');
    }

    public function productSaleItem(): HasMany
    {
        return $this->hasMany(ProductSaleItem::class);
    }
}
