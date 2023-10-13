<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>                
                <th>Nama Pelanggan</th>
                <th>Id Transaksi</th>
                <th>Id Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($penjualanData as $data)
                @foreach ($data['detail_penjualan'] as $detail)
                    <tr>
                        <td>{{ $data['customer']->name }}</td>
                        <td>{{ $data['penjualan']->id }}</td>
                        <td>{{ $detail->id_menu }}</td>
                        <td>{{ $detail->harga_penjualan }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td><button class="btn btn-warning" id="btn" onClick="confirm({{ $data['penjualan']->id }})">Konfirmasi</button></td>
                    </tr>
                @endforeach
            @endforeach            
        </tbody>
    </table>
</div>
