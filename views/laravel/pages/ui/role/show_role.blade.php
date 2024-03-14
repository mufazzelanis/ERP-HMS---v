@extends('layout.erp.home')
@section('page')

<a href="{{route('roles')}}">Manage</a>
<table class='table'>
	<tr><th>Id</th><td>{{$role->id}}</td></tr>
	<tr><th>Name</th><td>{{$role->name}}</td></tr>

</table>

@endsection
