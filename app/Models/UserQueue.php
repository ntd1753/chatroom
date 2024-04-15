<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQueue extends Model
{
    use HasFactory;
    protected $fillable =[
        'roomId',
        'userId',
        'status',
    ];
    protected $table = 'userqueue';
    public function room()
    {
        return $this->hasOne(Room::class,'id','roomId');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','userId');
    }
}
