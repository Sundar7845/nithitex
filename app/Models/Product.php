<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'category_id',
        'unit',
        'color_id',
        'product_price',
        'product_discount',
        'current_stock',
        'product_sku',
        'tags',
        'product_slug',
        'product_image',
        'product_gallery_image',
        'product_video_url',
        'short_description',
        'long_description',
        'status',
        'is_featured',
        'is_newArrival',
        'is_offers',
        'is_bestSelling',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_by',
        'updated_by',
    ];


    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function color()
    {
        return $this->belongsTo(Colors::class,'color_id','id');
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class,'id','product_id');
    }
}
