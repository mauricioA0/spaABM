<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Test Photos</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
	<script src="{{ asset('/js/app.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/#">MENU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="/#">List Photos <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="/#_add">Add Photo</a>
    </div>
  </div>
</nav>	
	
	<div id="page_holder" class="container mt-5"></div>
</body>
</html>
