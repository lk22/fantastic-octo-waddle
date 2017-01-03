<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.emails.head')
</head>
<body>

	<div id="mail-wrapper">

		<div class="container-fluid header">
			<h1 class="text-center">Notifier</h1>
		</div>

		@yield('email-content')

	</div>

</body>
</html>