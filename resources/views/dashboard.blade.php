<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quản lý tài khoản') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ url('/them-tai-khoan') }}">
                            <button type="button" class="btn btn-primary">Thêm tài khoản</button>
                        </a>  
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">User name</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $tk)
                            <tr>
                                <td>{{ $tk -> user_name }}</td>
                                <td>{{ $tk -> full_name }}</td>
                                <td>{{ $tk -> phone }}</td>
                                <td>{{ $tk -> role == 1 ? 'Amin':'Giao_Vien' }}</td>
                                <td>{{ $tk -> status ==1 ? 'Active': 'Inactive' }}</td>
                                <td>
                                    <a href="{{ url('cap-nhat-tai-khoan',['id' => $tk ->id]) }}">
                                        <span class="badge text-bg-warning">Update</span>
                                    </a>
                                    
                                    <a href="#" class="delete-btn" data-url="{{ url('xoa-tai-khoan', ['id' => $tk->id]) }}">
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
