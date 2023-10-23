<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','image','type_id','isBooked','price','people'];
    
    /**
     * Get the user that owns the rooms
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeRooms()
    {
        return $this->belongsTo(type_rooms::class, 'type_id', 'id');
    }
}
