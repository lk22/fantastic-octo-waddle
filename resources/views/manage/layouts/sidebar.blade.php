<div class="col-md-1 z-depth-3" id="sidebar">
	<ul class="navigation-list">
		<li class="list-item"><a href="{{ route('manage') }}">DASHBOARD</a></li>
		{{-- <li class="list-item"><a href="{{ route('manage.users') }}">USERS</a></li> --}}
		<li class="list-item"><a href="{{ route('manage.notes') }}">NOTES</a></li>
		<li class="list-item"><a href="{{ route('manage.comments') }}">COMMENTS</a></li>
		{{-- <li class="list-item"><a href="">CATEGORIES</a></li> --}}
		{{-- <li class="list-item"><a href="{{ route('manage.messages') }}">MESSAGES</a></li>		 --}}
	</ul>
	<hr>

	<!-- needs to add avatar to user -->
	<div class="auth-avatar-container">
		<div class="row">
			@if(auth()->user())
				<img class="center-block img img-circle" src="{{ Auth::user()->avatar }}" height="75" width="75" alt="">
			@endif
		</div>
		<div class="row">
			<p class="text-center">{{ auth()->user()->name }}</p>
		</div>
	</div>

	<ul class="navigation-list">
		<li class="list-item"><a href="{{ route('logout') }}">Log Out</a></li>
	</ul>
</div>