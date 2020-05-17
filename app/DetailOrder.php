<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detailorders';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quality', 'price', 'sale', 'total', 'order_id', 'product_id'];

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
