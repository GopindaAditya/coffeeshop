<div class="text-center">
    <h1>Customer Profil</h1>
</div>
<table class="table table-success table-striped container mt-5">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Telepon</th>        
        <th>Action</th>        
    </tr>        
        <tr>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->alamat }}</td>                           
            <td>{{ $data->telepon }}</td>                           
            <td>
                <button class="btn btn-primary btn-sm" id="btn" onClick="edit()">Edit</button>                                  
            </td>    
        </tr>        
</table>    