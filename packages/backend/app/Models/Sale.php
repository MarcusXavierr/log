<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'region',
        'created_at'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_sale_items');
    }

    public function productSaleItems(): HasMany
    {
        return $this->hasMany(ProductSaleItem::class);
    }
}
