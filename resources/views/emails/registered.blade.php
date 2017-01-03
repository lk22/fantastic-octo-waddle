@extends('layouts.emails.layout')

@section('email-content')
	
	<div class="container-fluid registered-mail-content">
		{{-- <div class="founder-row">
			<img src="{{ url('/') }}/images/leo.jpg" alt="CEO & Founder of Notifier ApS" height="150" width="150">
			<p>Leo Knudsen</p>
			<p>CEO & FOUNDER</p>
			<p>Notifier ApS</p>
			<p>leo@notifier.com</p>
		</div> --}}
		<div class="welcome-content">
			<h1 class="text-center">Dear {{ $user->name }}</h2>

			@if($user->active && $user->has_active_email)
				<h5>I warmly welcoming you to a new world and experience of note writing.</h5>
				<h5 class="text-center"><strong>I</strong>m glad to have you onboard.</h5> 
				<h5 class="text-center">i hope your going to have great time using the platform.</h5>
				<h5 class="text-center">and will write awesome and useful notes for your general purposes</h5>
				
				<img class="get-started-image" src="{{ url('/') }}/images/get-started2.png" alt="">
				<p>Press the button below to get started with your new work station, enjoy :)</p>

				<a href="#" class="redirect-btn">GET STARTED</a>
			@else

				<div class="founder-row">
					<img src="{{ url('/') }}/images/leo.jpg" alt="CEO & Founder of Notifier ApS" height="150" width="150">
					<p>Leo Knudsen</p>
					<p>CEO & FOUNDER</p>
					<p>Notifier ApS</p>
					<p>leo@notifier.com</p>
				</div>

				<h5>Thanks for signing up for Notifier's super awesome note writing software</h5>
				<h5>as a new member we have some things i recommend you to do some things first before we get started</h5>
				<h5>i need to verify and activate your account</h5>
				<h5>click the link below to fully activate your account</h5>
				<a class="redirect-btn" href="{{ route('user.activate') . '/' . bcrypt($user->id) }}">ACTIVATE ACCOUNT</a>

			@endif	

		</div>
		
	{{-- 		<hr>
			<div class="founder-row">
				<img src="{{ url('/') }}/images/leo.jpg" alt="CEO & Founder of Notifier ApS" height="150" width="150">
				<span>Leo Knudsen - CEO & FOUNDER - Notifier ApS</span>
			</div>
			<hr> --}}
	</div>

@stop