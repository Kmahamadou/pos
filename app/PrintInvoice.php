<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintInvoice extends Model
{
    
    protected $fillable = [
    	'invoice_id',
    	'cart_ids',
    ];

    protected $casts = [
    	'cart_ids' => 'array',
    ];
}
