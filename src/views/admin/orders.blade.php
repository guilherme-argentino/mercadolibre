@extends('mercadolibre::layout.angular')
@section('title', 'Orders')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{ url('/meli/admin') }}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Orders</span>
    </li>
  </ul>
</div>
<h3 class="page-title"> Orders</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    <!-- Begin: life time stats -->
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-basket"></i>
          <span class="caption-subject sbold uppercase"> Order Listing </span>
        </div>
        <div class="actions">
          <div class="btn-group">
            <a class="btn btn-circle btn-default dropdown-toggle" href="javascript:;" data-toggle="dropdown">
              <span class="hidden-xs"> Tools </span><i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;"> Export to Excel </a>
              </li>
              <li>
                <a href="javascript:;"> Export to CSV </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div class="table-container">
          <div class="table-actions-wrapper">
            <span></span>
            <select class="table-group-action-input form-control input-inline input-small input-sm">
              <option value="">Select...</option>
              <option value="paid">Paid</option>
              <option value="not_paid">No Paid</option>
              <option value="delivered">Delivered</option>
              <option value="not_delivered">No Delivered</option>
              <option value="claim_closed">Claim Closed</option>
              <option value="claim_opened">Claim Opened</option>
              <option value="not_processed">NO Processed</option>
              <option value="processed">Processed</option>
            </select>
            <button class="btn btn-sm btn-default table-group-action-submit">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <i class="fa fa-check"></i> Submit</button>
          </div>
          <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_orders">
            <thead>
              <tr role="row" class="heading">
                <th width="2%">
                  <input type="checkbox" class="group-checkable">
                </th>
                <th width="5%"> Order&nbsp;# </th>
                <th width="15%"> Purchased&nbsp;On </th>
                <th width="15%"> Customer </th>
                <th width="10%"> Ship&nbsp;To </th>
                <th width="10%"> Base&nbsp;Price </th>
                <th width="10%"> Purchased&nbsp;Price </th>
                <th width="10%"> Status </th>
                <th width="10%"> Actions </th>
              </tr>
              <tr role="row" class="filter">
                <td></td>
                <td>
                  <input type="text" class="form-control form-filter input-sm" name="order_id">
                </td>
                <td>
                  <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_from" placeholder="From">
                    <span class="input-group-btn">
                      <button class="btn btn-sm default" type="button">
                      <i class="fa fa-calendar"></i>
                      </button>
                    </span>
                  </div>
                  <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_to" placeholder="To">
                    <span class="input-group-btn">
                      <button class="btn btn-sm default" type="button">
                      <i class="fa fa-calendar"></i>
                      </button>
                    </span>
                  </div>
                </td>
                <td>
                  <input type="text" class="form-control form-filter input-sm" name="order_customer_name">
                </td>
                <td>
                  <input type="text" class="form-control form-filter input-sm" name="order_ship_to">
                </td>
                <td>
                  <div class="margin-bottom-5">
                    <input type="text" class="form-control form-filter input-sm" name="order_base_price_from" placeholder="From" />
                  </div>
                  <input type="text" class="form-control form-filter input-sm" name="order_base_price_to" placeholder="To" />
                </td>
                <td>
                  <div class="margin-bottom-5">
                    <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="order_purchase_price_from" placeholder="From" />
                  </div>
                  <input type="text" class="form-control form-filter input-sm" name="order_purchase_price_to" placeholder="To" />
                </td>
                <td>
                  <select name="order_status" class="form-control form-filter input-sm">
                    <option value="">Select...</option>
                    <option value="paid">Paid</option>
                    <option value="not_paid">No Paid</option>
                    <option value="delivered">Delivered</option>
                    <option value="not_delivered">No Delivered</option>
                    <option value="claim_closed">Claim Closed</option>
                    <option value="claim_opened">Claim Opened</option>
                    <option value="not_processed">NO Processed</option>
                    <option value="processed">Processed</option>
                  </select>
                </td>
                <td>
                  <div class="margin-bottom-5">
                    <button class="btn btn-sm btn-success filter-submit margin-bottom"> <i class="fa fa-search"></i> Search</button>
                  </div>
                  <button class="btn btn-sm btn-default filter-cancel"> <i class="fa fa-times"></i> Reset</button>
                </td>
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
@endsection
@section('script_lib')
<script src="{{ asset('angular/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('script')
<script type="text/javascript">
  var Orders = function() {
    var e = function() {
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                autoclose: !0
            })
        },
        a = function() {
            var e = new Datatable;
            e.init({
                src: $("#datatable_orders"),
                onSuccess: function(e) {},
                onError: function(e) {},
                loadingMessage: "Loading...",
                dataTable: {
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 10,
                    ajax: {
                        url: "{{ url('meli/admin/get_orders') }}"
                    },
                    order: [
                        [1, "asc"]
                    ]
                }
            }), e.getTableWrapper().on("click", ".table-group-action-submit", function(a) {
                a.preventDefault();
                var t = $(".table-group-action-input", e.getTableWrapper());
                "" != t.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", t.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == t.val() ? alert({
                    type: "danger",
                    icon: "warning",
                    message: "Please select an action",
                    container: e.getTableWrapper(),
                    place: "prepend"
                }) : 0 === e.getSelectedRowsCount() && alert({
                    type: "danger",
                    icon: "warning",
                    message: "No record selected",
                    container: e.getTableWrapper(),
                    place: "prepend"
                })
            })
        };
    return {
        init: function() {
            e(), a()
        }
    }
}();
jQuery(document).ready(function() {
    Orders.init()
});
</script>
@endsection