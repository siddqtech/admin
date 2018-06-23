@if(Session::has('info'))
	<div class="alert alert-success">{{ Session::get('info')}}</div>
@endif
@if(Session::has('error'))
	<div class="alert alert-success">{{ Session::get('error')}}</div>
@endif  