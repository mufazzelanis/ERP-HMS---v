@extends('layout.erp.home')
@section('page')

<a class='btn btn-success' href="{{url('/users')}}">Manage</a>
<form action="{{route('users.update',$user)}}" method="post" enctype="multipart/form-data">
	@csrf
	@method("PUT")
	{!! input_field(["label"=>"Username","name"=>"txtUsername","value"=>$user->username]) !!}
	{!! select_field(["label"=>"Role Id","name"=>"cmbRoleId","table"=>$roles,"value"=>$user->role_id]) !!}
	{!! input_field(["label"=>"Password","name"=>"txtPassword","value"=>$user->password]) !!}
	{!! input_field(["label"=>"Email","name"=>"txtEmail","value"=>$user->email]) !!}
	{!! input_field(["label"=>"Full Name","name"=>"txtFull_name","value"=>$user->full_name]) !!}
	{!! input_field(["label"=>"Created At","name"=>"txtCreated_at","value"=>$user->created_at]) !!}
	{!! input_field(["label"=>"Photo","type"=>"file","name"=>"filePhoto"]) !!}
	{!! input_field(["label"=>"Verify Code","name"=>"txtVerify_code","value"=>$user->verify_code]) !!}
	{!! input_field(["label"=>"Inactive","name"=>"txtInactive","value"=>$user->inactive]) !!}
	{!! input_field(["label"=>"Mobile","name"=>"txtMobile","value"=>$user->mobile]) !!}
	{!! input_field(["label"=>"Updated At","name"=>"txtUpdated_at","value"=>$user->updated_at]) !!}

	{!! input_button(["type"=>"submit","name"=>"btnUpdate","value"=>"Update"]) !!}
</form>

@endsection
