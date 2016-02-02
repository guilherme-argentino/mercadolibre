@extends('mercadolibre::layout.master')
@section('title', 'Dashboard')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Dashboard</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">  
  <div class="col-lg-4 col-md-4">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-check fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge">{{ $profile->seller_reputation->transactions->completed }}</div>
                      <div>Total Order Completed</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-4 col-md-4">
      <div class="panel panel-red">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-times fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge">{{ $profile->seller_reputation->transactions->canceled }}</div>
                      <div>Total Order Cancel</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-4 col-md-4">
      <div class="panel panel-primary">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-shopping-cart fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge">{{ $profile->seller_reputation->transactions->total }}</div>
                      <div>Total Orders</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-9 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Rencent Order
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        Actions
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Update</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> My Reputation
      </div>
      <div class="panel-body">
        <div id="reputation-donut-chart"></div>
      </div>
      <!-- /.panel-body -->
    </div>
  </div>
</div>
@endsection
@section('script')
<!-- DataTables JavaScript -->
<script src="{{ asset('../mercadolibre/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('../mercadolibre/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#dataTables-recent-orders').DataTable({
    ajax: "{{ url('meli/admin/recent_orders') }}",
    order: [[ 0, "desc" ]],
    dom: '<"top"><"clear">',
    responsive: true
  });
  $(function() {
    Morris.Donut({
      element: 'reputation-donut-chart',
      data: [{
        label: "Positive",
        value: {{ isset($profile->seller_reputation->transactions->ratings->positive) ? ($profile->seller_reputation->transactions->ratings->positive * 100) : 0 }}
      }, {
        label: "Negative",
        value: {{ isset($profile->seller_reputation->transactions->ratings->negative) ? $profile->seller_reputation->transactions->ratings->negative * 100 : 0 }}
      }, {
        label: "Neutral",
        value: {{ isset($profile->seller_reputation->transactions->ratings->neutral) ? $profile->seller_reputation->transactions->ratings->neutral * 100 : 0 }}
      }],
      resize: true
    });
  });  
</script>
@endsection