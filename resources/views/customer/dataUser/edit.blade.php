@extends('layout.navbar')
@section('container')
    <div>
        <h1 class="text-center">Edit Data</h1><br />
    </div>
    <form id="editForm" class="container">
        @csrf
        <div class="p2">
            <div class="form-group text-start">
                <label for="name" class="m-2">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}">
            </div>
            <div class="form-group text-start">
                <label for="email" class="m-2">Eamil</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}">
            </div>
            <div class="form-group text-start">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $data->alamat }}">
            </div>
            <div class="form-group text-start">
                <label for="telepon">Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $data->telepon }}">
            </div>
            <div class="form-group text-start mt-2">
                <button type="button" class="btn btn-primary" onClick="update()">Save Changes</button>
            </div>
        </div>
    </form>

    <script>
        function update() {
            var name = $("#name").val();
            var email = $("#email").val();
            var alamat = $("#alamat").val();
            var telepon = $("#telepon").val();

            var formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('alamat', alamat);
            formData.append('telepon', telepon);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('customer/update') }}",
                method: "POST",
                data: formData,
                processData: false, // Pastikan Anda menonaktifkan pengolahan data
                contentType: false, // Pastikan Anda menonaktifkan jenis konten
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil diubah!',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    window.location = "{{ route('customer') }}";
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
    </script>
@endsection
