
@if(count($messages))
	<div class="container-fluid z-depth-5 table-wrapper">
		<table class="table table-hover messages-table">
			<thead class="messages-table__header">
				<td>FIRSTNAME</td>
				<td>LASTNAME</td>
				<td>EMAIL</td>
				<td>MESSAGE</td>
			</thead>
			<tbody>
				@foreach($messages as $message)
					<tr class="message-row">
						<td class="message-item"> {{ $message->firstname }} </td>
						<td class="message-item"> {{ $message->lastname }} </td>
						<td class="message-item"> {{ $message->email }} </td>
						<td class="message-item"> {{ $message->body }} </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endif
