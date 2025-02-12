<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Shop\Database\Factories\AddressFactory;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

     protected $table = 'shop_addresses';
    protected $fillable = [];

    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }

}
