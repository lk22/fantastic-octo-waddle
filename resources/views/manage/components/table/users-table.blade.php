@if(count($users))
	<div class="container-fluid grey lighten-4 table-wrapper">
		<table class="table table-hover users-table">
			<thead class="users-table__header">
				<td>ID</td>
				<td>NAME</td>
				<td>EMAIL</td>
				<td>TOKEN</td>
				<td>REGISTERED AT</td>
				<td>UPDATED AT</td>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr class="user-row">
						<td class="user-item">{{ $user->id }}</td>
						<td class="user-item">{{ $user->name }}</td>
						<td class="user-item">{{ $user->email }}</td>
						<td class="user-item">{{ $user->remember_token }}</td>
						<td class="user-item">{{ $user->created_at }}</td>
						<td class="user-item">{{ $user->updated_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{-- <a href="{{ route('manage.users.add-user') }}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">+</i></a> --}}
	</div>
@endif