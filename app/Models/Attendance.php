<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table='attendance';
    protected $primarykey= 'id';
    public$timestamps= true;
    protected $fillable=[
        'student_id',
        'user_id',
        'class_id',
        'time_in',
        'time_out',
        'tracking_image_url',
        'type',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function class()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
