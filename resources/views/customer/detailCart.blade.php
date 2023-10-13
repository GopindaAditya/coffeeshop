@extends('layout.navbar')
@section('container')
    <h1 class="text-center">Keranjang {{ $user->name }}</h1>
    <div class="text-start container">
        <button class="btn btn-primary"><a href="{{ url('/customer/menu') }}" style="color: white;">Menu</a></button>
    </div>
    <div id="read" class="mt-3 "></div>
    <script>
        $(document).ready(function() {
            read();
        });

        function read() {
            $.get("{{ route('detailCart') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
        
        function destroy() {
            var selectedItems = [];
            $('.item-checkbox:checked').each(function() {
                selectedItems.push($(this).val());
            });

            if (selectedItems.length === 0) {
                alert('Pilih setidaknya satu item untuk dihapus.');
                return;
            }

            // Show confirmation SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus item yang dipilih?',
                text: "Item yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ url('/customer/cart/delete') }}",
                        method: "POST",
                        data: {
                            items: selectedItems
                        },
                        success: function(response) {
                            read();

                            Swal.fire({
                                title: 'Item berhasil dihapus!',
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


        function cekout() {
            var selectedItems = [];
            $('.item-checkbox:checked').each(function() {
                selectedItems.push($(this).val());
            });

            if (selectedItems.length === 0) {
                alert('Pilih setidaknya satu item untuk dihapus.');
                return;
            }

            var formData = {
                items: selectedItems
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/customer/cekout') }}/",
                method: "POST",
                data: JSON.stringify(formData), // Mengonversi objek formData ke dalam format JSON
                contentType: "application/json", // Tentukan tipe konten sebagai JSON
                success: function(response) {
                    read();
                    Swal.fire({
                        icon: 'success',
                        title: 'Tunggu konfirmasi dari kasir',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("#read").html(response);

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection
