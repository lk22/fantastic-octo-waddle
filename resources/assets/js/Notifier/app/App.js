/**
 * app home class
 */

import Helper from '../Helper.js';
import Header from '../components/Header.js';
import NoteList from '../components/NoteList.js';

class App 
{
	/**
	 * constructor
	 */
	constructor()
	{
		// helper class
		this.helper = new Helper;
		this.header = new Header;
		this.noteList = new NoteList;
		// this.notes = Notifer.notes;
		// logout modal
		this.$logoutModal = $('.logout-modal');

		this.fire();
		this.header.fire();
		this.noteList.fire();
	}

	checkEthernetStatus()
	{
		let $connection_container = $('.connection-error-container');
		const client = navigator;
		
		if(client.onLine === false)
		{
			$connection_container.show();
			for(var time = 5; time >= 5; time--)
			{
				$connection_container.html('<p class="text-center">Your are currently offline were trying to recconect hang on.</p>');

				if (time < 1) 
				{
					$.ajax({
						url: window.location.url,
						type: "GET",
						success: function(){
							window.location.reload(1);
						},
						error: function(response) {
							$error_container.html('<p class="text-center">Error: ' + response + '</p>');
						}
					});
				}
			}
			setTimeout(function() {
				window.location.reload(1);
			}, 5000);
		}
	}

	checkBatteryStatus()
	{
		let $error_container = $('.error-container');
	
		navigator.getBattery().then(function(battery) 
		{

			if(battery.level <= 15)
			{
				$error_container.html('<p class="text-center">Your Battery level is below 15% charge your battery now</p>');
			}

			if(battery.charging)
			{
				$error_container.show();
				$error_container.html('<p class="text-center">Charging.</p>');
				
				setTimeout( () => {

					$.ajax(
					{
						url: window.location.url,
						type: "GET",
						success: () => {

							if(battery.level === 100 + Math.floor(battery.level * 100))
							{
								setTimeout( () =>  {
									$error_container.html('<p class="text-center">Your battery is fully charged</p>');
								},0);
							}

							$error_container.html('<p class="text-center">Your Currently battery level is ' + Math.floor(battery.level * 100) + '%</p>');
						},
						error: (response) => {
							$error_container.html('<p class="text-center">Error: ' + response + '</p>');
						}

					});

				}, 1000);
			}
		});
	}

	/**
	 * fire all events for the app
	 */
	fire()
	{

		this.checkEthernetStatus();
		this.checkBatteryStatus();

		/** open logout modal */
		$('.logout').click( () => {
			this.helper.openModal('.logout-modal');
		});

	}
}
 
new App;

export default App;