@extends('mercadolibre::layout.master')
@section('title', 'Orders')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Orders</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">

  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Status</th>
        <th>Customer</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Total</th>
        <th>Last Update</th>
        <th>Create</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($orders->results as $order)
      <tr>
        <td><a href="{{  url('/meli/admin/order', ['id'=> $order->id]) }}">{{ $order->id }}</a></td>
        <td>{{ $order->status }}</td>
        <td><strong>{{ $order->buyer->first_name }} {{$order->buyer->last_name }}</strong></td>
        <td>{{ $order->buyer->email }} </td>
        <td>{{ $order->buyer->phone->number }} </td>
        <td>$ {{ number_format($order->total_amount, 2) }}</td>
        <td>{{ date('Y-m-d H:i', strtotime($order->date_last_updated)) }}</td>
        <td>{{ date('Y-m-d H:i', strtotime($order->date_created)) }}</td>
      </tr>
	@endforeach

    </tbody>
  </table>
</div>
@endsection

@section('script')
@endsection