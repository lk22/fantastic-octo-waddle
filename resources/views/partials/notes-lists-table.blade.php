@if(count($notes))

	<div class="container notes-lists-table">	
	<p><strong>O</strong>verwiew</p>
	<hr>
		<table class="table table-hover" id="table-wrapper">
			<tbody>
				@foreach($notes as $note)
					<tr class="note-row">
						<td class="icon"><a href=""><i class="fa fa-sticky-note-o"></i> {{ $note->title }} </a></td>
						<td class="note-file-content"> {{ substr($note->body, 0, 110) }} </td>
						<td class="trash"><a class="remove-note" href="{{ route('remove.note', $note->id) }}"><i class="fa fa-trash"></i></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<a href="#" class="btn btn-primary btn-sm new">New note</a>
		<a href="#" class="show-trash btn btn-primary btn-sm">Remove</a>
		<textarea name="" class="noteEditable" cols="30" rows="10"></textarea>
	</div>

@else

	<div class="container-fluid get-started-wrapper">
		<div class="col-md-6 get-started__left">
			<img height="631" width="631" src="/images/get-started.png" alt="">
		</div>
		<div class="col-md-6 get-started__right">
			
			<h2>Your Noteblock is all clean</h2>
			
			<p>You are ready to start writing fresh notes on your next journey</p>

			<div class="get-started__btn-block">
				<a href="" class="btn btn-primary get-started-btn">Get started <i class="fa fa-pencil"></i></a>
			</div>
		</div>
	</div>

@endif