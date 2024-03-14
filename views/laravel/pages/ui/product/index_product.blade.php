@extends('layout.erp.home')
@section('page')

<a class='btn btn-success' href="{{route('products.create')}}">Create</a><table class='table'>
<tr>
	<th>Id</th>
	<th>Name</th>
	<th>Offer Price</th>
	<th>Manufacturer Id</th>
	<th>Regular Price</th>
	<th>Description</th>
	<th>Photo</th>
	<th>Category Id</th>
	<th>Section Id</th>
	<th>Is Featured</th>
	<th>Star</th>
	<th>Is Brand</th>
	<th>Offer Discount</th>
	<th>Uom Id</th>
	<th>Weight</th>
	<th>Barcode</th>
	<th>Created At</th>
	<th>Updated At</th>

</tr>
@forelse ($products as $product)
<tr>
	<td>{{$product->id}}</td>
	<td>{{$product->name}}</td>
	<td>{{$product->offer_price}}</td>
	<td>{{$product->manufacturer_id}}</td>
	<td>{{$product->regular_price}}</td>
	<td>{{$product->description}}</td>
	<td><img src="img/{{$product->photo}}" width="150" /> </td>
	<td>{{$product->category_id}}</td>
	<td>{{$product->section_id}}</td>
	<td>{{$product->is_featured}}</td>
	<td>{{$product->star}}</td>
	<td>{{$product->is_brand}}</td>
	<td>{{$product->offer_discount}}</td>
	<td>{{$product->uom_id}}</td>
	<td>{{$product->weight}}</td>
	<td>{{$product->barcode}}</td>
	<td>{{$product->created_at}}</td>
	<td>{{$product->updated_at}}</td>

	<td>
	<div>
	<form action="{{route('products.destroy',$product->id)}}" method="post" >
	<a class='btn btn-primary' href="{{route('products.edit',$product->id)}}">Edit<a>
	<a class='btn btn-info' href="{{route('products.show',$product->id)}}">Show<a>
		@csrf
		@method("DELETE")
		<input class='btn btn-danger' type="submit" name="btnDelete" class="btnDelete" data-id="{{$product->id}}"  value="Delete" />
	</form>
	</div>
	</td>
</tr>
@empty
<tr><td colspan="18">No records found</td></tr>
@endforelse
</table>
{{$products->links()}}

@endsection
