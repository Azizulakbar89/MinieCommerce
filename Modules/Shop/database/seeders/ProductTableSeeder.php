<?php

namespace Modules\Shop\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Shop\Models\Attribute;
use Modules\Shop\Models\Category;
use Modules\Shop\Models\Tag;
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

        Category::factory()->count(10)->create();

        Tag::factory()->count(10)->create();
    }
}
