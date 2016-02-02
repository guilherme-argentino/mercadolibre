@extends('mercadolibre::layout.master')
@section('title', 'Products')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Products</h1>
  </div>
</div>
<div class="row">
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Sold</th>
          <th>Category</th>
          <th>Image</th>
          <th>Url</th>
          <th>Stop</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products->results as $product)
        <tr>
          <td><a href="{{  url('/meli/admin/product', ['id'=> $product->id]) }}">{{ $product->id }}</a></td>
          <td>{{ $product->title }}</td>
          <td>$ {{ number_format($product->price, 2) }}</td>
          <td>{{ $product->available_quantity }}</td>
          <td>{{ $product->sold_quantity }} </td>
          <td>{{ $product->category_id }}</td>
          <td><img src="{{ $product->thumbnail }}"></td>
          <td><a href="{{ $product->permalink }}">View</a></td>
          <td>{{ date('Y-m-d H:i', strtotime($product->stop_time)) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
@section('script')
@endsection