<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductsCategory.
 *
 * @package namespace App\Models;
 */
class ProductsCategory extends Model
{
    protected $table = 'products_categories';
    protected $perPage = 5;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];


}
