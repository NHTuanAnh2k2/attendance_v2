<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function danh_sach_students() {
        // Lấy danh sách học sinh và phân trang (10 học sinh mỗi trang)
        $students = Student::paginate(10);  
        return view('hocsinh', compact('students'));
    }
}
