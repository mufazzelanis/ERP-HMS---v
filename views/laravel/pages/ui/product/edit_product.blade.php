@extends('layout.erp.home')
@section('page')

<a class='btn btn-success' href="{{url('/products')}}">Manage</a>
<form action="{{route('products.update',$product)}}" method="post" enctype="multipart/form-data">
	@csrf
	@method("PUT")
	{!! input_field(["label"=>"Name","name"=>"txtName","value"=>$product->name]) !!}
	{!! input_field(["label"=>"Offer Price","name"=>"txtOffer_price","value"=>$product->offer_price]) !!}
	{!! select_field(["label"=>"Manufacturer Id","name"=>"cmbManufacturerId","table"=>$manufacturers,"value"=>$product->manufacturer_id]) !!}
	{!! input_field(["label"=>"Regular Price","name"=>"txtRegular_price","value"=>$product->regular_price]) !!}
	{!! input_field(["label"=>"Description","name"=>"txtDescription","value"=>$product->description]) !!}
	{!! input_field(["label"=>"Photo","type"=>"file","name"=>"filePhoto"]) !!}
	{!! select_field(["label"=>"Category Id","name"=>"cmbCategoryId","table"=>$categories,"value"=>$product->category_id]) !!}
	{!! select_field(["label"=>"Section Id","name"=>"cmbSectionId","table"=>$sections,"value"=>$product->section_id]) !!}
	{!! input_field(["label"=>"Is Featured","name"=>"txtIs_featured","value"=>$product->is_featured]) !!}
	{!! input_field(["label"=>"Star","name"=>"txtStar","value"=>$product->star]) !!}
	{!! input_field(["label"=>"Is Brand","name"=>"txtIs_brand","value"=>$product->is_brand]) !!}
	{!! input_field(["label"=>"Offer Discount","name"=>"txtOffer_discount","value"=>$product->offer_discount]) !!}
	{!! select_field(["label"=>"Uom Id","name"=>"cmbUoMId","table"=>$uom,"value"=>$product->uom_id]) !!}
	{!! input_field(["label"=>"Weight","name"=>"txtWeight","value"=>$product->weight]) !!}
	{!! input_field(["label"=>"Barcode","name"=>"txtBarcode","value"=>$product->barcode]) !!}

	{!! input_button(["type"=>"submit","name"=>"btnUpdate","value"=>"Update"]) !!}
</form>

@endsection
