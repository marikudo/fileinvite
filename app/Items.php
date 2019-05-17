<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table='items';
    protected $fillable = [
        'title', 'description', 'completed_at','status'
    ];
}
