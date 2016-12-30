<?php

namespace App\Models;

use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'qty', 
        'amount', 
        'transaction_id', 
        'product_id', 
        'data', 
        'status'
    ];

    public function transactions() {
    	return $this->belongsTo('\App\Models\Transaction');
    }
    public function products() {
    	return $this->belongsTo('\App\Models\Product', 'product_id');
    }
    
    public function getCreatedAtAttribute( $value ) {
    	return Carbon::parse($value)->format('d/m/Y H:i');
    }
}
