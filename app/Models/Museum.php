<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'description',
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

    public function room(){
        return $this->hasMany(Room::class);
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }

    public function museum_tag(){
        return $this->hasMany(Museum_Tag::class);
    }

    public function time_slot_visit(){
        return $this->hasMany(Time_Slot::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}

