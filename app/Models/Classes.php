<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table='classes';
    protected $primarykey= 'id';
    public $timestamps= true;
    protected $fillable=[
        'name',
        'user_id',
        'year_id',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
