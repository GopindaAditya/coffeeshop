<div class="text-center">
    <h1>Customer Profil</h1>
</div>
<div class="container">
    <form>
        @csrf
        <div class="card p-3">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" id="name" value ="{{ $data->name }}"@disabled(true)>
                </div>
                <div class="col-md-2">
                    <button>+</button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="email" class="form-control" id="email" value ="{{ $data->email }}"disabled>
                </div>
                <div class="col-md-2">
                    <button>+</button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="textArea" class="form-control" id="alamat" value ="{{ $data->alamat }}"disabled>
                </div>
                <div class="col-md-2">
                    <button>+</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="telepon" value ="{{ $data->telepon }}"disabled>
                </div>
                <div class="col-md-2">
                    <button>+</button>
                </div>
            </div>
            <div id="button"></div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function() {
        $('button').on('click', function(event) {
            event.preventDefault();
            
            var input = $(this).closest('div.row').find('input');
            
            $("#button").html('<button onclick="update()">save changes</button>');
            input.prop('disabled', false);
        });
    });
</script>