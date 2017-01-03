<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 - page not found</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100i|Righteous|Secular+One&amp;subset=latin-ext" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="/css/404.css">
</head>
<body>
	<div class="container-fluid 404-wrapper">
		<a class="btn btn-primary return-logo" href="{{ url('/') }}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a>
		<h1 class="text-center">404</h1>
		<h3 class="text-center">The ressource you're looking for is not in existence</h3>
		<p class="text-center"><a href="{{ url('/') }}" class="btn btn-success return">Go Home</a></p>
	</div>
</body>
</html>