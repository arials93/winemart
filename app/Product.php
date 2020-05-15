<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'barcode', 'abv', 'image', 'vintage',
        'price', 'sale', 'instock', 'bestseller', 'brand_id',
        'size_id', 'country_id', 'subcate_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'bestseller' => 'boolean'
    ];

    public function size() {
        return $this->belongsTo('App/Size', 'size_id');
    }

    public function country() {
        return $this->belongsTo('App/Country', 'country_id');
    }

    public function brand() {
        return $this->belongsTo('App/Brand', 'brand_id');
    }

    public function sub_category() {
        return $this->belongsTo('App/SubCategory', 'subcate_id');
    }
}
