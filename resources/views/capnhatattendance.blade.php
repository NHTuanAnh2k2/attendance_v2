<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cập nhật attendance') }}
        </h2>
    </x-slot>
    <style>
        .img-preview {
            max-width: 300px;
            max-height: 300px;
            margin-top: 10px;
        }
      </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="form-them" action="/cap-nhat-attendance/{{ $a ->id }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-floating mb-3">
                            <img id="image-preview" class="img-preview mb-2" src="{{ asset('storage/' . $a->tracking_image_url) }}"/>
                            <input type="file" class="form-control" value="{{ old('tracking_image_url') }}" id="tracking_image_url" name="tracking_image_url" accept="image/*">
                            <label for="tracking_image_url">Student face</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="student_id" name="student_id" aria-label="Floating label select example">
                                @foreach ($students as $s)
                                    <option value="{{ $s ->id }}" {{ $a ->student_id == $s ->id ? 'selected': '' }}>{{ $s->full_name }}</option>
                                @endforeach
                            </select>
                            <label for="student_id">Student</label>
                          </div>
                          <div class="form-floating mb-3">
                            <select class="form-select" id="user_id" name="user_id" aria-label="Floating label select example">
                                @foreach ($teachers as $t)
                                    <option value="{{ $t ->id }}" {{ $a ->user_id == $t ->id ? 'selected': '' }}>{{ $t->full_name }}</option>
                                @endforeach
                            </select>
                            <label for="user_id">Teacher</label>
                          </div>
                          <div class="form-floating mb-3">
                            <select class="form-select" id="class_id" name="class_id" aria-label="Floating label select example">
                                @foreach ($classes as $c)
                                    <option value="{{ $c ->id }}" {{ $a ->class_id == $c ->id ? 'selected': '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <label for="class_id">Class</label>
                          </div>
                          <div>
                            <label>Type:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="type" id="flexRadioDisabled" {{ old('type', $a ->type) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDisabled">
                                  Tracking
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="type" id="flexRadioCheckedDisabled" {{ old('type',$a ->type) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioCheckedDisabled">
                                  Manual
                                </label>
                              </div>
                          </div>
                          <div class="mt-5 mb-3 d-flex justify-content-center">
                            <button id="submit-btn" type="button" class="btn btn-primary text-center">Cập nhật attendance</button>
                          </div>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.getElementById('submit-btn').addEventListener('click', function (e) {
                            Swal.fire({
                                title: 'Bạn có chắc chắn?',
                                text: "Bạn muốn cập nhật attendance này!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Đúng',
                                cancelButtonText: 'Hủy'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('form-them').submit();
                                }
                            });
                        });
                        // Lắng nghe sự kiện thay đổi file input
        document.getElementById('tracking_image_url').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Lấy file đã chọn
            const preview = document.getElementById('image-preview'); // Thẻ img hiển thị

            if (file) {
                const reader = new FileReader();
                // Khi file đã đọc xong, gán src của img = dữ liệu file
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Hiển thị ảnh sau khi load
                };
                reader.readAsDataURL(file); // Đọc file dưới dạng URL base64
            }
        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>