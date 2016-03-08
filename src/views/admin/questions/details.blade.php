@extends('mercadolibre::layout.angular')
@section('title', 'Question')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{ url('/meli/admin') }}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="{{ url('/meli/admin/questions') }}">Questions</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Edit</span>
    </li>
  </ul>
</div>
<h3 class="page-title"> Question Edit</h3>
<div class="row">
  <div class="col-md-12">
    <pre>
    {{ var_dump($product) }}
    </pre>
  </div>
</div>
@endsection