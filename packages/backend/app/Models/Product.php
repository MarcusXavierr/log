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

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, 'product_sale_items');
    }

    public function productSaleItems(): HasMany
    {
        return $this->hasMany(ProductSaleItem::class);
    }
}
