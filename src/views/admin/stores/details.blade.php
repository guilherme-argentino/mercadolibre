<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">{{ $data['_store']->name }}</h4>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
          <i class="fa fa-cogs"></i> General Info</div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Created</th>
                  <th>Position</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $data['_store']->site_id }}</td>
                  <td>{{ date('Y-m-d', strtotime($data['_store']->date_created)) }}</td>
                  <td>{{ $data['_store']->relevance_position }}</td>
                  <td>
                    @if($data['_store']->status == "active")
                    <button type="button" class="btn btn-success btn-circle"><i class="fa fa fa-check"></i></button>
                    @elseif($data['_store']->status == "offline")
                    <button type="button" class="btn btn-warning btn-circle"><i class="fa fa fa-check"></i></button>
                    @elseif($data['_store']->status == "paused")
                    <button type="button" class="btn btn-warning btn-circle"><i class="fa fa fa-check"></i></button>
                    @elseif($data['_store']->status == "deleted")
                    <button type="button" class="btn btn-danger btn-circle"><i class="fa fa fa-check"></i></button>
                    @else
                    <button type="button" class="btn btn-danger btn-circle"><i class="fa fa fa-check"></i></button>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
          <i class="fa fa-cogs"></i> Category Info</div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Picture</th>
                  <th>Total Items</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data['_categories'] as $id => $category)
                <tr>
                  <td><strong>{{ $category['id'] }}</strong></td>
                  <td>{{ $category['name'] }}</td>
                  <td align="center"><img src="{{ $category['picture'] }}" width="100px" height="100px"></td>
                  <td>{{ $category['total_items_in_this_category'] }}</td>
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
    <div class="col-md-12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
          <i class="fa fa-cogs"></i>Children Categories</div>
          <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="javascript:;" class="remove"> </a>
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Name </th>
                  <th> Total Items </th>
                </tr>
              </thead>
              <tbody>
                @foreach($category['children_categories'] as $children)
                <tr>
                  <td> {{ $children['id'] }} </td>
                  <td> {{ $children['name'] }} </td>
                  <td> {{ $children['total_items'] }} </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn default" data-dismiss="modal">Close</button>
</div>