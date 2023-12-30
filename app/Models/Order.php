<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory,SoftDeletes;

    public function plants()
    {
        return $this->belongsTo(Plant::class,'plant_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
