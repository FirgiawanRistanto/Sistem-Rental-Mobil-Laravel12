<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'user_id' => 'integer',
            'product_id' => 'integer',
            'sale_date' => 'datetime',
            'amount' => 'float',
        ];
    }
}
