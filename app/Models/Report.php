<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'item_id',
        'admin_id',
        'reason',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
