<?php $auth = auth()->user(); ?>

<div class="container-fluid" id="header">
	<div class="col-md-3">
		<div class="home-icon">
			<a href="{{ route('home') }}"><i class="fa fa-home"></i><span>Home</span></a>
		</div>
	</div>
	<div class="col-md-3 col-md-offset-6">
		<div class="auth">
			<p class="text-right"><span class="welcome">Welcome</span> {{ $auth->name }} <i class="fa fa-sun-o"></i></p>
		</div>
		
	</div>
	<div class="container-fluid auth-container">
			
			<ul class="auth-options">
				{{-- <li class="col-md-3">
					<a href="{{ route('manage') }}">
						<span class="row">
							<i class="fa fa-bar-chart"></i>
						</span>
						<span class="row">
							<h5 class="text-center">Dashboard</h5>
						</span>
					</a>
				</li> --}}
				<li class="col-md-3">
					<a href="{{ route('auth.profile', $auth->slug) }}">
						<span class="row">
							<i class="fa fa-user"></i>
						</span>
						<span class="row">
							<h5 class="text-center">Profile</h5>
						</span>
					</a>
				</li>
				{{-- <li class="col-md-3">
					<a href="">
						<span class="row">
							<i class="fa fa-cogs"></i>
						</span>
						<span class="row">
							<h5 class="text-center">Settings</h5>
						</span>

					</a>
				</li> --}}
				<li class="col-md-3">
					<a href="#" class="logout">
						<span class="row">
							<i class="fa fa-times"></i>
						</span>
						<span class="row">
							<h5 class="text-center">Log out</h5>
						</span>
					</a>
				</li>
			</ul>
		</div>
</div>

