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
      display: table-cell;
      vertical-align: middle;
      }
      .content {
      text-align: center;
      display: inline-block;
      }
      .title {
      font-size: 66px;
      padding: 100px 50px;
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
        <a class="btn" href="{!! $auth_url !!}">Login to Mercadolibre</a>
      </div>
    </div>
  </body>
</html>