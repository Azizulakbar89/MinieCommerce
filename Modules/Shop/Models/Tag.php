<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\Factories\TagFactory;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'shop_tags';

    protected $fillable = [
        'slug',
        'name',
    ];

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany('Modules\Shop\Models\Product', 'shop_products_tags', 'tag_id', 'product_id');
    }
}
