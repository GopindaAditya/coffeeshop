@extends('layout.navbar')
@section('container')
<table class="table table-success table-striped container mt-5">
    <tr>
        <th>Nama</th>
        <th>Desc</th>
        <th>Harga</th>
        <th>Action</th>
    </tr>
    @foreach ($data as $menu)
        <tr>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->desc }}</td>
            <td>{{ $menu->harga }}</td>
            <td>
                <button class="btn btn-warning" id="btn" onClick="show({{ $menu->id }})">Add Chart</button>                 
            </td>
        </tr>
    @endforeach
</table>
@endsection