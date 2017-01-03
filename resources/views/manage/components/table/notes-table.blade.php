@if(count($notes))
	<div class="container-fluid grey lighten-4 table-wrapper">
		<span class="loading"><i class="fa fa-cog" aria-hidden="true"></i></span>
		<table class="table table-hover notes-table">
			<thead class="notes-table__header">
				<td>ID</td>
				<td>TITLE</td>
				<td>BODY</td>
				<td>AUTHOR</td>
				<td>REGISTERED AT</td>
				<td>UPDATED AT</td>
			</thead>
			<tbody>
				@foreach($notes as $note)
					<tr class="note-row">
						<td class="note-item">{{ $note->id }}</td>
						<td class="note-item">{{ $note->title }}</td>
						<td class="note-item">{{ $note->body }}</td>
						@if($note->author) <td class="note-item">{{ $note->author->name }}</td> @endif
						<td class="note-item">{{ $note->created_at }}</td>
						<td class="note-item">{{ $note->updated_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{-- <a href="{{ route('manage.users.add-note') }}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">+</i></a> --}}
	</div>
@endif