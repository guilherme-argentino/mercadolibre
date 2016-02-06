@extends('mercadolibre::layout.angular')
@section('title', 'Order No. ' . $order->id )
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{ url('/meli/admin') }}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="{{ url('/meli/admin/orders') }}">Order</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>View</span>
    </li>
  </ul>
</div>
<h3 class="page-title"> Order View</h3>
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-settings font-dark"></i>
          <span class="caption-subject font-dark sbold uppercase"> Order #{{ $order->id }}
            <span class="hidden-xs">| {{ date('M d, Y H:i:s', strtotime($order->date_created)) }}</span>
          </span>
        </div>
        <div class="actions">
          <div class="btn-group">
            <a class="btn green btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
              <i class="fa fa-share"></i>
              <span class="hidden-xs"> Tools </span>
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;"> Print Invoices </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div class="tabbable-line">
          <ul class="nav nav-tabs nav-tabs-lg">
            <li class="active">
              <a href="#tab_1" data-toggle="tab"> Details</a>
            </li>
            <li>
              <a href="#tab_2" data-toggle="tab"> Payment</a>
            </li>
            <li>
              <a href="#tab_3" data-toggle="tab"> Credit Memos</a>
            </li>
            <li>
              <a href="#tab_4" data-toggle="tab"> Shipments</a>
            </li>
            <li>
              <a href="#tab_5" data-toggle="tab"> History</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="portlet yellow-crusta box">
                    <div class="portlet-title">
                      <div class="caption">
                        <i class="fa fa-cogs"></i>Order Details
                      </div>
                    </div>
                    <div class="portlet-body">
                      <div class="row static-info">
                        <div class="col-md-5 name"> Order #: </div>
                        <div class="col-md-7 value"> {{ $order->id }}</div>
                      </div>
                      <div class="row static-info">
                        <div class="col-md-5 name"> Order Date & Time: </div>
                        <div class="col-md-7 value">{{ date('M d, Y H:i:s A', strtotime($order->date_created)) }} </div>
                      </div>
                      <div class="row static-info">
                        <div class="col-md-5 name"> Order Status: </div>
                        <div class="col-md-7 value">
                          <span class="label label-success text-capitalize"> {{ $order->status }} </span>
                        </div>
                      </div>
                      <div class="row static-info">
                        <div class="col-md-5 name"> Grand Total: </div>
                        <div class="col-md-7 value"> ${{ number_format($order->paid_amount, 2) }} </div>
                      </div>
                      <div class="row static-info">
                        <div class="col-md-5 name"> Payment Information: </div>
                        <div class="col-md-7 value"> {{ isset($order->payments[0]->payment_method_id) ? $order->payments[0]->payment_method_id : 'Unknown' }} </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="portlet blue-hoki box">
                    <div class="portlet-title">
                      <div class="caption">
                      <i class="fa fa-cogs"></i>Customer Information </div>
                    </div>
                    <div class="portlet-body">
                      <div class="row static-info">
                        <div class="col-md-5 name"> Customer Name: </div>
                        <div class="col-md-7 value"> {{ $order->buyer->first_name }} {{ $order->buyer->last_name }} </div>
                      </div>
                      <div class="row static-info">
                        <div class="col-md-5 name"> Email: </div>
                        <div class="col-md-7 value"> {{ $order->buyer->email }} </div>
                      </div>
                      <div class="row static-info">
                        <div class="col-md-5 name"> State: </div>
                        <div class="col-md-7 value"> {{ isset($order->shipping->receiver_address->state->name) ? $order->shipping->receiver_address->state->name : '' }} </div>
                      </div>
                      <div class="row static-info">
                        <div class="col-md-5 name"> Phone Number: </div>
                        <div class="col-md-7 value"> {{ $order->buyer->phone->number }} @if ( $order->buyer->phone->extension != '') Ext. {{ $order->buyer->phone->extension }} @endif</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="portlet green-meadow box">
                    <div class="portlet-title">
                      <div class="caption">
                      <i class="fa fa-cogs"></i>Billing Address </div>
                    </div>
                    <div class="portlet-body">
                      <div class="row static-info">
                        <div class="col-md-12 value">
                          @if($order->shipping->status != 'to_be_agreed')
                          {{ isset($order->shipping->receiver_address->receiver_name) ? $order->shipping->receiver_address->receiver_name : '' }} <br>
                          {{ $order->shipping->receiver_address->street_name }} No. Ext: {{ ($order->shipping->receiver_address->street_number != '') ? $order->shipping->receiver_address->street_number . ', ' : 'S/N' }} <br>
                          {{ ($order->shipping->receiver_address->neighborhood->name != '') ? $order->shipping->receiver_address->neighborhood->name . ',' : '' }} <br>
                          {{ ($order->shipping->receiver_address->municipality->name != '') ? $order->shipping->receiver_address->municipality->name . ',' : '' }}
                          {{ ($order->shipping->receiver_address->zip_code != '') ? $order->shipping->receiver_address->zip_code . ',' : '' }}
                          {{ ($order->shipping->receiver_address->state->name != '') ? $order->shipping->receiver_address->state->name . ',' : '' }}
                          {{ ($order->shipping->receiver_address->city->name != '') ? $order->shipping->receiver_address->city->name : '' }}  <br><br>
                          T: {{ ($order->shipping->receiver_address->receiver_phone != '') ? $order->shipping->receiver_address->receiver_phone : '' }}
                          @else
                          Delivery to be agreed
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="portlet red-sunglo box">
                    <div class="portlet-title">
                      <div class="caption">
                      <i class="fa fa-cogs"></i>Shipping Address </div>
                    </div>
                    <div class="portlet-body">
                      <div class="row static-info">
                        <div class="col-md-12 value">
                          @if($order->shipping->status != 'to_be_agreed')
                          {{ isset($order->shipping->receiver_address->receiver_name) ? $order->shipping->receiver_address->receiver_name : '' }} <br>
                          {{ $order->shipping->receiver_address->street_name }} No. Ext: {{ ($order->shipping->receiver_address->street_number != '') ? $order->shipping->receiver_address->street_number . ', ' : 'S/N' }} <br>
                          {{ ($order->shipping->receiver_address->neighborhood->name != '') ? $order->shipping->receiver_address->neighborhood->name . ',' : '' }} <br>
                          {{ ($order->shipping->receiver_address->municipality->name != '') ? $order->shipping->receiver_address->municipality->name . ',' : '' }}
                          {{ ($order->shipping->receiver_address->zip_code != '') ? $order->shipping->receiver_address->zip_code . ',' : '' }}
                          {{ ($order->shipping->receiver_address->state->name != '') ? $order->shipping->receiver_address->state->name . ',' : '' }}
                          {{ ($order->shipping->receiver_address->city->name != '') ? $order->shipping->receiver_address->city->name : '' }}  <br><br>
                          T: {{ ($order->shipping->receiver_address->receiver_phone != '') ? $order->shipping->receiver_address->receiver_phone : '' }}
                          @else
                          Delivery to be agreed
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="portlet box blue ">
                    <div class="portlet-title">
                      <div class="caption">
                      <i class="fa fa-cogs"></i>Shopping Cart </div>
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
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
                              <td class="text-capitalize">{{ $order->status }}</td>
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
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                      <div class="caption">
                      <i class="fa fa-cogs"></i>Feedback </div>
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Type</th>
                              <th>Date</th>
                              <th>Rating</th>
                              <th>Status</th>
                              <th>Fulfilled</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if (isset($order->feedback->purchase->id))
                            <tr>
                              <td>{{ $order->feedback->purchase->id }}</td>
                              <th class="text-capitalize">purchase</th>
                              <td>{{ date('Y-m-d H:i:s', strtotime($order->feedback->purchase->date_created)) }}</td>
                              <td>{{ $order->feedback->purchase->rating }}</td>
                              <td class="text-capitalize">{{ $order->feedback->purchase->status }}</td>
                              <td>{{ $order->feedback->purchase->fulfilled }}</td>
                            </tr>
                            @else
                            <tr>
                              <td>It has not yet qualified.</td>
                            </tr>
                            @endif
                            @if (isset($order->feedback->sale->id))
                            <tr>
                              <td>{{ $order->feedback->sale->id }}</td>
                              <th class="text-capitalize">sale</th>
                              <td>{{ date('Y-m-d H:i:s', strtotime($order->feedback->sale->date_created)) }}</td>
                              <td>{{ $order->feedback->sale->rating }}</td>
                              <td class="text-capitalize">{{ $order->feedback->sale->status }}</td>
                              <td>{{ $order->feedback->sale->fulfilled }}</td>
                            </tr>
                            @else
                            <tr>
                              <td>It has not yet qualified.</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="well">
                    <div class="row static-info align-reverse">
                      <div class="col-md-8 name"> Sub Total: </div>
                      <div class="col-md-3 value"> ${{ number_format($order->total_amount, 2) }} </div>
                    </div>
                    <div class="row static-info align-reverse">
                      <div class="col-md-8 name"> Shipping: </div>
                      <div class="col-md-3 value"> ${{ number_format(($order->total_amount_with_shipping - $order->total_amount ), 2) }} </div>
                    </div>
                    <div class="row static-info align-reverse">
                      <div class="col-md-8 name"> Total Due: </div>
                      <div class="col-md-3 value"> $ {{ number_format($order->paid_amount, 2) }} </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab_2">
              <div class="table-container">
                <div class="table-actions-wrapper">
                  <span> </span>
                  <select class="table-group-action-input form-control input-inline input-small input-sm">
                    <option value="">Select...</option>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="canceled">Canceled</option>
                  </select>
                  <button class="btn btn-sm yellow table-group-action-submit">
                  <i class="fa fa-check"></i> Submit</button>
                </div>
                <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                  <thead>
                    <tr role="row" class="heading">
                      <th width="5%">
                        <input type="checkbox" class="group-checkable"> </th>
                        <th width="5%"> # </th>
                        <th width="15%"> Payment Method </th>
                        <th width="5%"> MSI </th>
                        <th width="10%"> Currency </th>
                        <th width="10%"> Type </th>
                        <th width="10%"> Status </th>
                        <th width="10%"> Status Detail </th>
                        <th width="10%"> Amount </th>
                        <th width="20%"> Date </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($order->payments as $payment)
                      <tr>
                        <td><input type="checkbox" class="group-checkable" value="{{ $payment->id }}"></td>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->payment_method_id }} </td>
                        <td>{{ ($payment->installments != '') ? $payment->installments : 'N/A' }}</td>
                        <td>{{ $payment->currency_id }}</td>
                        <td>{{ $payment->payment_type }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->status_detail }}</td>
                        <td>${{ number_format($payment->transaction_amount, 2) }}</td>
                        <td>{{ date('Y-m-d H:i:s', strtotime($payment->date_created)) }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="tab_3">
                <div class="table-container">
                  <table class="table table-striped table-bordered table-hover" id="datatable_credit_memos">
                    <thead>
                      <tr role="row" class="heading">
                        <th width="5%"> Credit&nbsp;Memo&nbsp;# </th>
                        <th width="15%"> Bill To </th>
                        <th width="15%"> Created&nbsp;Date </th>
                        <th width="10%"> Status </th>
                        <th width="10%"> Actions </th>
                      </tr>
                    </thead>
                  <tbody> </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab_4">
              <div class="table-container">
                @if(isset($order->shipping->shipping_items))
                <table class="table table-striped table-bordered table-hover" id="datatable_shipment">
                  <thead>
                    <tr role="row" class="heading">
                      <th width="5%"> # </th>
                      <th width="25%"> Description </th>
                      <th width="5%"> Quantity </th>
                      <th width="15%"> Dimensions </th>
                      <th width="5%"> Status </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->shipping->shipping_items as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->description }} </td>
                      <td>{{ $item->quantity }}</td>
                      <td>{{ ($item->dimensions != '') ? $item->dimensions : 'N/A' }}</td>
                      <td>{{ $order->shipping->status }} </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                Delivery to be agreed
                @endif
              </div>
            </div>
            <div class="tab-pane" id="tab_5">
              <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="datatable_history">
                  <thead>
                    <tr role="row" class="heading">
                      <th width="25%"> Date </th>
                      <th width="55%"> Message </th>
                      <th width="10%"> Status </th>
                      <th width="10%"> User </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script_lib')
<script src="{{ asset('angular/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection