<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'shop_categories';
    protected $fillable = ['parent_id', 'slug', 'name'];
    
    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
    /**
     * Relasi ke kategori anak.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    /**
     * Relasi ke kategori induk.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Relasi ke produk melalui tabel pivot.
     */
    public function products()
    {
        return $this->belongsToMany(
            Product::class, // Model yang berelasi
            'shop_categories_products', // Nama tabel pivot
            'category_id', // Foreign key di tabel pivot untuk kategori
            'product_id' // Foreign key di tabel pivot untuk produk
        );
    }

    public static function childIDs($parentID = null)
    {
        $categories = Category::select('id', 'name', 'parent_id')
            ->where('parent_id', $parentID)
            ->get();
        
        $childIDs = [];
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $childIDs[] = $category->id;
                $childIDs = array_merge($childIDs, Category::childIDs($category->id));
            }
        }

        return $childIDs;
    }

    /**
     * Menghubungkan dengan factory untuk seeding.
     */
}
