<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'hover_image',
        'name',
        'price',
        'description',
        'discount_price',
        'slug',
        'quantity',
        'outof_stock',
        'show_sale_product',
        'show_favourite_product',
        'show_selection_product',
        'showon_women_page',
        'showon_men_page',
        'showon_discovery_page',
        'showon_sale_page',
        'showon_collection_page',
        'showon_explore_page',
    ];

     public function options()
    {
        return $this->hasMany(Option::class, 'product_id');
    }
}
