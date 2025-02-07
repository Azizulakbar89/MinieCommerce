<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Shop\Database\Factories\ProductImageFactory;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'shop_product_images';

    protected $fillable = [
        'product_id',
        'name',
    ];

    protected static function newFactory(): ProductImageFactory
    {
        return ProductImageFactory::new();
    }
}
