<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['actual_discount_times','remaining_discount_times','discount_value'];
}
