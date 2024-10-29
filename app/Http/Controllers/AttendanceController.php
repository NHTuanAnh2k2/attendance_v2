<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function view_them_attendance(){
        $students = Student::limit(10)->get();
        $teachers = User::where('role',0)->get();
        $classes = Classes::limit(10)->get();
        return view('themattendance',['students' =>$students, 'teachers' => $teachers,'classes' => $classes]);
    }

    public function them_attendance(Request $request){
        $valiate = $request ->validate(
            [
                'tracking_image_url' => 'required'
            ],
            [
                'tracking_image_url.required' => 'Khong duoc de trong'
            ]
        );
        $attendance = new Attendance($valiate);

        // Lưu ảnh vào thư mục storage/public/images
        $image = $request->file('tracking_image_url');
        $path = $image->store('images', 'public'); // Trả về đường dẫn file
        
        $attendance -> tracking_image_url = $path;
        $attendance -> student_id = $_POST['student_id'];
        $attendance -> user_id = $_POST['user_id'];
        $attendance -> class_id = $_POST['class_id'];
        $attendance -> type = $_POST['type'];
        $attendance -> time_in = now(); 
        $attendance -> time_out = now()->addHours(8);
        $attendance->save();

        return redirect('/attendance');
    }

    public function view_update_attendance($id){
        $students = Student::limit(10)->get();
        $teachers = User::where('role',0)->get();
        $classes = Classes::limit(10)->get();
        $a = Attendance::findOrFail($id);
        return view('capnhatattendance',['students' =>$students, 'teachers' => $teachers,'classes' => $classes, 'a' =>$a]);
    }
    public function update_attendance($id,Request $request){
        $attendance = Attendance::findOrFail($id);

        // Kiểm tra nếu có ảnh mới được upload
        if ($request->hasFile('tracking_image_url')) {
            $file_path = public_path('storage/' . $attendance->tracking_image_url);
            if (file_exists($file_path)) {
                unlink($file_path); // Xóa file
            }
            // Lưu ảnh mới
            $path = $request->file('tracking_image_url')->store('images', 'public');
            $attendance->tracking_image_url = $path;  // Cập nhật đường dẫn ảnh
        }

        $attendance -> student_id = $_POST['student_id'];
        $attendance -> user_id = $_POST['user_id'];
        $attendance -> class_id = $_POST['class_id'];
        $attendance -> type = $_POST['type'];
        $attendance->save();

        return redirect('/attendance');
    }
    public function delete_attendance($id){
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return redirect('/attendance');
    }
}
