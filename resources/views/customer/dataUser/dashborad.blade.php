@extends('layout.navbar')
@section('container')
    <div id="read" class="mt-3"></div>
    <script>
        $(document).ready(function() {
            read();
        });

        function read() {
            $.get("{{ route('customerDetail') }}", {}, function(data, status) {
                $("#read").html(data);
            })
        }

        function edit() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('customer.edit') }}",
                method: "GET",
                data: {},
                success: function(response) {
                    window.location = "{{ route('customer.edit') }}";
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
    </script>
@endsection
