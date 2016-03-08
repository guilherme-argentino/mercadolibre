@extends('mercadolibre::layout.angular')
@section('title', 'Dashboard')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{ url('/meli/admin') }}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Dashboard</span>
    </li>
  </ul>
  <div class="page-toolbar">
    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
      <i class="icon-calendar"></i>&nbsp;
      <span class="thin uppercase hidden-xs"></span>&nbsp;
      <i class="fa fa-angle-down"></i>
    </div>
  </div>
</div>
<h3 class="page-title"> Dashboard</h3>
<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat blue">
      <div class="visual">
        <i class="fa fa-comments"></i>
      </div>
      <div class="details">
        <div class="number">
          <span data-counter="counterup" data-value="{{ $profile->seller_reputation->transactions->completed }}">0</span>
        </div>
        <div class="desc"> New Feedbacks </div>
      </div>
      <a class="more" href="javascript:;"> View more <i class="m-icon-swapright m-icon-white"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat red">
      <div class="visual">
        <i class="fa fa-bar-chart-o"></i>
      </div>
      <div class="details">
        <div class="number">
          <span data-counter="counterup" data-value="{{ $profile->seller_reputation->transactions->canceled }}">0</span>
        </div>
        <div class="desc"> Total Profit </div>
      </div>
      <a class="more" href="javascript:;"> View more
        <i class="m-icon-swapright m-icon-white"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat green">
      <div class="visual">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <div class="details">
        <div class="number">
          <span data-counter="counterup" data-value="{{ $profile->seller_reputation->transactions->total }}">0</span>
        </div>
        <div class="desc"> New Orders </div>
      </div>
      <a class="more" href="javascript:;"> View more
        <i class="m-icon-swapright m-icon-white"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat purple">
      <div class="visual">
        <i class="fa fa-globe"></i>
      </div>
      <div class="details">
        <div class="number"> +
          <span data-counter="counterup" data-value="89"></span>%
        </div>
        <div class="desc"> Brand Popularity </div>
      </div>
      <a class="more" href="javascript:;"> View more
        <i class="m-icon-swapright m-icon-white"></i>
      </a>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="row">
  <div class="col-lg-9 col-md-8">
    <div class="portlet light bordered">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-bar-chart-o fa-fw"></i>
            <span class="caption-subject bold uppercase">Rencent Order</span>
          </div>
          <div class="tools">
            <a href="" class="reload"></a>
          </div>
        </div>
        <!-- /.panel-heading -->
        <div class="portlet-body">
            <div class="row">
                <div class="col-lg-12">
                  <div class="table-responsive">    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-recent-orders">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Status</th>
                          <th>Customer</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Total</th>
                          <th>Create</th>
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
  <div class="col-lg-3 col-md-4">
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-bar-chart-o fa-fw"></i> 
          <span class="caption-subject bold uppercase">My Reputation</span>
        </div>        
      </div>
      <div class="portlet-body">
        <div id="reputation-donut-chart"></div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script_lib')
<script src="{{ asset('angular/assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('script')
<script type="text/javascript">
  $('#dataTables-recent-orders').DataTable({
    ajax: "{{ url('meli/admin/recent_orders') }}",
    order: [[ 0, "desc" ]],
    //dom: '<"top"><"clear">',
    responsive: true,
    pageLength: 10
  });
  $(function() {
    Morris.Donut({
      element: 'reputation-donut-chart',
      data: [
        {
          label: "Neutral",
          value: {{ isset($profile->seller_reputation->transactions->ratings->neutral) ? $profile->seller_reputation->transactions->ratings->neutral * 100 : 0 }}
        },
        {
          label: "Negative",
          value: {{ isset($profile->seller_reputation->transactions->ratings->negative) ? $profile->seller_reputation->transactions->ratings->negative * 100 : 0 }}
        }, 
        {
          label: "Positive",
          value: {{ isset($profile->seller_reputation->transactions->ratings->positive) ? ($profile->seller_reputation->transactions->ratings->positive * 100) : 0 }}
        }
      ],
      resize: true
    });
  });
</script>
@endsection