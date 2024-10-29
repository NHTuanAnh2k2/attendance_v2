<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quản lý Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ url('/them-attendance') }}">
                            <button type="button" class="btn btn-primary">Thêm Attendance</button>
                        </a>  
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Tracking image</th>
                            <th scope="col">Student</th>
                            <th scope="col">Teacher</th>
                            <th scope="col">Class</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $a)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $a ->tracking_image_url) }}" width="70px" height="60px">
                                </td>
                                <td>{{ $a -> student -> full_name}}</td>
                                <td>{{ $a -> user -> full_name }}</td>
                                <td>{{ $a -> class -> name }}</td>
                                <td>{{ $a -> time_in }}</td>
                                <td>{{ $a -> time_out }}</td>
                                <td>{{ $a -> type == 1 ? 'Tracking':'Manual' }}</td>
                                <td>
                                    <a href="{{ url('cap-nhat-attendance',['id' => $a ->id]) }}">
                                        <span class="badge text-bg-warning">Update</span>
                                    </a>
                                    
                                    <a href="#" class="delete-btn" data-url="{{ url('xoa-attendance', ['id' => $a->id]) }}">
                                        <span class="badge text-bg-danger">Delete</span>
                                    </a>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                      <script>
                          document.querySelectorAll('.delete-btn').forEach(function (button) {
                              button.addEventListener('click', function (e) {
                                  e.preventDefault();  // Ngăn link thực hiện ngay lập tức
                                  const url = this.getAttribute('data-url'); // Lấy URL từ thuộc tính data-url
                      
                                  Swal.fire({
                                      title: 'Bạn có chắc chắn?',
                                      text: "Bạn muốn xóa tài khoản này!",
                                      icon: 'warning',
                                      showCancelButton: true,
                                      confirmButtonColor: '#3085d6',
                                      cancelButtonColor: '#d33',
                                      confirmButtonText: 'Xóa',
                                      cancelButtonText: 'Hủy'
                                  }).then((result) => {
                                      if (result.isConfirmed) {
                                          window.location.href = url; // Điều hướng tới URL xóa nếu người dùng xác nhận
                                      }
                                  });
                              });
                          });
                      </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
