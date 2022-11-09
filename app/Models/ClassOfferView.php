<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassOfferView extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_offer_id',
        'user_id',
    ];
}
