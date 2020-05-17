<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'phone', 'email', 'total',
        'notes', 'user_id', 'comfirm', 'delivery_date', 'receiving_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'delivery_date' => 'datetime',
        'receiving_date' => 'datetime',
        'comfirm' => 'boolean',
    ];

    public function details()
    {
        return $this->hasMany('App\DetailOrder', 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
