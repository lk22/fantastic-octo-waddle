/**
 * Notifier Helper class
 */

class Helper 
{
	/**
	 * constructor
	 */
	constructor()
	{
		this.setCsrfTokenToRequest($('meta[name="_token"]').attr('content'));
	}

	/** 
	 * set CSRF TOKEN to requests
	 */
	setCsrfTokenToRequest(token)
	{
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': token
			}
		});
	}

	/**
	 * send custom ajax request
	 * @type {String}
	 */
	sendRequestTo(url, type, data = {}, success, error, dataType = 'json')
	{
		$.ajax({
			url: url,
			type: type,
			dataType: dataType,
			data: data,
			success: success,
			error: error
		});
	}

	/** 
	 * open custom modal
	 */
	openModal(modal)
	{
		$(modal).modal('show');
	}

	/**
	 * close shown modal
	 */
	closeModal(modal)
	{
		$(modal).modal('hide');
	}

	/** 
	 * build any list helper 
	 */
	buildWith(element, items, find, appending)
	{

		console.log(items);

		// clear out the element content
		element.find(find).html('');

		// there is any items
		if(items.length > 0)
		{
			// show element and hide loading 
			element.show();
			element.parent().find('.loading').hide();

			// show each item with its data 
			$.each(items, () => {
				element.find(find).append(
					appending.join('\n')
				);
			});
		}
		// if no items fetched
		else
		{
			// hide the list and show loading 
			element.hide();
			element.parent().find('loading').show();
		}

		element.parent().find('loading').hide();
	}
}

export default Helper;