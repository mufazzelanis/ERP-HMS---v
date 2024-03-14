@extends('layout.erp.home')
@section('page')

<a href="{{route('roles.create')}}">Create</a><table class='table'>
<tr>
	<th>Id</th>
	<th>Name</th>

</tr>
@forelse ($roles as $role)
<tr>
	<td>{{$role->id}}</td>
	<td>{{$role->name}}</td>

	<td>
	<div style="display:flex;">
	<a style="flex:1 1 0" href="{{route('roles.edit',$role->id)}}">Edit<a>
	<a style="flex:1 1 0" href="{{route('roles.show',$role->id)}}">Show<a>
	<form style="flex:1 1 0" action="{{route('users.destroy',$role->id)}}" method="post" >
		@csrf
		@method("DELETE")
		<input type="submit" name="btnDelete" class="btnDelete" data-id="{{$role->id}}"  value="Delete" />
	</from>
	</div>
	</td>
</tr>
@empty
<tr><td colspan="2">No records found</td></tr>
@endforelse
</table>

@endsection
