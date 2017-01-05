<?php $auth = auth()->user(); ?>
<?php $form = new AdamWathan\Form\FormBuilder; ?>

@extends('layouts.app')

@section('content')

	<div id="profile" class="profile-wrapper">
		<div class="jumbotron container profile-header">
			<div class="row">
				<div class="col-md-2 col-md-offset-1">
					<div class="avatar">
						@if($auth->avatar)
							<img src="/images/{{ $auth->avatar }}" height="160" width="160" alt="" class="responsive-img">
						@else
							<img src="/images/Opi51c7dccf270e0.png" height="160" width="160" alt="" class="responsive-img">
						@endif	
					</div>
				</div>
				<div class="col-md-8 profile-header__avatar-details">
					<span>{{ $auth->name }}</span> 
					<span>{{ $auth->email }}</span>
					<span>@if($auth->active && $auth->has_active_email)<span class="label label-success"> <strong>U</strong>ser is active </span> @else <span class="label label-danger"><strong>U</strong>ser is not active</span>@endif</span>
				</div>
			</div>
		</div>
	</div>

@stop
                                                                        