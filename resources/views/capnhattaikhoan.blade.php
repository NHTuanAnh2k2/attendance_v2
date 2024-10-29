<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cập nhật tài khoản') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="form-capnhat" action="/cap-nhat-tai-khoan/{{ $u ->id }}" method="post">
                        @csrf
                        <div class="form-floating mb-3" style="margin: auto;">
                            <input type="text" class="form-control" value="{{ old('user_name', $u ->user_name) }}" id="user_name" name="user_name" disabled>
                            <label for="user_name">User name</label>
                            @error('user_name')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="full_name" value="{{ old('full_name', $u ->full_name) }}" name="full_name" placeholder="Enter your name">
                            <label for="full_name">Full name</label>
                            @error('full_name')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="phone" value="{{ old('phone', $u ->phone) }}" name="phone" placeholder="Enter your phone">
                            <label for="phone">phone</label>
                            @error('phone')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div>
                            <label>Role:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="role" id="flexRadioDisabled" {{ old('role', $u ->role) ==1 ? 'checked':'' }}>
                                <label class="form-check-label" for="flexRadioDisabled">
                                  Admin
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="role" id="flexRadioCheckedDisabled" {{ old('role',$u ->role)  ==0 ? 'checked':'' }}>
                                <label class="form-check-label" for="flexRadioCheckedDisabled">
                                  Giáo viên
                                </label>
                              </div>
                          </div>
                          <div>
                            <label>Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="status" id="flexRadioDisabled1" {{ old('status',$u ->status) ==1 ? 'checked':'' }}>
                                <label class="form-check-label" for="flexRadioDisabled1">
                                  Active
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="status" id="flexRadioCheckedDisabled1" {{ old('status',$u ->status) ==0 ? 'checked':'' }}>
                                <label class="form-check-label" for="flexRadioCheckedDisabled1">
                                  Inactive
                                </label>
                              </div>
                          </div>
                          <div class="mt-5 mb-3 d-flex justify-content-center">
                            <button id="submit-btn" type="button" class="btn btn-primary text-center">Cập nhật tài khoản</button>
                          </div>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.getElementById('submit-btn').addEventListener('click', function (e) {
                            Swal.fire({
                                title: 'Bạn có chắc chắn?',
                                text: "Bạn muốn cập nhật tài khoản này!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Đúng',
                                cancelButtonText: 'Hủy'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('form-capnhat').submit();
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>