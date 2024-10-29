<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Face_history extends Model
{
    protected $table='face_history';
    protected $primarykey= 'id';
    public$timestamps= true;
    protected $fillable=[
        'student_id',
        'datetime',
        'tracking_image_url'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
