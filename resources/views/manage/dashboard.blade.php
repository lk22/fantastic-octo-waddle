@extends('manage.layouts.layout')

@section('content')
	
	<!-- card-wrapper -->
	<div class="container-flud grey lighten-4 z-depth-5 card-wrapper">
		
		<!-- users card -->
		<div class="notifier-card card blue-grey darken-1 col-md-4 users-card">
			<div class="card-content white-text">
				<span class="card-title">Users</span>
				@if(count($users))
					<p>You have {{ count($users) }} registered users</p>
				@endif
			</div>
			<div class="card-action">
              <a href="{{ route('manage.users') }}">See all users</a>
            </div>
		</div>

		<!-- notes card -->
		<div class="notifier-card card blue-grey darken-1 col-md-4 notes-card">
			<div class="card-content white-text">
				<span class="card-title">Notes</span>
				@if(count($notes))
					<p>You have {{ count($notes) }} registered notes</p>
				@endif
			</div>
			<div class="card-action">
              <a href="{{ route('manage.notes') }}">See all notes</a>
            </div>
		</div>

		<!-- comments -->
		<div class="notifier-card card blue-grey darken-1 col-md-4 comments-card">
			<div class="card-content white-text">
				<span class="card-title">Comments</span>
				@if(count($comments))
					<p>You have {{ count($comments) }} registered comments</p>
				@endif
			</div>
			<div class="card-action">
              <a href="{{ route('manage.comments') }}">See all comments</a>
            </div>
		</div>

	</div>

	@include('manage.components.table.messages-table')

@stop