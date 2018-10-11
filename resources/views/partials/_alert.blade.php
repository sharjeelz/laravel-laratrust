@if(session()->has('message.level'))
<div data-dimiss="alert"  class="alert alert-{{ session('message.level') }} " role="alert"  >
{!! session('message.content') !!}
</div>
@endif