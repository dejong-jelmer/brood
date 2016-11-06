@if (Session::has('info'))
    <div class="alert alert-info" role="alert">
        {{ Session::get('info') }}
    </div>
@elseif (Session::has('info_success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('info_success') }}         
    </div>
@elseif (Session::has('info_error'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('info_error') }}
    </div> 
@elseif (Session::has('status'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('status') }}
    </div>             
@endif

