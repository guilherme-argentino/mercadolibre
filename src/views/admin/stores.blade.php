@extends('mercadolibre::layout.angular')
@section('title', 'Stores')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{ url('/meli/admin') }}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Stores</span>
    </li>
  </ul>
</div>
<h3 class="page-title"> Stores</h3>
<div class="row">
  <div class="col-md-12">
    <div class="portlet box blue">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-university"></i>Stores
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"> </a>
        </div>
      </div>
      <div class="portlet-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Site</th>
                <th>Categories</th>
                <th>Position</th>
                <th>Create</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($stores->brands as $brand)
              <tr>
                <td>{{ $brand->official_store_id }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->status }}</td>
                <td>{{ $brand->site_id }} </td>
                <td>
                  @if(!empty($brand->categories_ids))
                  @foreach($brand->categories_ids as $category)
                  {{ $category }}<br>
                  @endforeach
                  @endif
                </td>
                <td>{{ $brand->relevance_position }} </td>
                <td>{{ date('Y-m-d', strtotime($brand->date_created )) }}</td>
                <td>
                  <a href="{{ url('/meli/admin/store') }}/{{ $brand->official_store_id }}" data-toggle="modal" data-target="#store-modal" class="btn btn-sm btn-circle btn-default btn-editable">
                    <i class="fa fa-share"></i> View
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="store-modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <img src="{{ asset('angular/assets/global/img/loading-spinner-grey.gif') }}" alt="" class="loading"> <span> &nbsp;&nbsp;Loading... </span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('script')
  @endsection