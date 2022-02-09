<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_Slot_Visit extends Model
{
    use HasFactory;

    /**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
protected $fillable = [
    'museum_id',
    'description',
    'slot_number'
];

/**
 * The attributes that should be hidden for serialization.
 *
 * @var array<int, string>
 */
protected $hidden = [

];

/**
 * The attributes that should be cast.
 *
 * @var array<string, string>
 */
protected $casts = [
];

public function museum(){
    return $this->belongsTo(Museum::class);
}
}
