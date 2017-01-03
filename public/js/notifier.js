(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * Notifier Helper class
 */

var Helper = function () {
	/**
  * constructor
  */
	function Helper() {
		_classCallCheck(this, Helper);

		this.setCsrfTokenToRequest($('meta[name="_token"]').attr('content'));
	}

	/** 
  * set CSRF TOKEN to requests
  */


	_createClass(Helper, [{
		key: 'setCsrfTokenToRequest',
		value: function setCsrfTokenToRequest(token) {
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

	}, {
		key: 'sendRequestTo',
		value: function sendRequestTo(url, type) {
			var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
			var success = arguments[3];
			var error = arguments[4];
			var dataType = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : 'json';

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

	}, {
		key: 'openModal',
		value: function openModal(modal) {
			$(modal).modal('show');
		}

		/**
   * close shown modal
   */

	}, {
		key: 'closeModal',
		value: function closeModal(modal) {
			$(modal).modal('hide');
		}

		/** 
   * build any list helper 
   */

	}, {
		key: 'buildWith',
		value: function buildWith(element, items, find, appending) {

			console.log(items);

			// clear out the element content
			element.find(find).html('');

			// there is any items
			if (items.length > 0) {
				// show element and hide loading 
				element.show();
				element.parent().find('.loading').hide();

				// show each item with its data 
				$.each(items, function () {
					element.find(find).append(appending.join('\n'));
				});
			}
			// if no items fetched
			else {
					// hide the list and show loading 
					element.hide();
					element.parent().find('loading').show();
				}

			element.parent().find('loading').hide();
		}
	}]);

	return Helper;
}();

exports.default = Helper;

},{}],2:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }(); /**
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      * app home class
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      */

var _Helper = require('../Helper.js');

var _Helper2 = _interopRequireDefault(_Helper);

var _Header = require('../components/Header.js');

var _Header2 = _interopRequireDefault(_Header);

var _NoteList = require('../components/NoteList.js');

var _NoteList2 = _interopRequireDefault(_NoteList);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var App = function () {
	/**
  * constructor
  */
	function App() {
		_classCallCheck(this, App);

		// helper class
		this.helper = new _Helper2.default();
		this.header = new _Header2.default();
		this.noteList = new _NoteList2.default();
		// this.notes = Notifer.notes;
		// logout modal
		this.$logoutModal = $('.logout-modal');

		this.fire();
		this.header.fire();
		this.noteList.fire();
	}

	_createClass(App, [{
		key: 'checkEthernetStatus',
		value: function checkEthernetStatus() {
			var $connection_container = $('.connection-error-container');
			var client = navigator;

			if (client.onLine === false) {
				$connection_container.show();
				for (var time = 5; time >= 5; time--) {
					$connection_container.html('<p class="text-center">Your are currently offline were trying to recconect hang on.</p>');

					if (time < 1) {
						$.ajax({
							url: window.location.url,
							type: "GET",
							success: function success() {
								window.location.reload(1);
							},
							error: function error(response) {
								$error_container.html('<p class="text-center">Error: ' + response + '</p>');
							}
						});
					}
				}
				setTimeout(function () {
					window.location.reload(1);
				}, 5000);
			}
		}
	}, {
		key: 'checkBatteryStatus',
		value: function checkBatteryStatus() {
			var $error_container = $('.error-container');

			navigator.getBattery().then(function (battery) {

				if (battery.level <= 15) {
					$error_container.html('<p class="text-center">Your Battery level is below 15% charge your battery now</p>');
				}

				if (battery.charging) {
					$error_container.show();
					$error_container.html('<p class="text-center">Charging.</p>');

					setTimeout(function () {

						$.ajax({
							url: window.location.url,
							type: "GET",
							success: function success() {

								if (battery.level === 100 + Math.floor(battery.level * 100)) {
									setTimeout(function () {
										$error_container.html('<p class="text-center">Your battery is fully charged</p>');
									}, 0);
								}

								$error_container.html('<p class="text-center">Your Currently battery level is ' + Math.floor(battery.level * 100) + '%</p>');
							},
							error: function error(response) {
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

	}, {
		key: 'fire',
		value: function fire() {
			var _this = this;

			this.checkEthernetStatus();
			this.checkBatteryStatus();

			/** open logout modal */
			$('.logout').click(function () {
				_this.helper.openModal('.logout-modal');
			});
		}
	}]);

	return App;
}();

new App();

exports.default = App;

},{"../Helper.js":1,"../components/Header.js":3,"../components/NoteList.js":4}],3:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/** 
 * header component class
 */

var Header = function () {
	function Header() {
		_classCallCheck(this, Header);

		this.header = $('#header');
		this.authContainer = this.header.find('.auth-container');
		this.authOptions = this.header.find('.auth-options');
	}

	_createClass(Header, [{
		key: 'fire',
		value: function fire() {
			var _this = this;

			var auth = this.header.find('.auth');
			var welcome = auth.find('.welcome');

			welcome.delay(5000).fadeOut();

			auth.click(function () {
				return _this.authOptions.slideToggle(200);
			});
		}
	}]);

	return Header;
}();

exports.default = Header;

},{}],4:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }(); /** 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      * notelist component
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      */

var _Helper = require('../Helper.js');

var _Helper2 = _interopRequireDefault(_Helper);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var NoteList = function () {
	/** 
  * Constructor
  */
	function NoteList() {
		_classCallCheck(this, NoteList);

		this.helper = new _Helper2.default();
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


	_createClass(NoteList, [{
		key: 'fire',
		value: function fire() {
			var _this = this;

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
			$('.show-trash').click(function (e) {
				e.preventDefault();

				// show trash icon link
				$(_this).each(function () {
					this.toggleableTableData.toggleClass('show');
				});

				// change button text
				if (_this.toggleableTableData.hasClass('show')) {
					$(_this).text('Cancel');
				} else {
					$(_this).text('remove');
				}
			});

			/**
    * removing note 
    */
			$('.remove-note').click(function (e) {
				console.log($('.remove-note').attr('href'));
				e.preventDefault();

				$.ajax({
					url: $('.remove-note').attr('href'),
					type: 'POST',
					data: {},
					success: function success() {
						return setTimeout(function () {
							return window.location.reload();
						});
					},
					error: function error(response) {
						return console.log(response);
					}
				});
			});
		}
	}]);

	return NoteList;
}();

exports.default = NoteList;

},{"../Helper.js":1}]},{},[1,2,3]);

//# sourceMappingURL=notifier.js.map
