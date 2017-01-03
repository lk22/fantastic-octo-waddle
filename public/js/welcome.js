/**
 * functional scripts for the landing page
 */

/**
 * message form sending message
 * @param  {[type]} ) {	var        } [description]
 * @return {[type]}   [description]
 */
$(function() 
{
	var message_form = $('.message_form');
	var firstnameField = message_form.find('.message_form__firstname');
	var lastnameField = message_form.find('.message_form__lastname');
	var emailField = message_form.find('.message_form__email');
	var messageField = message_form.find('.message_form__message');
	var sendBtn = message_form.find('.send-message-btn');
	var modalContent = $('#send_messag-modal').find('.modal-dialog').find('.modal-content').find('.modal-body');

	console.log(modalContent);


	// form submission
	sendBtn.on('click', function(e)
	{
		e.preventDefault();
		var firstnameVal = firstnameField.val();
		var lastnameVal = lastnameField.val();
		var emailVal = emailField.val();
		var messageVal = messageField.val();

		sendAjaxRequestTo(
			window.location.pathname + 'send-message',
			'POST',
			{
				firstname: firstnameVal,
				lastname: lastnameVal,
				email: emailVal,
				message: messageVal
			},
			function(response)
			{
				window.location.replace('/');
			},
			function(response)
			{
				console.log(response);
			}
		)
	});

});