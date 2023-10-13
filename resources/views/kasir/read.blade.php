<table class="table table-success table-striped container mt-5">
    <tr>
        <th>Nama</th>
        <th>Desc</th>
        <th>Harga</th>
        <th>Stok</th>        
    </tr>
    @foreach ($data as $menu)
        <tr>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->desc }}</td>
            <td>{{ $menu->harga }}</td>
            <td>
                <button class="btn btn-primary btn-sm" id="btn" onClick="minStok({{ $menu->id }})">-</button>
                {{ $menu->stok }}
                <button class="btn btn-primary btn-sm" id="btn" onClick="addStok({{ $menu->id }})">+</button>          
            </td>            
        </tr>
    @endforeach
</table>

