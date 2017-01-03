/** 
 * notelist component
 */

import Helper from '../Helper.js';

class NoteList 
{
	/** 
	 * Constructor
	 */
	constructor()
	{
		this.helper = new Helper;
		this.notes = Notifier.notes;
		console.log(this.notes);
		this.noteList = $('.notes-lists-table');
		this.table = this.noteList.find('#table-wrapper');
		this.trashbtn = this.noteList.find('.show-trash');

		this.tableRow = this.table.find('.note-row');
		this.toggleableTableData = this.tableRow.find('.trash');
	}

	/**
	 * fire events for list
	 */
	fire()
	{

		// /**
		//  * building list
		//  * @type {String}
		//  */
		// this.helper.buildWith(
		// 	this.noteListTable,
		// 	this.notes,
		// 	'tbody',
		// 	[
		// 		'<tr class="note-row">',
		// 			'<td class="icon"><a href=""><i class="fa fa-sticky-note-o"></i> ' + this.notes.title + '</a></td>',
		// 			'<td class="note-file-content">' + this.notes.body + ' </td>',
		// 			'<td class="trash"><a class="remove-note" href="#"><i class="fa fa-trash"></i></a></td>',
		// 		'</tr>'
		// 	]
		// );
		// 
		

		/**
		 * event on clicking trash button
		 * @param  {[type]} (e) [description]
		 * @return {[type]}     [description]
		 */
		$('.show-trash').click((e) =>  {
			e.preventDefault();

			// show trash icon link
			$(this).each( function() {
				this.toggleableTableData.toggleClass('show');
			});

			// change button text
			if(this.toggleableTableData.hasClass('show'))
			{
				$(this).text('Cancel');
			}
			else
			{
				$(this).text('remove');
			}
		});

		/**
		 * removing note 
		 */
		$('.remove-note').click( (e) => {
			console.log($('.remove-note').attr('href'));
			e.preventDefault();

			$.ajax({
				url: $('.remove-note').attr('href'),
				type: 'POST',
				data: {},
				success: () => setTimeout(() => window.location.reload() ),
				error: (response) => console.log(response) 
			});
		});
	}
}

export default NoteList;