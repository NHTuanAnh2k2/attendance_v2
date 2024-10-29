<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table='students';
    protected $primarykey= 'id';
    public$timestamps= true;
    protected $fillable=[

        'class_id',
        'student_identification_code',
        'student_code',
        'full_name',
        'gender',
        'birth_date',
        'birthplace',
        'address',
        'guardian_full_name',
        'guardian_phone',
        'student_face_url',
        'status'
    ];
    public function classes()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }
    public function face_history()
    {
        return $this->hasMany(Face_history::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
