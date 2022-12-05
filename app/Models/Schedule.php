<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'adopt_id',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'animal_id',
        'animal_name',
        'address',
        'appointment',
    ];
}
