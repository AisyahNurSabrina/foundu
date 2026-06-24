<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    protected $fillable = ['name', 'location'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
