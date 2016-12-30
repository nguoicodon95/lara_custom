<?php

namespace App\Models;

use \Carbon\Carbon;
use App\Models\AbstractModel;

class Transaction extends AbstractModel
{
  protected $table = 'transactions';
  protected $fillable = ['viewed'];
  protected $editableFields = [
    'name', 
    'email', 
    'phone', 
    'address', 
    'messages', 
    'amount', 
    'status'
  ];

  public function orders() {
    return $this->hasMany('\App\Models\Order');
  }

}
