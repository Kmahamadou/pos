<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceItem extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'item_id', 'itemQty',
    ];
}
