<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded;

    public function plants()
    {
        return $this->belongsTo(Plant::class,'plant_id');
    }
    public function tools()
    {
        return $this->belongsTo(Tool::class,'tool_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
