@extends('layout.navbar')
@section('container')
    <div class="text-center">
        <h1>Pesanan yang perlu dikonfirmasi</h1>
    </div>
    <div id="read" class="mt-3"></div>

    <script>
        $(document).ready(function() {
            read();
        })

        function read() {
            $.get("{{ route('pesanan.read') }}", {}, function(data, status) {
                $("#read").html(data);
            })
        }

        function confirm(id) {
            Swal.fire({
                title: 'Konfirmasi Pesanan',
                text: 'Apakah anda yakin dengan pesanan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6,',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Terima',
                cancelButtonText: 'Tolak',
                customClass: {
                    closeButton: 'swal2-close-button',
                },
                buttonsStyling: true,
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    var status_transaksi = '1';
                    var formData = new FormData();                    
                    formData.append('status_transaksi', status_transaksi);
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ url('/kasir/pesanan/confirm') }}/" + id,
                        method: "POST",
                        data: formData,
                        processData: false, // Pastikan Anda menonaktifkan pengolahan data
                        contentType: false, // Pastikan Anda menonaktifkan jenis konten
                        success: function(response) {
                            console.log(response);                            
                            read();
                            Swal.fire({
                                title: 'Data sudah dikonfirmasi',
                                icon: 'success',
                                timer: 1500,
                                buttons: false,
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.close) {
                    // Code to handle close button (X) click

                } else {
                    var status_transaksi = '-1';
                    var formData = new FormData();
                    formData.append('status_transaksi', status_transaksi);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({

                        url: "{{ url('/kasir/pesanan/confirm') }}/" + id,
                        method: "POST",
                        data: formData,
                        processData: false, // Pastikan Anda menonaktifkan pengolahan data
                        contentType: false, // Pastikan Anda menonaktifkan jenis konten
                        success: function(response) {
                            read();
                            Swal.fire({
                                title: 'Pesanan ditolak',
                                icon: 'success',
                                timer: 1500,
                                buttons: false,
                            });
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
