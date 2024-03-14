@extends('layout.erp.home')
@section('page')

<a class='btn btn-success' href="{{url('/products')}}">Manage</a>
<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
	@csrf
	{!! input_field(["label"=>"Name","name"=>"txtName"]) !!}
	{!! input_field(["label"=>"Offer Price","name"=>"txtOffer_price"]) !!}
	{!! select_field(["label"=>"Manufacturer Id","name"=>"cmbManufacturerId","table"=>$manufacturers]) !!}
	{!! input_field(["label"=>"Regular Price","name"=>"txtRegular_price"]) !!}
	{!! input_field(["label"=>"Description","name"=>"txtDescription"]) !!}
			{!! input_field(["label"=>"Photo","type"=>"file","name"=>"filePhoto"]) !!}
	{!! select_field(["label"=>"Category Id","name"=>"cmbCategoryId","table"=>$categories]) !!}
	{!! select_field(["label"=>"Section Id","name"=>"cmbSectionId","table"=>$sections]) !!}
	{!! input_field(["label"=>"Is Featured","name"=>"txtIs_featured"]) !!}
	{!! input_field(["label"=>"Star","name"=>"txtStar"]) !!}
	{!! input_field(["label"=>"Is Brand","name"=>"txtIs_brand"]) !!}
	{!! input_field(["label"=>"Offer Discount","name"=>"txtOffer_discount"]) !!}
	{!! select_field(["label"=>"Uom Id","name"=>"cmbUoMId","table"=>$uom]) !!}
	{!! input_field(["label"=>"Weight","name"=>"txtWeight"]) !!}
	{!! input_field(["label"=>"Barcode","name"=>"txtBarcode"]) !!}

	{!! input_button(["type"=>"submit","name"=>"btnCreate","value"=>"Create"]) !!}
</form>

@endsection
