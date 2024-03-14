@extends('layout.erp.home')
@section('page')

<a href="{{url('/roles')}}">Manage</a>
<form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
	@csrf
	{!! input_field(["label"=>"Name","name"=>"txtName"]) !!}

	{!! input_button(["type"=>"submit","name"=>"btnCreate","value"=>"Create"]) !!}
</form>

@endsection
