@extends('layout.erp.home')
@section('page')

<a class='btn btn-success' href="{{route('users.create')}}">Create</a><table class='table'>
<tr>
	<th>Id</th>
	<th>Username</th>
	<th>Role Id</th>
	<th>Password</th>
	<th>Email</th>
	<th>Full Name</th>
	<th>Created At</th>
	<th>Photo</th>
	<th>Verify Code</th>
	<th>Inactive</th>
	<th>Mobile</th>
	<th>Updated At</th>

</tr>
@forelse ($users as $user)
<tr>
	<td>{{$user->id}}</td>
	<td>{{$user->username}}</td>
	<td>{{$user->role_id}}</td>
	<td>{{$user->password}}</td>
	<td>{{$user->email}}</td>
	<td>{{$user->full_name}}</td>
	<td>{{$user->created_at}}</td>
	<td><img src="img/{{$user->photo}}" width="150" /> </td>
	<td>{{$user->verify_code}}</td>
	<td>{{$user->inactive}}</td>
	<td>{{$user->mobile}}</td>
	<td>{{$user->updated_at}}</td>

	<td>
	<div>
	<form action="{{route('users.destroy',$user->id)}}" method="post" >
	<a class='btn btn-primary' href="{{route('users.edit',$user->id)}}">Edit<a>
	<a class='btn btn-info' href="{{route('users.show',$user->id)}}">Show<a>
		@csrf
		@method("DELETE")
		<input class='btn btn-danger' type="submit" name="btnDelete" class="btnDelete" data-id="{{$user->id}}"  value="Delete" />
	</form>
	</div>
	</td>
</tr>
@empty
<tr><td colspan="12">No records found</td></tr>
@endforelse
</table>
{{$users->links()}}

@endsection
