@extends('layout.navbar')
@section('container')
    <div class="text-center">
        <h1>Kasir Dashboard</h1>
    </div>
    <div class="form-group text-start container">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
            <input type="text" id="search" oninput="search()" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-default">
        </div>
    </div>
    <div class="text-start container">
        <button class="btn btn-primary" ><a href="{{ route('pesanan') }}" style="color: white;">Pesanan</a></button>
    </div>
    <div class="text-start d-flex justify-content-end container">            
        <button class="btn btn-danger" onclick="logout()">logout</a></button>
    </div>
    <div id="read" class="mt-3"></div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="page"></div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            read();

            $("#search").on("input", function() {
                search();
            });
        })

        function read() {
            $.get("{{ route('kasir.read') }}", {}, function(data, status) {
                $("#read").html(data);
            })
        }

        function search() {
            var search = $("#search").val();

            var formData = new FormData();
            formData.append('search', search);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/kasir/menu/search') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Tampilkan hasil pencarian di div dengan id "read"
                    $("#read").html(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function stok(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('kasir/menu/stok') }}/" + id,
                method: "GET", // Ubah metode HTTP menjadi POST
                data: {},
                success: function(data, status) {
                    $("#staticBackdropLabel").html("update Menu");
                    $("#page").html(data);
                    $("#staticBackdrop").modal("show");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        
        function addStok(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('kasir/menu/addStok') }}/" + id,
                method: "POST",
                data: {},
                success: function(response) {
                    console.log(response);
                    // Refresh tampilan setelah stok diperbarui
                    read();
                    // Tampilkan pesan sukses jika diperlukan
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Stok berhasil ditambahkan!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan error jika diperlukan
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function minStok(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('kasir/menu/minStok') }}/" + id,
                method: "POST",
                data: {},
                success: function(response) {
                    console.log(response);
                    // Refresh tampilan setelah stok diperbarui
                    read();
                    // Tampilkan pesan sukses jika diperlukan
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Stok berhasil dikurangi!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan error jika diperlukan
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
        function logout() {
            // Show confirmation SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin ingin logout ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('logout') }}",
                        method: "POST",
                        data: {},
                        success: function(response) {     
                            window.location="{{route("login")}}";
                            // // Show success SweetAlert after deletion
                            // Swal.fire({
                            //     title: 'Logout success!',
                            //     icon: 'success',
                            //     timer: 1500,
                            //     buttons: false,
                            // });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            });
        }
    </script>
@endsection
