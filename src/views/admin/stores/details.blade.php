<div class="row">
  <div class="col-md-4 col-xs-12 "><strong>Site Id:</strong></div>
  <div class="col-md-8">{{ $data['_store']->site_id }}</div>
</div>
<div class="row">
  <div class="col-md-4"><strong>Created:</strong></div>
  <div class="col-md-8">{{ date('Y-m-d', strtotime($data['_store']->date_created)) }}</div>
</div>
<div class="row">
  <div class="col-md-4"><strong>Position:</strong></div>
  <div class="col-md-8">{{ $data['_store']->relevance_position }}</div>
</div>
<div class="row">
  <div class="col-lg-4"><strong>Status:</strong></div>
  <div class="col-lg-8">
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
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Picture</th>
            <th>Total Items</th>
            <th>Children Categories</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data['_categories'] as $id => $category)
          <tr>
            <td><strong>{{ $category['id'] }}</strong></td>
            <td>{{ $category['name'] }}</td>
            <td align="center"><img src="{{ $category['picture'] }}" width="100px" height="100px"></td>
            <td>{{ $category['total_items_in_this_category'] }}</td>
            <td>
              @foreach($category['children_categories'] as $children)
              <ul class="list-unstyled">
                <li><strong>{{ $children['name'] }}</strong> - {{ $children['total_items'] }}</li>
              </ul>
              @endforeach
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>