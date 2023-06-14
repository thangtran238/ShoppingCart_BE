<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productLazada extends Model
{
    use HasFactory;
    protected $table ='productLazada';

    protected $fillable = [
        "Name",
        "Image",
        "Price",
        "Shop"
    ];
}
