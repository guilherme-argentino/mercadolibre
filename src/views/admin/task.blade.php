@extends('mercadolibre::layout.angular')
@section('title', 'Task')
@section('css')
<link href="{{ asset('angular/assets/pages/css/error.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{ url('/meli/admin') }}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Task</span>
    </li>
  </ul>
</div>
<h3 class="page-title"> 404 Page</h3>
<div class="row">
  <div class="col-md-12 page-404">
    <div class="number font-green"> 404 </div>
    <div class="details">
      <h3>Oops! You're lost.</h3>
      <p> We can not find the page you're looking for.<br/> <a href="{{ url('/meli/admin') }}">Home</a> Return home </a> or try the search bar below. </p>
      <form action="#">
        <div class="input-group input-medium">
          <input type="text" class="form-control" placeholder="keyword...">
          <span class="input-group-btn">
            <button type="submit" class="btn green"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection