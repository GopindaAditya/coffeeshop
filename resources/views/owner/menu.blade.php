@extends('layout.navbar')
@section('container')
    <h1 class="text-center">Owner Dashbord</h1>
    <div class="form-group text-start container">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
            <input type="text" id="search" oninput="search()" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-default">
        </div>
    </div>
    <div class="text-start d-flex justify-content-end container">            
        <button class="btn btn-danger" onclick="logout()">logout</a></button>
    </div>
    <div id="read" class="mt-3 "></div>
    <div class="text-start container">
        <button class="btn btn-primary" id="addButton" onClick="create()">Tambah Data</button>
    </div>    
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
        });


        function read() {
            $.get("{{ route('owner.read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
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
                url: "{{ url('/owner/menu/search') }}",
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

        function create() {
            $.get("{{ route('create') }}", {}, function(data, status) {
                $("#staticBackdropLabel").html("Tambahkan Menu Baru");
                $("#page").html(data);
                $("#staticBackdrop").modal("show");
            });
        }

        function addProduk() {
            var name = $("#name").val();
            var harga = $("#harga").val();
            var desc = $("#desc").val();
            var kategori = $("#kategori").val();
            var stok = $('#stok').val()
            var foto = $("#foto")[0].files[0];

            var formData = new FormData();
            formData.append('name', name);
            formData.append('harga', harga);
            formData.append('desc', desc);
            formData.append('kategori', kategori);
            formData.append('stok', stok);
            formData.append('foto', foto);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/addProduk') }}",
                method: "POST",
                data: formData,
                processData: false, // Pastikan Anda menonaktifkan pengolahan data
                contentType: false, // Pastikan Anda menonaktifkan jenis konten
                success: function(response) {
                    $(".btn-close").click();
                    read();
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Data berhasil diubah!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }


        function edit(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/edit') }}/" + id,
                method: "GET", // Ubah metode HTTP menjadi POST
                data: {},
                success: function(data, status) {
                    $("#staticBackdropLabel").html("Edit Menu");
                    $("#page").html(data);
                    $("#staticBackdrop").modal("show");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function update(id) {
            var name = $("#name").val();
            var harga = $("#harga").val();
            var desc = $("#desc").val();
            var stok = $("#stok").val();
            var foto = $("#foto")[0].files[0];

            var formData = new FormData();
            formData.append('name', name);
            formData.append('harga', harga);
            formData.append('desc', desc);
            formData.append('stok', stok);
            formData.append('foto', foto);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/update') }}/" + id,
                method: "POST",
                data: formData,
                processData: false, // Pastikan Anda menonaktifkan pengolahan data
                contentType: false, // Pastikan Anda menonaktifkan jenis konten
                success: function(response) {
                    console.log(response);
                    $(".btn-close").click();
                    read();
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Data berhasil diubah!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function destroy(id) {
            var name = $("#name").val();
            var harga = $("#harga").val();
            var desc = $("#desc").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/delete') }}/" + id,
                method: "POST",
                data: {
                    name: name,
                    harga: harga,
                    desc: desc
                },
                success: function(response) {
                    $(".btn-close").click();
                    read();

                    // Show success SweetAlert after deletion
                    // Swal.fire({
                    //     title: 'Data berhasil dihapus!',
                    //     icon: 'success',
                    //     timer: 1500,
                    //     buttons: false,
                    // });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
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
                url: "{{ url('owner/menu/addStok') }}/" + id,
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
                url: "{{ url('owner/menu/minStok') }}/" + id,
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
