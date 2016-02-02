<!DOCTYPE html>
<html>
  <head>
    <title>Laravel Mercado Libre</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <style>
      html, body {
      height: 100%;
      }
      body {
      margin: 0;
      padding: 0;
      width: 100%;
      display: table;
      font-weight: 100;
      font-family: 'Lato';
      }
      .container {
      text-align: center;
      vertical-align: middle;
      }
      .content {
      text-align: center;
      display: inline-block;
      }
      .content-btn{
        display: block;
        padding: 30px 0;
      }
      .title {
      font-size: 66px;
      padding: 30px 50px;
      }
      .errors {
        text-align: left;
        color: red;
        font-size: 14px;
        font-weight: bold;
        padding: 0 10px;
      }
      .errors span {
        font-size: 16px;
        color: black;
      }
      .btn {
      background: #3498db;
      background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
      background-image: -moz-linear-gradient(top, #3498db, #2980b9);
      background-image: -ms-linear-gradient(top, #3498db, #2980b9);
      background-image: -o-linear-gradient(top, #3498db, #2980b9);
      background-image: linear-gradient(to bottom, #3498db, #2980b9);
      -webkit-border-radius: 28;
      -moz-border-radius: 28;
      border-radius: 28px;
      font-family: Arial;
      color: #ffffff;
      font-size: 20px;
      padding: 10px 20px 10px 20px;
      text-decoration: none;
      }
      .btn:hover {
      background: #3cb0fd;
      background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
      background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
      background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
      background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
      background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
      text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="title">Mercado Libre - Laravel</div>
        @if(isset($auth['error']))
        <div class="errors">
          <h2>Errors</h2>
          <p><span>Error_code:</span> {!! $auth['error'] !!}</p>
          <p><span>Description:</span> {!! $auth['description'] !!}</p>
        </div>
        @endif
        <div class="content-btn">
          <a class="btn" href="{!! $auth['url'] !!}">Login to Mercadolibre</a>
        </div>
      </div>
    </div>
  </body>
</html>