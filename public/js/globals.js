/** 
 * global settings for whole application
 */

/** 
 * initialize TinyMCE editor
 */
$(function()
{
	tinymce.init({
		selector: 'textarea.noteEditable',
		menubar: true,
		menu: {
			view: {
				title: 'edit',
				items: 'cut, copy, paste, code'
			},
		},
		plugins: 'code advlist autolink link image lists charmap print preview'
	});
});