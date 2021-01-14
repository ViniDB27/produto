<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product.
 *
 * @package namespace App\Models;
 */
class Product extends Model
{
    protected $table = 'products';
    protected $perPage = 5;

    protected $fillable = [
        'name',
        'description',
        'price',
        'amount',
        'category_id',
        'user_id',
    ];


}
