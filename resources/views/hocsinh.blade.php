<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý học sinh') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ url('/them-hoc-sinh') }}">
                            <button type="button" class="btn btn-primary">Thêm học sinh</button>
                        </a>
                    </div>
                    <table class="table table-middel">
                        <thead>
                            <tr>
                                <th scope="col">Student face</th>
                                <th scope="col">Student identification code</th>
                                <th scope="col">Student code</th>
                                <th scope="col">Class</th>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Birth date</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $s)
                                <tr>
                                    <td>
                                        @php
                                            // Tách chuỗi ảnh thành mảng
                                            $images = explode(',', $s->student_face_url);
                                        @endphp
                                        <div id="carousel-{{ $s->id }}" class="carousel slide"
                                            data-bs-touch="false" style="width: 100px; height: 70px;">
                                            <div class="carousel-inner">
                                                @foreach ($images as $key => $image)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="d-block w-100" alt="Ảnh học sinh">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carousel-{{ $s->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carousel-{{ $s->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{ $s->student_identification_code }}</td>
                                    <td>{{ $s->student_code }}</td>
                                    <td>{{ $s->classes->name }}</td>
                                    <td>{{ $s->full_name }}</td>
                                    <td>{{ $s->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                                    <td>{{ $s->birth_date }}</td>
                                    <td>{{ $s->phone }}</td>

                                    <td>{{ $s->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ url('/cap-nhat-hoc-sinh', ['id' => $s->id]) }}">
                                            <span class="badge text-bg-warning">Update</span>
                                        </a>

                                        <a href="#" class="delete-btn"
                                            data-url="{{ url('/xoa-hoc-sinh', ['id' => $s->id]) }}">
                                            <span class="badge text-bg-danger">Delete</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <!-- Hiển thị phân trang -->
                    <div class="d-flex justify-content-center">
                        {{ $students->links() }}
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.querySelectorAll('.delete-btn').forEach(function(button) {
                            button.addEventListener('click', function(e) {
                                e.preventDefault(); // Ngăn link thực hiện ngay lập tức
                                const url = this.getAttribute('data-url'); // Lấy URL từ thuộc tính data-url

                                Swal.fire({
                                    title: 'Bạn có chắc chắn?',
                                    text: "Bạn muốn xóa học sinh này!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Xóa',
                                    cancelButtonText: 'Hủy'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            url; // Điều hướng tới URL xóa nếu người dùng xác nhận
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
