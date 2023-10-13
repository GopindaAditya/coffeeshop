@if (count($data) > 0)
{{-- @dd($data) --}}
    <div class="container">
        <table class="table table-success table-striped container mt-5">
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            @foreach ($produk as $menu)
                @php
                    $cartItem = $data->where('id_produk', $menu->id)->first();
                    $total = $cartItem->harga * $cartItem->jumlah;
                @endphp
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $cartItem->harga }}</td>
                    <td>{{ $cartItem->jumlah }}</td>
                    <td>{{ $total }}</td>
                    <td><input type="checkbox" name="check" id="check_{{ $cartItem->id }}" class="item-checkbox"
                            value="{{ $cartItem->id }}"></td>
                </tr>
            @endforeach
        </table>

        <button class="btn btn-warning" onClick="cekout()">Checkout</button>
        <button class="btn btn-danger" onClick="destroy()">Delete</button>
@else
    <p class="container">keranjang kosong</p>
@endif
