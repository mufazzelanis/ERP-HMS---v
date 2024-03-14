@extends('layout.erp.home')
@section('page')

<a class='btn btn-success' href="{{route('products.index')}}">Manage</a>
<table class='table'>
	<tr><th>Id</th><td>{{$product->id}}</td></tr>
	<tr><th>Name</th><td>{{$product->name}}</td></tr>
	<tr><th>Offer Price</th><td>{{$product->offer_price}}</td></tr>
	<tr><th>Manufacturer Id</th><td>{{$product->manufacturer_id}}</td></tr>
	<tr><th>Regular Price</th><td>{{$product->regular_price}}</td></tr>
	<tr><th>Description</th><td>{{$product->description}}</td></tr>
	<tr><th>Photo</th><td><img src="img/{{$product->photo}}" width="150" /></td></tr>
	<tr><th>Category Id</th><td>{{$product->category_id}}</td></tr>
	<tr><th>Section Id</th><td>{{$product->section_id}}</td></tr>
	<tr><th>Is Featured</th><td>{{$product->is_featured}}</td></tr>
	<tr><th>Star</th><td>{{$product->star}}</td></tr>
	<tr><th>Is Brand</th><td>{{$product->is_brand}}</td></tr>
	<tr><th>Offer Discount</th><td>{{$product->offer_discount}}</td></tr>
	<tr><th>Uom Id</th><td>{{$product->uom_id}}</td></tr>
	<tr><th>Weight</th><td>{{$product->weight}}</td></tr>
	<tr><th>Barcode</th><td>{{$product->barcode}}</td></tr>
	<tr><th>Created At</th><td>{{$product->created_at}}</td></tr>
	<tr><th>Updated At</th><td>{{$product->updated_at}}</td></tr>

</table>

@endsection
