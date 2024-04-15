<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $fillable=[
        'user_id',
        'type',
        'data',
        'read_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_user')
            ->withPivot('read_at')  // Thêm trường read_at từ bảng trung gian
            ->withTimestamps();     // Đảm bảo Laravel quản lý timestamps trong bảng trung gian
    }
    public function sender(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
