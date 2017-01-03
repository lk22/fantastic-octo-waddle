
function setCsrfTokenToRequest()
{
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	    }
	});
}

/**
 * send ajax request 
 */
function sendAjaxRequestTo(url, type, data, success, error)
{
	$.ajax({
		url: url,
		type: type,
		data: data,
		success: success,
		error: error
	});
}

var home = {

	init: function()
	{
		this.token = $('meta[name=_token"]').attr('content');
		this.$notesList = $('.notes-lists-table');
		this.$noteTable = $notesList.find('#table-wrapper');
		this.

		this.bindEvents();
	}, 

	bindEvents: function()
	{

		var that = this;

		/**
		 * header component actions
		 */
		
			var authContainer = $('.auth-container');
			var $authOptions = authContainer.find('.auth-options');

			$('.welcome').delay(5000).fadeOut();

			// show dropdown
			$('.auth').click(function() 
			{
				$authOptions.slideToggle(200);
			});

			// show logout
			$('.logout').click(function(e) 
			{
				$('.logout-modal').modal('show');
			});	

		/**
		 * 
		 */
		
			var $noteslist = $('.notes-lists-table');
			var $table = $noteslist.find('#table-wrapper');
			var $trashbtn = $noteslist.find('.show-trash');

			var $tableRow = $table.find('.note-row');
			var $toggleableTableData = $tableRow.find('.trash');

			$('.show-trash').click(function(e)
			{

				e.preventDefault();
				
				$(this).each(function()
				{
					$toggleableTableData.toggleClass('show');
				});

				if($toggleableTableData.hasClass('show'))
				{
					$(this).text('Cancel');
				}
				else
				{
					$(this).text('Remove');
				}

			});

			$('.remove-note').click(function(e) 
			{
				e.preventDefault();
				var notes = Notifier.notes;

				var currentUrl = Notifier.current_url;
				var url = $(this).attr('href');

				sendAjaxRequestTo(
					url,
					'POST',
					'',
					function()
					{
						window.location.replace(currentUrl);
					},
					function()
					{

					}
				)
			});

	}

};

/**
 * header component actions
 */
$(function() 
{
	/**
	 * variables
	 */
	var authContainer = $('.auth-container');
	var $authOptions = authContainer.find('.auth-options');

	$('.welcome').delay(5000).fadeOut();

	// show dropdown
	$('.auth').click(function() 
	{
		$authOptions.slideToggle(200);
	});

	// show logout
	$('.logout').click(function(e) 
	{
		$('.logout-modal').modal('show');
	});	
});

/**
 * notes table list features
 */
$(function()
{
	var $noteslist = $('.notes-lists-table');
	var $table = $noteslist.find('#table-wrapper');
	var $trashbtn = $noteslist.find('.show-trash');

	var $tableRow = $table.find('.note-row');
	var $toggleableTableData = $tableRow.find('.trash');

	$('.show-trash').click(function(e)
	{

		e.preventDefault();
		
		$(this).each(function()
		{
			$toggleableTableData.toggleClass('show');
		});

		if($toggleableTableData.hasClass('show'))
		{
			$(this).text('Cancel');
		}
		else
		{
			$(this).text('Remove');
		}

	});

	$('.remove-note').click(function(e) 
	{
		e.preventDefault();
		var notes = Notifier.notes;

		var currentUrl = Notifier.current_url;
		var url = $(this).attr('href');

		sendAjaxRequestTo(
			url,
			'POST',
			'',
			function()
			{
				window.location.replace(currentUrl);
			},
			function()
			{

			}
		)
	});
});