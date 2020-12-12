@if(session()->has('success'))
<div class="alert alert-success fade in alert-dismissible show alert-fixed">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" style="font-size:1em">×</span>
    </button>
    <strong>Congrats ! </strong>
    {{ session()->get('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger fade in alert-dismissible show show alert-fixed">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" style="font-size:1em">×</span>
    </button>
    <strong>Whoops !</strong> There were some problems with :<br><br>
    <ul style="margin-bottom:0px">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif