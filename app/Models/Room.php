<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- yeh line add karo
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory; 

    protected $fillable = [
        'room_number', 
        'room_type', 
        'capacity', 
        'occupied', 
        'rent', 
        'status', 
        'picture',
        'facilities'
    ];

    public function assignments()
    {
        return $this->hasMany(RoomAssignment::class);
    }

    public function currentStudents()
    {
        return $this->hasMany(RoomAssignment::class)
                   ->where('status', 'active')
                   ->with('student');
    }
}
