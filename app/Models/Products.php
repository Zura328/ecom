<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'small',
        'medium',
        'large',
        'xlarge',
        'image',
        'gender',
        'season',
        'category',
    ];

    /**
     * Get the orders for the product.
     */
    public function orders()
    {
        return $this->hasMany(Order::class,"product_id");
    }
}
