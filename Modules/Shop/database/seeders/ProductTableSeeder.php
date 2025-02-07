<?php

namespace Modules\Shop\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\Category;
use Modules\Shop\Models\Tag;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\ProductAttribute;
use Modules\Shop\Models\ProductInventory;
use Illuminate\Database\Eloquent\Model;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        Model::unguard();
        $user = User::first();

        // memanggil model product 
        Attribute::setDefaultAttributes();
        // cari atribut
        $attweight = Attribute::where('code', Attribute::ATTR_WEIGHT)->first();

        Category::factory()->count(10)->create();
        // digunakan untuk mengambil kategori random
        $randomCategoryIDs = Category::all()->random()->limit(2)->pluck('id');

        Tag::factory()->count(10)->create();
        $randomTagIDs =Tag::all()->random()->limit(2)->pluck('id');

        // input data ke table product kondisi
        for ($i = 1; $i <= 10; $i++) {
            $manageStock = (bool)random_int(0,1);

            $product = Product::factory()->create([
                'user_id' => $user->id,
                'manage_stock' => $manageStock,
            ]);

            $product->categories()->sync($randomCategoryIDs);
            $product->tags()->sync($randomTagIDs);


            ProductAttribute::create([
                'product_id' => $product->id,
                'attribute_id' => $attweight->id,
                'integer_value' => random_int(200,200),
            ]);


            if($manageStock){
                ProductInventory::create([
                    'product_id' => $product->id,
                    'qty' => random_int (3,20),
                    'low_stock_threshold' => random_int(1,3),
                ]);
            }
        }
    }
}
