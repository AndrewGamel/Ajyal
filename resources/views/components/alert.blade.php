

@if (session()->has($type))
<div class="alert alert-dismissable alert-{{ $type }}">
    <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>
        {!! session()->get($type) !!}
    </strong>
</div>
@endif