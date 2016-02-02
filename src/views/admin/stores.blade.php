@extends('mercadolibre::layout.master')
@section('title', 'Stores')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Stores</h1>
  </div>
</div>
<div class="row">
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Status</th>
        <th>Site</th>
        <th>Categories</th>
        <th>Position</th>
        <th>Create</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($stores->brands as $brand)
      <tr>
        <td>
          <a href="" data-toggle="modal" data-target="#store-modal" data-store-id="{{ $brand->official_store_id }}" data-store-name="{{ $brand->name }}">
            {{ $brand->official_store_id }}
          </a>
        </td>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->status }}</td>
        <td>{{ $brand->site_id }} </td>
        <td>
          @if(!empty($brand->categories_ids))
            @foreach($brand->categories_ids as $category)
            {{ $category }}<br>
            @endforeach
          @endif
        <td>{{ $brand->relevance_position }} </td>
        <td>{{ date('Y-m-d', strtotime($brand->date_created )) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
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
<script type="text/javascript">
  $('#store-modal').on('show.bs.modal', function (event) {
    var modal = $(this);
    var button = $(event.relatedTarget);

    var storeId = button.data('store-id');
    var storeName = button.data('store-name');

    $.ajax({
      url: "{{ url('/meli/admin/store') }}/" + storeId,
    }).done(function(response) {      
      modal.find('.modal-title').text(storeName);
      modal.find('.modal-body').empty().append(response);
    });
  })
</script>
@endsection