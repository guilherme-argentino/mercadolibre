@extends('mercadolibre::layout.angular')
@section('title', 'Products')
@section('content')
<!-- END THEME PANEL -->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{ url('/meli/admin') }}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Products</span>
    </li>
  </ul>
</div>
<h3 class="page-title"> Products</h3>
<div class="row">
  <div class="col-md-12">
    <div class="portlet ">
      <div class="portlet-title">
        <div class="actions">
          <div class="btn-group">
            <a class="btn btn-circle btn-default dropdown-toggle" href="javascript:;" data-toggle="dropdown">
              <i class="fa fa-share"></i>
              <span class="hidden-xs"> Tools </span>
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="javascript:;"> Print Product </a>
              </li>
              <li>
                <a href="javascript:;"> Sync Catalog</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="portlet-body">
        <div class="table-container">
          <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
            <thead>
              <tr role="row" class="heading">
                <th width="1%">
                  <input type="checkbox" class="group-checkable">
                </th>
                <th width="5%"> ID </th>
                <th width="20%"> Product&nbsp;Name </th>
                <th width="10%"> Category </th>
                <th width="5%"> Price </th>
                <th width="5%"> Stock </th>
                <th width="5%"> Sold </th>
                <th width="5%"> Date&nbsp;Stop </th>
                <th width="10%"> Image </th>
                <th width="5%"> Actions </th>
              </tr>
              <tr role="row" class="filter">
                <td></td>
                <td>
                  <input type="text" class="form-control form-filter input-sm" name="product_id">
                </td>
                <td>
                  <input type="text" class="form-control form-filter input-sm" name="product_name">
                </td>
                <td>
                  <select name="product_category" class="form-control form-filter input-sm">
                    <option value="">Select...</option>
                  </select>
                </td>
                <td>
                  <div class="margin-bottom-5">
                    <input type="text" class="form-control form-filter input-sm" name="product_price_from" placeholder="From" />
                  </div>
                  <input type="text" class="form-control form-filter input-sm" name="product_price_to" placeholder="To" />
                </td>
                <td>
                  <div class="margin-bottom-5">
                    <input type="text" class="form-control form-filter input-sm" name="product_stock_from" placeholder="From" />
                  </div>
                  <input type="text" class="form-control form-filter input-sm" name="product_stock_to" placeholder="To" />
                </td>
                <td>
                  <div class="margin-bottom-5">
                    <input type="text" class="form-control form-filter input-sm" name="product_quantity_from" placeholder="From" />
                  </div>
                  <input type="text" class="form-control form-filter input-sm" name="product_quantity_to" placeholder="To" />
                </td>
                <td>
                  <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                    <input type="text" class="form-control form-filter input-sm" readonly name="product_created_from" placeholder="From">
                    <span class="input-group-btn">
                      <button class="btn btn-sm default" type="button">
                      <i class="fa fa-calendar"></i>
                      </button>
                    </span>
                  </div>
                  <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                    <input type="text" class="form-control form-filter input-sm" readonly name="product_created_to " placeholder="To">
                    <span class="input-group-btn">
                      <button class="btn btn-sm default" type="button">
                      <i class="fa fa-calendar"></i>
                      </button>
                    </span>
                  </div>
                </td>
                <td>
                </td>
                <td>
                  <div class="margin-bottom-5">
                    <button class="btn btn-sm btn-success filter-submit margin-bottom">
                    <i class="fa fa-search"></i> Search</button>
                  </div>
                  <button class="btn btn-sm btn-default filter-cancel">
                  <i class="fa fa-times"></i> Reset</button>
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
<script src="{{ asset('angular/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('angular/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
@endsection
@section('script')
<script type="text/javascript">
var Products = function() {
    var e = function() {
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                autoclose: !0
            })
        },
        a = function() {
            var e = new Datatable;
            e.init({
                src: $("#datatable_products"),
                onSuccess: function(e) {},
                onError: function(e) {},
                loadingMessage: "Loading...",
                dataTable: {
                    lengthMenu: [
                        [10, 20, 50, 100, 150],
                        [10, 20, 50, 100, 150]
                    ],
                    pageLength: 10,
                    ajax: {
                        url: "{{ url('meli/admin/get_products') }}",
                    },
                    order: [
                        [1, "asc"]
                    ]
                }
            }), e.getTableWrapper().on("click", ".table-group-action-submit", function(a) {
                a.preventDefault();
                var t = $(".table-group-action-input", e.getTableWrapper());
                "" != t.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", t.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == t.val() ? App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "Please select an action",
                    container: e.getTableWrapper(),
                    place: "prepend"
                }) : 0 === e.getSelectedRowsCount() && App.alert({
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
            a(), e()
        }
    }
}();
jQuery(document).ready(function() {
    Products.init()
});
</script>
@endsection