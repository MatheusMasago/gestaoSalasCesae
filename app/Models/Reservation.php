<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'id_room');  // Assumindo que a chave estrangeira é 'id_room'
    }
}
