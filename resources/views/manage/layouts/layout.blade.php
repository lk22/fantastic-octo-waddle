<!DOCTYPE html>
<html lang="en">
<head>
	@include('manage.layouts.head')
</head>
<body>
	<!-- content-wrapper -->
	<div id="wrapper">
	
	<!-- header -->
	@include('manage.layouts.header')

	<!-- sidebar -->
	@include('manage.layouts.sidebar')

	<div class="col-md-11 grey lighten-4 content-wrapper pull-right">
		@yield('content')
	</div>

	</div>
</body>
</html>