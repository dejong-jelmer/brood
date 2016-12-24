@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible" role="alert" >
        {{ Session::get('info') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@elseif (Session::has('info_success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('info_success') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@elseif (Session::has('info_error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ Session::get('info_error') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div> 
@elseif (Session::has('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('status') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>             
@endif

