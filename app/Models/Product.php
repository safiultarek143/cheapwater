<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const IMAGE_UPLOAD_PATH = 'uploads/products/image/';
    const THUMBNAIL_UPLOAD_PATH = 'uploads/products/image/thumbnail';

    protected $fillable = ['title', 'category_id', 'slug', 'description', 'image', 'price', 'quantity'];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function getImageUrlAttribute(){
        return asset('uploads/products/image/'.$this->image);
    }
    public function getThumbnailUrlAttribute(){
        return asset('uploads/products/image/thumbnail/'.$this->image);
    }
}
