<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesificationLoundry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_spesification_loundry',
        'price_kg_loundry',
    ];
}
