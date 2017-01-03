/** 
 * header component class
 */

class Header
{
	constructor()
	{
		this.header = $('#header');
		this.authContainer = this.header.find('.auth-container');
		this.authOptions = this.header.find('.auth-options');
	}

	fire()
	{
		let auth = this.header.find('.auth');
		let welcome = auth.find('.welcome');

		welcome.delay(5000).fadeOut();

		auth.click(() => this.authOptions.slideToggle(200));
	}
}


export default Header;