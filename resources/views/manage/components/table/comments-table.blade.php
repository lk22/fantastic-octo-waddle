@if(count($comments))
	<div class="container-fluid z-depth-5 table-wrapper">
		<table class="table table-hover comments-table">
			<thead classs="comments-table__header">
				<td>BODY</td>
				<td>AUTHOR</td>
				<td>REGISTERED AT</td>
				<td>UPDATED AT</td>
			</thead>
			<tbody>
				@foreach($comments as $comment)
					<tr class="comment-row">
						<td class="comment-item"> {{ $comment->body }} </td>
						@if($comment->author) <td class="comment-item"> {{ $comment->author->name }} </td> @endif
						<td class="comment-item"> {{ $comment->created_at }} </td>
						<td class="comment-item"> {{ $comment->updated_at }} </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endif
