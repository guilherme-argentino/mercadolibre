@extends('mercadolibre::layout.master')
@section('title', 'Order No. ' . $order->id )
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Order No. {{ $order->id}}</h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Status
      </div>
      <div class="panel-body">
        <strong>Status:</strong> {{ $order->status }}<br>
        <strong>Corrency:</strong> {{ $order->currency_id }}<br>
        <br>
        <strong>Create:</strong> {{ date('Y-m-d H:i:s', strtotime($order->date_created)) }}<br>
        <strong>Last Update:</strong> {{  date('Y-m-d H:i:s', strtotime($order->last_updated)) }}<br>
        <strong>Close:</strong> {{ date('Y-m-d H:i:s', strtotime($order->date_closed)) }}<br>
        <div>
          @foreach ($order->tags as $tag)
            @if ( $tag == 'not_delivered')
              No Delivered <br>
            @elseif ($tag == 'paid')
              Paid<br>
            @else
            Complete<br>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Customer
      </div>
      <div class="panel-body">
        <strong>Name:</strong> {{ $order->buyer->first_name }} {{ $order->buyer->last_name }}<br>
        <strong>Email:</strong> {{ $order->buyer->email }}<br>
        <strong>Phone:</strong> {{ ($order->buyer->phone->area_code != '') ? '(' . $order->buyer->phone->area_code . ')' : '' }} {{ $order->buyer->phone->number }} @if ( $order->buyer->phone->extension != '') Ext. {{ $order->buyer->phone->extension }} @endif
        @if(isset($order->buyer->alternative_phone->area_code) && !empty($order->buyer->alternative_phone->number))
        / {{ ($order->buyer->alternative_phone->area_code != '') ? '(' . $order->buyer->alternative_phone->area_code . ')' : '' }} {{ $order->buyer->alternative_phone->number }} @if ( $order->buyer->alternative_phone->extension != '') Ext. {{ $order->buyer->alternative_phone->extension }} @endif<br>
        @endif
        <br>        
      </div>
      <div class="panel-footer">
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Payment
      </div>
      <div class="panel-body">
        <div class="row">
          
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Payment Method</th>
                <th>MSI</th>
                <th>Currency</th>
                <th>Type</th>
                <th>Status</th>
                <th>Status Detail</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->payments as $payment)
              <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->payment_method_id }} </td>
                <td>{{ ($payment->installments != '') ? $payment->installments : 'N/A' }}</td>
                <td>{{ $payment->currency_id }}</td>
                <td>{{ $payment->payment_type }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->status_detail }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Shipping
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <strong>Shipping Type:</strong> {{ isset($order->shipping->shipment_type) ? $order->shipping->shipment_type : '' }}<br>
            <strong>State:</strong> {{ isset($order->shipping->status) ? $order->shipping->status : ''  }}<br>
            <strong>Mode:</strong> {{ isset($order->shipping->mode) ? $order->shipping->mode : '' }}<br>
            <strong>Shipping:</strong> {{ isset($order->shipping->shipping_mode) ? $order->shipping->shipping_mode : '' }}<br><br>
            @if(isset($order->shipping->receiver_address))
            <p>
              <strong>Receiver:</strong> {{ ($order->shipping->receiver_address->receiver_name != '') ? $order->shipping->receiver_address->receiver_name : '' }} <br> 
              <strong>Phone:</strong> {{ ($order->shipping->receiver_address->receiver_phone != '') ? $order->shipping->receiver_address->receiver_phone : '' }} <br><br>
              <strong>Address:</strong><br>
              {{ $order->shipping->receiver_address->street_name }} No. Ext {{ ($order->shipping->receiver_address->street_number != '') ? $order->shipping->receiver_address->street_number . ', ' : 'S/N' }}
              {{ ($order->shipping->receiver_address->neighborhood->name != '') ? $order->shipping->receiver_address->neighborhood->name . ',' : '' }} 
              {{ ($order->shipping->receiver_address->municipality->name != '') ? $order->shipping->receiver_address->municipality->name . ',' : '' }} 
              {{ ($order->shipping->receiver_address->zip_code != '') ? $order->shipping->receiver_address->zip_code . ',' : '' }} 
              {{ ($order->shipping->receiver_address->state->name != '') ? $order->shipping->receiver_address->state->name . ',' : '' }}  
              {{ ($order->shipping->receiver_address->city->name != '') ? $order->shipping->receiver_address->city->name : '' }}  <br>
            </p>
            @endif
          </div>
        </div>
        @if(isset($order->shipping->shipping_items))
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Description</th>
              <th>Quantity</th>
              <th>Dimensions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($order->shipping->shipping_items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->description }} </td>
                <td>{{ $item->quantity }}</td>
                <td>{{ ($item->dimensions != '') ? $item->dimensions : 'N/A' }}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
        @else
        <p class="text-center">No Items</p>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Items
      </div>
      <div class="panel-body">      
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Category</th>
              <th>Status</th>
              <th>Variation</th>
              <th>Currency</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order->order_items as $item)
            <tr>
              <td>{{ $item->item->id }}</td>
              <td>{{ $item->item->title }}</td>
              <td>{{ $item->item->category_id }}</td>
              <td>{{ $order->status }}</td>
              <td>{{ $item->item->variation_id }}</td>
              <td>{{ $item->currency_id }}</td>
              <td>{{ $item->quantity }}</td>
              <td>$ {{ number_format($item->unit_price, 2) }}</td>
              <td>$ {{ number_format(($item->unit_price *  $item->quantity), 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        Feedback
      </div>
      <div class="panel-body">
        <h4>Purchase:</h4>
        @if (isset($order->feedback->purchase->id))
        <strong>Id: </strong> {{ $order->feedback->purchase->id }} <br>
        {{-- $order->feedback->purchase->fulfilled --}}
        <strong>Date:</strong> {{ date('Y-m-d H:i:s', strtotime($order->feedback->purchase->date_created)) }} <br>
        <strong>Rating:</strong> {{ $order->feedback->purchase->rating }} <br>
        <strong>Status:</strong> {{ $order->feedback->purchase->status }} <br>
        @else
        It has not yet qualified.
        @endif
      </p>
      <h4>Sale: </h4>
      @if (isset($order->feedback->sale->id))
      <strong>Id:</strong> {{ $order->feedback->sale->id }} <br>
      {{--  $order->feedback->sale->fulfilled --}}
      <strong>Date:</strong> {{ date('Y-m-d H:i:s', strtotime($order->feedback->sale->date_created)) }} <br>
      <strong>Rating:</strong> {{ $order->feedback->sale->rating }} <br>
      <strong>Status:</strong> {{ $order->feedback->sale->status }} <br>
      @else
      He will not qualify.
      @endif
    </p>
  </div>
</div>
</div>
<div class="col-lg-6">
<div class="panel panel-primary">
  <div class="panel-heading">
    Totals
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Shipping:</strong></td>
            <td>$ {{ number_format(($order->total_amount_with_shipping - $order->total_amount ), 2) }}</td>
          </tr>
          <tr>
            <td><strong>Subtotal:</strong></td>
            <td>$ {{ number_format($order->total_amount, 2) }}</td>
          </tr>
          <tr>
            <td><strong>Total:</strong></td>
            <td><strong>$ {{ number_format($order->paid_amount, 2) }}</strong></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
@endsection
@section('script')
@endsection