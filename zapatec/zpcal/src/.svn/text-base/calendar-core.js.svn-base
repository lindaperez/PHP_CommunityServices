/*
 * $Id: calendar-core.js 17798 2009-05-22 12:00:55Z vasyl $
 * The Zapatec DHTML Calendar
 *
 * Copyright (c) 2004-2009 by Zapatec, Inc.
 * http://www.zapatec.com
 * 1700 MLK Way, Berkeley, California,
 * 94709, U.S.A.
 * All rights reserved.
 *
 * Main Calendar file. Creates a popup or flat calendar with various options.
 *
 * Original version written by Mihai Bazon,
 * http://www.bazon.net/mishoo/calendar.epl
 */

// $Id: calendar-core.js 17798 2009-05-22 12:00:55Z vasyl $

// Emulate window.event in Mozilla for certain events
zapatecUtils.emulateWindowEvent([
	'dblclick'
]);

/**
 * Zapatec Calendar widget class. Extends base Zapatec Widget class
 * (utils/zpwidget.js).
 *
 * <pre>
 * <strong>In addition to config options defined in base Zapatec.Widget class
 * provides following config options:</strong>
 *
 *	inputField				| the ID of an input field to store the date
 *	displayArea				| the ID of a DIV or other element to show the date
 *	button					| ID of a button or other element that will trigger the calendar
 *	eventName				| event that will trigger the calendar, without the "on" prefix (default: "click")
 *	closeEventName			| event that will close the calendar (i.e. one can use "focus" for eventName and "blur" for closeEventName)
 *	ifFormat					| date format that will be stored in the input field
 *	daFormat					| the date format that will be used to display the date in displayArea
 *	singleClick				| (true/false) wether the calendar is in single click mode or not (default: true)
 *	firstDay					| numeric: 0 to 6.  "0" means display Sunday first, "1" means display Monday first, etc.
 *	align						| alignment (default: "Br"); if you don't know what's this see the calendar documentation
 *	range						| array with 2 elements.  Default: [1900.0, 2999.12] -- the range of years available
 *	weekNumbers				| (true/false) if it's true (default) the calendar will display week numbers
 *	flat						| null or element ID; if not null the calendar will be a flat calendar having the parent with the given ID
 *	flatCallback			| function that receives a JS Date object and returns an URL to point the browser to (for flat calendar)
 *	disableFunc				| function that receives a JS Date object and should return true if that date has to be disabled in the calendar
 *	onSelect					| function that gets called when a date is selected.  You don't _have_ to supply this (the default is generally okay)
 *	onClose					| function that gets called when the calendar is closed.  [default]
 *	onUpdate					| function that gets called after the date is updated in the input field.  Receives a reference to the calendar.
 *	onFDOW					| an event handler that is fired when a user click on the day name.
 *	onWeekClick				| an event handler that is fired when a user click on the week number.
 *	onTodayClick			| an event handler that is fired when a user click on the today button.
 *	onMonthSelect			| an event handler that is fired when a user choose a month (buttons or combo).
 *	onYearSelect			| an event handler that is fired when a user choose a year (buttons or combo).
 *	onHisrotySelect		| an event handler that is fired when a user choose a history date (buttons or combo).
 *	noGrab					| prevents calendar from adding document event handlers to intercept key events or to close the calendar when it is clicked outside
 *	onCreate					| an event handler that is fired when calendar create.
 *	date						| the date that the calendar will be initially displayed to
 *	showsTime				| default: false; if true the calendar will include a time selector
 *	timeFormat				| the time format; can be "12" or "24", default is "12"
 *	electric					| if true (default) then given fields/date areas are updated for each move; otherwise they're updated only on close
 *	sortOrder				| ("asc"(ending)/"desc"(ending)/"none"). If "asc" (default), order of the multiple dates (when multiple dates is on) will be sorted in ascending order. Otherwise, it will be sorted in descending order. "none" means no sorting is needed.
 *	step						| configures the step of the years in drop-down boxes; default: 2
 *	position					| configures the calendar absolute position; default: null
 *	cache						| if "true" (  default: "true") it will reuse the same calendar object, where possible
 *	showOthers				| if "true" (but default: "false") it will show days from other months too
 *	multiple					| array of multiple dates
 *	multipleRange			| array of multiple range dates (use only with timeRange)
 *	multipleSelection		| boolean, if true calendar can use multiple selection
 *	saveDate					| if set (default unset) will save a cookie for this duration.
 *	numberMonths			| Have the calendar display multiple months
 *	stepMonths			  | Step for next and previous arrows in months. Default: numberMonths.
 *	controlMonth			| When displaying multiple months, this will be the control month. Default 1.
 *	vertical					| When displaying multiple months, months can progress in a vertical or horizontal way. Horizontal is the default.
 *	monthsInRow				| When displaying multiple months how many months in a horizontal row. Works both in vertical and horizontal mode. Default numberMonths
 *	fdowClick				| Allow click on Days of Week 1st day
 *	titleHtml				| Html you can put in title of calendar
 *	noHelp					| Disables "?" button in your calendar
 *	noHistory				| Disable history
 *	noStatus					| Disable status bar
 *	noCloseButton			| Disables "X" button in your calendar
 *	disableYearNav			| Disables year navigation buttons
 *	minimal					| Make calendar minimal look (disable everything that can)
 *	theme						| Theme name
 *	showEffect				| Name of the effect that shows calendar
 *	showEffectSpeed		| Speed of the show effect
 *	showEffectOnFinish	| Function that is called when the show effect action is complete
 *	hideEffect				| Name of the effect that hides calendar
 *	hideEffectSpeed		| Speed of the hide effect
 *	hideEffectOnFinish	| Function that is called when the hide effect action is complete
 *	showAfterCreation		| Shows popup calendar when created
 *	maxSelection			| Maximum selected dates that allowing (default: -1 is mean that calendar hasn`t selection limit)
 *	setDateToolTip			| callback function that gets a date and sets tooltip text for this date
 * loadPrefs				| true/false. Loads the preference cookie and merges saved prefs to Zapatec.Calendar.prefs (history)
 *	historySize				| History size
 *	hideNavPanel			| Navigation panel that contains prev/next month/year, today buttons 
 *
 * One of "inputField", "displayArea" or "button" is required.
 *
 * <strong>In addition to the events fired from base Zapatec.Widget class fires
 * the following events:</strong>
 *
 * <b>calDateClicked</b> when date is clicked. Listener receives Date object.
 *
 * <b>calDateDblclicked</b> when date is double clicked. Listener receives Date
 * object.
 *
 * <b>calDateSwitched</b> when date is set programmatically. Listener receives
 * Date object.
 *
 * <b>calMonthClicked</b> when month (title) is clicked. Listener receives
 * following object:
 * {
 *   fullYear: [number] full year,
 *   month: [number] zero-based month number (0 - 11)
 * }
 * </pre>
 *
 * @constructor
 * @extends Zapatec.Widget
 * @requires Zapatec.Widget Requires utils/zapatec.js
 * @param {object} oArg User configuration
 */
Zapatec.Calendar = function(oArg, date, onSelect, onClose) {
	// For backward compatibility
	if (typeof oArg != 'object') {
		var firstDay = oArg;
		oArg = {};
		if (firstDay != null) oArg.firstDay = firstDay;
		if (date) oArg.date = date;
		if (onSelect) oArg.onSelect = onSelect;
		if (onClose)  oArg.onClose = onClose;
	}
	// Call constructor of superclass
	zapatecCalendar.SUPERconstructor.call(this, oArg);
};

/**
 * Shortcut for faster access.
 * @private
 * @final
 */
zapatecCalendar = Zapatec.Calendar;

Zapatec.Calendar.activeCalendar = null;

/**
 * Unique static id of the calendar class. Gives ability for Zapatec#inherit to
 * determine and store path to this file correctly when it is included using
 * Zapatec#include. When this file is included using Zapatec#include or path
 * to this file is gotten using Zapatec#getPath, this value must be specified
 * as script id.
 * @private
 */
Zapatec.Calendar.id = "Zapatec.Calendar";

// Inherit Zapatec Widget
Zapatec.inherit(zapatecCalendar, zapatecWidget);

/**
 * Initializes object.
 *
 * @param {object} oArg User configuration
 */
Zapatec.Calendar.prototype.init = function(oArg) {
	// Call init method of superclass
	zapatecCalendar.SUPERclass.init.call(this, oArg);

	var oConfig = this.config;

	this.activeDiv = null;

	// Create historyDateFormat
	this.historyDateFormat = oConfig.ifFormat || oConfig.daFormat || '%B %d, %Y';
	// Other 'private' paramiters
	this.currentDateEl = null;
	this.getDateStatus = null;
	this.getDateToolTip = null;
	this.timeout = null;
	this.dragging = false;
	this.hidden = false;
	this.minYear = 1970;
	this.maxYear = 2050;
	this.minMonth = 0;
	this.maxMonth = 11;
	this.isPopup = false;
	this.hiliteToday = true;
	// HTML elements
	this.table = null;
	this.element = null;
	this.tbody = [];
	this.firstDayName = null;
	// Combo boxes
	this.monthsCombo = null;
	this.hilitedMonth = null;
	this.activeMonth = null;
	this.yearsCombo = null;
	this.hilitedYear = null;
	this.activeYear = null;
	this.histCombo = null;
	this.hilitedHist = null;
	// Information
	this.dateClicked = false;
	this.titles = [];
	this.rowsOfDayNames = [];
	//Last row hilite object
	this.lastRowHilite = null;
	// Close button object
	this.closeButton = null;
	// Help button object
	this.helpButton = null;
	// Flag for opera
	//this.justCreate = false;
	// Save triggerElfor popup
	this.triggerEl = null;

	// Flag to create calendar
	if (!this.isCreate)
		this.isCreate = false;

	// set tooltips
	if (typeof oConfig.setDateToolTip == "function")
		this.setDateToolTipHandler(oConfig.setDateToolTip);

	this.setRange(oConfig.range[0], oConfig.range[1]);

	// Init data (language and others)
	//Zapatec.Calendar._initSDN();
	if (Zapatec.Langs) {
		if (!this.langStr)
			this.langStr = oConfig.lang;
	}
	else
		Zapatec.Calendar._initSDN();

	this.dateFormat = Zapatec.Calendar.i18n("DEF_DATE_FORMAT", null, this);
	this.ttDateFormat = Zapatec.Calendar.i18n("TT_DATE_FORMAT", null, this);

	// Old paramiter dateStr.
	this.dateStr = oConfig.date;

	// Load css, if need
	if (oConfig.themeSize.length > 0)
		Zapatec.Transport.loadCss({url : oConfig.themePath + oConfig.themeSize.toLowerCase() + ".css", async:false});

	// Init isPopup
	if (!oConfig.flat)
		this.isPopup = true;

	// Set onSelect
	if (typeof oConfig.onSelect == "function") {
		this.onSelected = oConfig.onSelect;
	} else {
		this.onSelected = this.onSelectInner;
	}
	// Set onClose
	if (typeof oConfig.onClose != "function")
		oConfig.onClose = this.onCloseInner;
	// time24 setup
	this.time24 = (oConfig.timeFormat == '24');
	// multiple dates
	if (oConfig.multiple) {
		this.setMultipleDates(oConfig.multiple);
	}
	// Setup dateStatus and disableFunc functions
	if (typeof oConfig.disableFunc == 'function')
		this.setDisabledHandler(oConfig.disableFunc);
	if (typeof oConfig.dateStatusFunc == 'function')
		this.setDateStatusHandler(oConfig.dateStatusFunc);

	// Convert elements if need
	oConfig.inputField = Zapatec.Widget.getElementById(oConfig.inputField);
	oConfig.displayArea = Zapatec.Widget.getElementById(oConfig.displayArea);
	oConfig.button = Zapatec.Widget.getElementById(oConfig.button);

	if (!oConfig.inputField) {
		oConfig.canType = false;
	} else {
		oConfig.inputField.setAttribute("autocomplete", "off");
	}

	// Create error object
	var oError = new Object;
	oError.source = "setup";
	oError.id = oConfig.id;

	if (!(oConfig.flat || oConfig.multiple || oConfig.inputField || oConfig.displayArea || oConfig.button)) {
		oError.errorDescription = "Nothing to setup (no fields found). Please check your code.";
		//Zapatec.Calendar.submitErrorFunc(oError);
		//return false;
	}

	if (((oConfig.timeInterval) && ((oConfig.timeInterval !== Math.floor(oConfig.timeInterval)) || ((60 % oConfig.timeInterval !== 0) && (oConfig.timeInterval % 60 !== 0)))) || (oConfig.timeInterval > 360)) {
		oError.errorDescription = "timeInterval option can only have the following number of minutes:\n1, 2, 3, 4, 5, 6, 10, 15, 30,  60, 120, 180, 240, 300, 360 ";
		Zapatec.Calendar.submitErrorFunc(oError);
		oConfig.timeInterval = null;
	}

	if (oConfig.date && !Date.parse(oConfig.date)) {
		oError.errorDescription = "Start Date Invalid. See date option.\nDefaulting to today.";
		Zapatec.Calendar.submitErrorFunc(oError);
		oConfig.date = null;
	}

	// Load cookies
	this.setCookie();

	// Set multiple to maxSelected
	if (oConfig.multiple && oConfig.maxSelection > 0 && this._getMultipleLength() > oConfig.maxSelection) {
		this._delUnnecessaryMultiple(oConfig.maxSelection);
	}

	if (oConfig.flat != null) {
		oConfig.flat = Zapatec.Widget.getElementById(oConfig.flat);

		if (!oConfig.flat) {
			Zapatec.Calendar.submitErrorFunc({
				sourse		: "setup",
				id				: oConfig.id,
				errorDescription  : "Flat specified but can't find parent."
			});
			return false;
		}

		if (oConfig.ifFormat) {
			this.setDateFormat(oConfig.ifFormat);
		}

	} else
		if (oConfig.canType) {
			Zapatec.Utils.addEvent(oConfig.inputField, "mousedown", Zapatec.Calendar.cancelBubble);
			Zapatec.Utils.addEvent(oConfig.inputField, "keydown", Zapatec.Calendar.cancelBubble);
			Zapatec.Utils.addEvent(oConfig.inputField, "keypress", Zapatec.Calendar.cancelBubble);
			Zapatec.Utils.addEvent(oConfig.inputField, "keyup", function(ev) {
				var cal = Zapatec.Calendar.activeCalendar;
				var format = oConfig.inputField ? oConfig.ifFormat : oConfig.daFormat;
				var parsedDate = zapatecDate.parseDate.call(this, oConfig.inputField.value, format);
				if (parsedDate && !cal.hidden) {
					if (cal.setDate(parsedDate)) {
						cal.showHint(Zapatec.Calendar.i18n("SEL_DATE", null, cal));
					}
				}
			});
			Zapatec.Utils.addEvent(oConfig.inputField, "blur", function(ev) {
				var cal = Zapatec.Calendar.activeCalendar;
				var format = oConfig.inputField ? oConfig.ifFormat : oConfig.daFormat;
				var parsedDate = zapatecDate.parseDate.call(this, oConfig.inputField.value, format);
				if (!parsedDate) {
					oConfig.inputField.value = cal.printWith2Time(cal.currentDate, cal.currentDateEnd, format);
				}
			});
		}

	// Setup events
	var triggerEl = oConfig.button || oConfig.displayArea || oConfig.inputField;

	if (triggerEl) {
		// Fix for Zapatec.Calendar.setup
		//var triggerEl = oConfig.button || oConfig.displayArea || oConfig.inputField;
		var widget = {};
		for (i = 0; i < Zapatec.Widget.all.length - 1; i++)
			if (Zapatec.Widget.all[i] instanceof Zapatec.Calendar) {
				if (oConfig.inputField)  widget = Zapatec.Widget.all[i].config.inputField;
				if (oConfig.displayArea) widget = Zapatec.Widget.all[i].config.displayArea;
				if (oConfig.button)	 widget = Zapatec.Widget.all[i].config.button;

				if (widget == triggerEl) {
					Zapatec.Widget.all[i].destroy();
				}
			}
		// End fix
		var selfEff = this.config.showEffectOnFinish;
		this.triggerEl = triggerEl;
		this.config.showEffectOnFinish = function () {
			if ("function" == typeof selfEff) {
				selfEff();
			}
			triggerEl.disabled = false;
		}
		Zapatec.Utils.addEvent(triggerEl, oConfig.eventName, new Function("Zapatec.Widget.getWidgetById(" + this.id + ").unHide(this)"));
	}


	if (oConfig.closeEventName && !Zapatec.is_opera) {
		Zapatec.Utils.addEvent(triggerEl, oConfig.closeEventName, new Function("Zapatec.Widget.getWidgetById(" + this.id + ").callCloseHandler()"));
	}

	/* If Zapatec.Effects not included to the script - include it.
	 * This prevent "firsttime blinking" of the calendar, when load / reload page.
	 */
	if (this.config.showEffect.length > 0 && typeof(Zapatec.Effects) == 'undefined') {
		this.container = new Object; // set container to not null
		this.showContainer(this.config.showEffect, this.config.showEffectSpeed, this.config.showEffectOnFinish);
	}

	// set the calendar close button
	if (this.config.closeButton) {
		var cal = this;
		this.closeButton = new Zapatec.Button(this.config.closeButton);
		this.closeButton.config.clickAction = function() {
			if (typeof cal.config.closeButton['clickAction'] == 'function') {
				cal.config.closeButton['clickAction']();
			}
			cal.callCloseHandler();
		};
	}
	// set the calendar help button
	if (this.config.helpButton) {
		var cal = this;
		this.helpButton = new Zapatec.Button(this.config.closeButton);
		this.helpButton.config.clickAction = function() {
			if (typeof cal.config.helpButton['clickAction'] == 'function') {
				cal.config.helpButton['clickAction']();
			}
			cal.callHelpHandler();
		};
	}

	// Define conainer of Calendar
	this.container = oConfig.flat || this.element;

	if (!this.isPopup) {
		Zapatec.Calendar.activeCalendar = this;
		this.create(oConfig.flat);
		if (oConfig.inputField && oConfig.inputField.type == "text" && typeof oConfig.inputField.value == "string") {
			this.parseDate(oConfig.inputField.value);
		}
		this.show();
	} else if (oConfig.showAfterCreation) {
		this.unHide(triggerEl);
	}
};

/**
 * Reconfigures the calendar with new config options after it was initialized.
 * May be used to change look or behavior of the calendar.
 * In the argument pass only values for changed config options.
 * There is no need to pass config options that were not changed.
 *
 * <pre>
 *
 *
 * </pre>
 *
 * @param {object} oArg Changes to user configuration
 */
Zapatec.Calendar.prototype.reconfigure = function(oArg) {
	// Call parent method
	zapatecCalendar.SUPERclass.reconfigure.call(this, oArg);
	this.show();
};

/**
 * Configures calendar. Gets called from parent init method.
 *
 * @private
 * @param {object} oArg User configuration
 */
Zapatec.Calendar.prototype.configure = function(oArg) {

	// Define config options
	this.defineConfigOption('inputField', null);
	this.defineConfigOption('displayArea', null);
	this.defineConfigOption('button', null);
	this.defineConfigOption('eventName', 'click');
	this.defineConfigOption('closeEventName', null);
	this.defineConfigOption('ifFormat', '%Y/%m/%d');
	this.defineConfigOption('daFormat', '%Y/%m/%d');
	this.defineConfigOption('singleClick', true);
	this.defineConfigOption('disableFunc', null);
	this.defineConfigOption('dateStatusFunc', oArg.disableFunc ? oArg.disableFunc : null);
	this.defineConfigOption('dateText', null);
	this.defineConfigOption('firstDay', null);
	this.defineConfigOption('align', 'Br');
	this.defineConfigOption('range', [1900, 2999]);
	this.defineConfigOption('weekNumbers', true);
	this.defineConfigOption('flat', null);
	this.defineConfigOption('flatCallback', null);
	this.defineConfigOption('onSelect', null);
	this.defineConfigOption('onClose', null);
	this.defineConfigOption('onUpdate', null);
	this.defineConfigOption('onFDOW', null);
	this.defineConfigOption('noGrab', false);
	this.defineConfigOption('date', '');
	this.defineConfigOption('dateEnd', '');
	this.defineConfigOption('showsTime', false);
	this.defineConfigOption('sortOrder', 'asc');
	this.defineConfigOption('timeFormat', '24');
	this.defineConfigOption('timeInterval', null);
	this.defineConfigOption('electric', true);
	this.defineConfigOption('step', 2);
	this.defineConfigOption('position', null);
	this.defineConfigOption('cache', true);
	this.defineConfigOption('showOthers', false);
	this.defineConfigOption('multiple', null);
	this.defineConfigOption('multipleRange', null);
	this.defineConfigOption('multipleSelection', false);
	this.defineConfigOption('saveDate', null);
	this.defineConfigOption('fdowClick', false);
	this.defineConfigOption('titleHtml', null);
	this.defineConfigOption('noHelp', false);
	this.defineConfigOption('noCloseButton', false);
	this.defineConfigOption('disableYearNav', false);
	this.defineConfigOption('disableFdowChange', false);
	this.defineConfigOption('multiple', null);
	this.defineConfigOption('disableDrag', false);
	this.defineConfigOption('numberMonths', 1);
	this.defineConfigOption('stepMonths');
	this.defineConfigOption('monthsInRow', oArg.numberMonths ? oArg.numberMonths : 1);
	this.defineConfigOption('controlMonth', 1);
	this.defineConfigOption('vertical', false);
	this.defineConfigOption('canType', false);
	this.defineConfigOption('theme', 'bluexp');
	this.defineConfigOption('themeSize', '');
	if (Zapatec.Langs) {
		this.defineConfigOption('langId', Zapatec.Calendar.id);
		this.defineConfigOption('lang', 'en');
	}
	this.defineConfigOption('showEffect', '');
	this.defineConfigOption('showEffectSpeed', 100);
	this.defineConfigOption('showEffectOnFinish', null);
	this.defineConfigOption('hideEffect', '');
	this.defineConfigOption('hideEffectSpeed', 100);
	this.defineConfigOption('hideEffectOnFinish', null);
	this.defineConfigOption('showAfterCreation', false);
	this.defineConfigOption('noHistory', false);
	this.defineConfigOption('noStatus', false);
	this.defineConfigOption('minimal', false);
	this.defineConfigOption('maxSelection', -1);
	this.defineConfigOption('onWeekClick', null);
	this.defineConfigOption('onTodayClick', null);
	this.defineConfigOption('onMonthSelect', null);
	this.defineConfigOption('onYearSelect', null);
	this.defineConfigOption('onHistorySelect', null);
	this.defineConfigOption('setDateToolTip', null);
	this.defineConfigOption('timeRange', false);
	this.defineConfigOption('onCreate', null);
	this.defineConfigOption('closeButton', null);
	this.defineConfigOption('helpButton', null);
	this.defineConfigOption('loadPrefs', false);
	this.defineConfigOption('historySize', 9);
	this.defineConfigOption('hideNavPanel', false);

	// Call parent method
	zapatecCalendar.SUPERclass.configure.call(this, oArg);

	var oConfig = this.config;

	// preferences
	if (!oConfig.prefs)
		oConfig.prefs = {
			fdow		: null,					 /**< when NULL we will use the user options  */
			history	: "",						 /**< keeps the history as one big string */
			hsize		: oConfig.historySize /**< maximum history size (number of stored items) */
		};

	// initialize the preferences object;
	if (oConfig.loadPrefs) {
		Zapatec.Calendar.loadPrefs(oConfig);
	}

	// Load size css (hiude/big/small/tiny)
	oConfig.themeSize = oConfig.themeSize.toLowerCase();
	if (oConfig.themeSize == 'normal')
		oConfig.themeSize = '';
	var firstLetter = oConfig.themeSize.substr(0, 1);
	oConfig.themeSize = firstLetter.toUpperCase() + oConfig.themeSize.substr(1);

	if (oConfig.prefs.fdow || (oConfig.prefs.fdow == 0)) {
		oConfig.firstDay = parseInt(oConfig.prefs.fdow, 10);
	} else {
		var fd = 1;
		if (typeof oConfig.firstDay == "number") {
			fd = oConfig.firstDay;
		} else if (typeof this._FD == 'number') {
			fd = this._FD;
		}
		oConfig.firstDay = fd;
	}

	//---------- Change paramiters acording to the conditions
	if (oConfig.weekNumbers) {
		oConfig.disableFdowChange = true;
	} else {
		oConfig.onWeekClick = null;
	}

	// numberMonth condition
	if ((oConfig.numberMonths > 12) || (oConfig.numberMonths < 1)) {
		oConfig.numberMonths = 1;
	}
	oConfig.numberMonths = parseInt(oConfig.numberMonths, 10);
	// stepMonths
	oConfig.stepMonths = parseInt(oConfig.stepMonths);
	if (isNaN(oConfig.stepMonths) || oConfig.stepMonths < 1) {
		oConfig.stepMonths = oConfig.numberMonths;
	}

	// controlMonth condition
	if ((oConfig.controlMonth > oConfig.numberMonths) || (oConfig.controlMonth < 1)) {
		oConfig.controlMonth = 1;
	}
	oConfig.controlMonth = parseInt(oConfig.controlMonth, 10);

	// monthsInRow
	if (oConfig.monthsInRow > oConfig.numberMonths) {
		oConfig.monthsInRow = oConfig.numberMonths;
	}
	oConfig.monthsInRow = parseInt(oConfig.monthsInRow, 10);

	// Set multiple dates
	if (oConfig.multipleSelection && ! oConfig.multiple) {
		oConfig.multiple = [];
	}
	if (oConfig.multiple && !oConfig.multipleSelection) {
		oConfig.multipleSelection = true;
	}
	// Multiple range works only with multiple
	if (oConfig.multipleRange && !oConfig.multiple) {
		oConfig.multipleRange = null;
	}

	// singleClick
	if (oConfig.multiple) {
		oConfig.singleClick = false;
	}

	oConfig.sortOrder = oConfig.sortOrder.toLowerCase();

	// Animation speed
	oConfig.showEffectSpeed = parseInt(oConfig.showEffectSpeed, 10);
	oConfig.hideEffectSpeed = parseInt(oConfig.hideEffectSpeed, 10);

	// Calendar with time range
	if (oConfig.multipleRange && !oConfig.timeRange) {
		oConfig.timeRange = true;
	}

	if (oConfig.timeRange && !oConfig.showsTime) {
		oConfig.showsTime = true;
	}

	// Minmal calendar
	if (oConfig.minimal) {
		oConfig.noHelp = true;
		oConfig.noCloseButton = true;
		oConfig.noHistory = true;
		oConfig.noStatus = true;
		oConfig.disableYearNav = true;
		oConfig.disableFdowChange = true;
		oConfig.weekNumbers = false;
		oConfig.fdowClick = false;
		oConfig.showsTime = false;
		oConfig.timeRange = false;
	}

	// Setup buttons
	if (oConfig.noCloseButton || !Zapatec.Button) {
		oConfig.closeButton = null;
	}
	if (oConfig.noHelp || !Zapatec.Button) {
		oConfig.helpButton = null;
	}
	if (oConfig.hideNavPanel) {
		oConfig.minimal = true;
	}
};

/**
 * Show popup calendar.
 * Yes, yes I know, but function "show" already included in prototype!
 * @private (use option showAfterCreation or emulate button press)
 *
 * @param triggerEl - html element that show calendar
 */
Zapatec.Calendar.prototype.unHide = function (triggerEl) {
	var cal = this;
	cal.lastRowHilite = null;
	if (!cal)
		return;


	// Call reinit for set init data of the calendar (if no reinit must call from the button.onClick handler)
	if (!cal.isCreate) {
		if (cal.config.date && cal.config.cache)
			cal.setDate(cal.config.date);
		cal.create(cal.config.flat);
	} else {
		if (cal.config.date && cal.config.cache)
			cal.setDate(cal.config.date);
		cal.reconfigure(cal.config);
		cal.reinit();
	}

	var oConfig = cal.config;
	var dateEl = oConfig.inputField || oConfig.displayArea;
	//FIX for Enter key!  But do not work in IE!
	if (!Zapatec.is_ie && (!oConfig.canType || oConfig.inputField != triggerEl) && triggerEl.blur) {
		triggerEl.blur();
	}

	var dateFmt = oConfig.inputField ? oConfig.ifFormat : oConfig.daFormat;

	if (oConfig.canType && (oConfig.inputField == triggerEl) && cal && !cal.hidden) {
		//return;
	}

	if (dateEl) {
		var dateValue;
		//figure out if the it's in value or innerHTML
		if (dateEl.value) {
			dateValue = dateEl.value;
		} else {
			dateValue = dateEl.innerHTML;
		}
		if (dateValue != "") { //if there is a date to initialize from
			// Need translator for parseDate
			Zapatec.Calendar.activeCalendar = this;
			var parsedDate = zapatecDate.parseDate.call(this, dateEl.value || dateEl.innerHTML, dateFmt);
			//This check for when webmaster initializes the box with something like
			//"check in"
			if (parsedDate != null) { //if it's parsable
				if (!(typeof cal.config.dateStatusFunc == "function" && cal.config.dateStatusFunc(parsedDate)) && !cal.setDate(parsedDate))
					oConfig.inputField.value = cal.printWith2Time(cal.currentDate, cal.currentDateEnd, cal.config.ifFormat);
			}
			else
				oConfig.inputField.value = cal.printWith2Time(cal.currentDate, cal.currentDateEnd, cal.config.ifFormat);
		}
	}

	// Disable trigger element
	if (triggerEl) {
		triggerEl.disabled = true;
	}
	if (!oConfig.position)
		cal.showAtElement(oConfig.button || oConfig.displayArea || oConfig.inputField, oConfig.align);
	else
		cal.showAt(oConfig.position[0], oConfig.position[1]);

	return false;
};

/**
 * Set cookie, if it was saved.
 * no paramiters
 */
Zapatec.Calendar.prototype.setCookie = function() {
	if (this.config.saveDate) { //If saveDate is on We're saving the date in a cookie
		this.cookiePrefix = window.location.href + "--" + this.config.button.id
		//fetch the cookie
		var cookieName = this.cookiePrefix;
		var newdate = Zapatec.Utils.getCookie(cookieName);
		if (newdate != null) {
			//if there's a cookie
			//set the value of the text field
			Zapatec.Widget.getElementById(this.config.inputField.id).value = newdate;
		}
	}
};


/**
 * Get length of multiple collection
 * @private
 */
Zapatec.Calendar.prototype._getMultipleLength = function () {
	var counter = 0;
	for (var item in this.config.multiple) {
		counter++;
	}

	return counter;
}

/**
 * Delete unnecessary multiple dates
 *
 * @private
 * @param {integer} number - number of max multiple length (i.e. maxSelected)
 */
Zapatec.Calendar.prototype._delUnnecessaryMultiple = function (number) {
	var cal = this;
	var counter = 1;
	if (number > 0 && cal._getMultipleLength() > number) {
		for (var item in cal.config.multiple) {
			if (counter++ > number) {
				delete cal.config.multiple[item];
			}
		}
	}
}
/**
 * Default onSelect function
 * @private
 *
 * @cal - calendar
 * @date - starting date
 */
Zapatec.Calendar.prototype.onSelectInner = function(cal, date) {
	var p = cal.config;
	// For old version support
	for (var prop in p) {
		cal[prop] = p[prop];
	}
	// end support

	var update = (cal.dateClicked || p.electric);
	if (update && p.flat) {
		if (typeof p.flatCallback == "function") {
			if (!p.multiple) {
				//User can call function submitFlatDates directly in Calendar object to handle the submission of multiple dates.
				p.flatCallback(cal);
			}
		}
		return false;
	}
	if (update && p.inputField) {
		p.inputField.value = this.printWith2Time(cal.currentDate, cal.currentDateEnd, p.ifFormat);
		if (typeof p.inputField.onchange == "function")
			p.inputField.onchange();
	}
	if (update && p.displayArea) {
		p.displayArea.innerHTML = this.printWith2Time(cal.currentDate, cal.currentDateEnd, p.daFormat);
	}
	if (update && p.singleClick && cal.dateClicked) {
		cal.callCloseHandler();
	}
	if (update && typeof p.onUpdate == "function")
		p.onUpdate(cal);

	if (p.saveDate) { //save date in cookie
		//unique name of the cookie is the name of the button  + href
		var cookieName = this.cookiePrefix;
		Zapatec.Utils.writeCookie(cookieName, p.inputField.value, null, '/', p.saveDate);
	}
};

/**
 * Default onClose function
 * @cal - calendar
 */
Zapatec.Calendar.prototype.onCloseInner = function(cal) {
	if (!cal.config.flat)
		cal.hide();
};

// BEGIN: CALENDAR STATIC FUNCTIONS
/**
 * Prevent wrong behaviour for typing in the input field
 *
 * @private
 * @param event - event that occures
 */
Zapatec.Calendar.cancelBubble = function (event) {
	event = event || window.event;
	if (Zapatec.is_ie) {
		event.cancelBubble = true;
	} else {
		event.stopPropagation();
	}
};

/**
 * \internal This function is called from the constructor, only once, to
 * initialize some internal arrays containing translation strings.  It is also
 * called from the calendar wizard in order to reconfigure the calendar with a
 * language different than the initially selected one.
 *
 * Only for old version
 * @private
 */
Zapatec.Calendar._initSDN = function() {
	if (typeof Zapatec.Calendar._TT == "undefined") {
		Zapatec.Calendar._TT = {};
	}

	if (typeof Zapatec.Calendar._TT._SDN == "undefined") {
		// table of short day names
		if (typeof Zapatec.Calendar._TT._SDN_len == "undefined")
			Zapatec.Calendar._TT._SDN_len = 3;
		var ar = [];
		for (var i = 8; i > 0;) {
			if (Zapatec.Calendar._TT._DN)
				ar[--i] = Zapatec.Calendar._TT._DN[i].substr(0, Zapatec.Calendar._TT._SDN_len);
			else
				ar[--i] = "";
		}
		Zapatec.Calendar._TT._SDN = ar;
		// table of short month names
		if (typeof Zapatec.Calendar._TT._SMN_len == "undefined")
			Zapatec.Calendar._TT._SMN_len = 3;
		ar = [];
		for (var i = 12; i > 0;) {
			if (Zapatec.Calendar._TT._MN)
				ar[--i] = Zapatec.Calendar._TT._MN[i].substr(0, Zapatec.Calendar._TT._SMN_len);
			else
				ar[--i] = "";
		}
		Zapatec.Calendar._TT._SMN = ar;
	}
	if (typeof Zapatec.Calendar._TT._AMPM == "undefined") {
		Zapatec.Calendar._TT._AMPM = {am : "am", pm : "pm"};
	}
};

/**
 * Translate a string according to the currently loaded language table.  The
 * \em type variable can be null or missing, or can have one of the following
 * values: "dn", "sdn", "mn", "smn".
 *
 * -# if \em type is null or missing, the given \em str will be looked up in
 *	 the translation table.  If a value is found, it is returned.  Otherwise,
 *	 the string is looked up in the English table (if present).  If still not
 *	 found, the value of \em str itself is returned.
 * -# if \em type is passed, then the value of \em str is looked up in one of
 *	 the following internal arrays, depending on the value of \em type:
 *		 - DN (day name)
 *		 - SDN (short day name)
 *		 - MN (month name)
 *		 - SMN (short month name)
 *
 * @param str [string] ID of translation text (can be the English text)
 * @param type [string, optional] domain to search through
 *
 * @return the translation according to the current language.
 */
Zapatec.Calendar.i18nOld = function(str, type) {
	var tr = '';
	if (!Zapatec.Calendar._TT) {
		Zapatec.Calendar._initSDN();
	}
	if (!type) {
		// normal _TT request
		if (Zapatec.Calendar._TT) {
			tr = Zapatec.Calendar._TT[str];
		}
		if (!tr && Zapatec.Calendar._TT_en) {
			tr = Zapatec.Calendar._TT_en[str];
		}
	} else switch (type) {
		case "dn"	: if (Zapatec.Calendar._TT._DN) tr = Zapatec.Calendar._TT._DN[str];  break;
		case "sdn"	: if (Zapatec.Calendar._TT._SDN) tr = Zapatec.Calendar._TT._SDN[str]; break;
		case "mn"	: if (Zapatec.Calendar._TT._MN) tr = Zapatec.Calendar._TT._MN[str];  break;
		case "smn"	: if (Zapatec.Calendar._TT._SMN) tr = Zapatec.Calendar._TT._SMN[str]; break;
		case "ampm"	: if (Zapatec.Calendar._TT._AMPM) tr = Zapatec.Calendar._TT._AMPM[str]; break;
	}
	if (!tr) {
		tr = "" + str;
	}

	return tr;
};

/**
 * Function called by Zapatec.Date object.
 * It call Zapatec.Calendar.i18nOld for old version of calendar or correct value from new translation engine.
 *
 * @private
 * @param str [string] ID of translation text (can be the English text)
 * @param type [string, optional] domain to search through
 *
 * @return the translation according to the current language.
 */
Zapatec.Calendar.i18n = function(str, type, calendar) {
	var newType = "";
	var cal = null;
	if (typeof calendar == 'undefined') {
		cal = Zapatec.Calendar.activeCalendar;
	} else {
		cal = calendar;
	}

	if (cal != null && Zapatec.Langs && Zapatec.Langs["Zapatec.Calendar"]) {
		if (typeof type != 'undefined' && type) {
			newType = "_" + type.toUpperCase();
			return cal.getMessage(newType)[str];
		} else {
			return cal.getMessage(str);
		}
	}
	// Old engine
	return Zapatec.Calendar.i18nOld(str, type);
};


/**
 * Writes the preferences cookie.
 *
 * @param calendarId the calendar id
 */
Zapatec.Calendar.savePrefs = function(calendarId) {
	// FIXME: should we make the domain, path and expiration time configurable?
	// I guess these defaults are right though..
	var cal = Zapatec.Widget.getWidgetById(calendarId);
	Zapatec.Utils.writeCookie("ZP_CAL", Zapatec.Utils.makePref(cal.config.prefs), null, '/', 30);
};

/**
 * Loads the preference cookie and merges saved prefs to Zapatec.Calendar.prefs.
 */
Zapatec.Calendar.loadPrefs = function (oConfig) {
	var txt = Zapatec.Utils.getCookie("ZP_CAL"), tmp;
	if (txt) {
		tmp = Zapatec.Utils.loadPref(txt);
		if (tmp) {
			Zapatec.Utils.mergeObjects(oConfig.prefs, tmp);
		}
	}
	// FIXME: DEBUG!
	//this.prefs.history = "1979/03/08,1976/12/28,1978/08/31,1998/09/21";
	//this.prefs.history = null;
};

/**
 * \internal Adds a set of events to make some element behave like a button.
 *
 * @param el [HTMLElement] reference to your element.
 */
Zapatec.Calendar._add_evs = function(el) {
	var C = Zapatec.Calendar;
	el.onmouseover = C.dayMouseOver;
	el.onmousedown = C.dayMouseDown;
	el.onmouseout = C.dayMouseOut;
	el.ondblclick = C.dayMouseDblClick;
};

/**
 * \internal This function undoes what Zapatec.Calendar._add_evs did, therefore
 * unregisters the event handlers.
 *
 * @param el [HTMLElement] reference to your element.
 */
Zapatec.Calendar._del_evs = function(el) {
	if (!el) {
		return null;
	}
	el.onmouseover = null;
	el.onmousedown = null;
	el.onmouseout = null;
	if (Zapatec.is_ie) {
		el.ondblclick = null;
	}
};

/**
 * Given an HTML element, this function determines if it's part of the "months"
 * combo box and if so it returns the element containing the month name.
 *
 * @param el [HTMLElement] some element (usually that triggered onclick)
 * @return [HTMLElement] element with the month
 */
Zapatec.Calendar.findMonth = function(el) {
	if (!el) {
		return null;
	}
	if (typeof el.month != "undefined") {
		return el;
	} else if (el.parentNode && typeof el.parentNode.month != "undefined") {
		return el.parentNode;
	}

	return null;
};

/** 
 * Similar to findMonth() but for the history combo. 
 */
Zapatec.Calendar.findHist = function(el) {
	if (!el) {
		return null;
	}
	if (typeof el.histDate != "undefined") {
		return el;
	} else if (el.parentNode && typeof el.parentNode.histDate != "undefined") {
		return el.parentNode;
	}

	return null;
};

/** 
 * Similar to the above functions, but for the years combo. 
 */
Zapatec.Calendar.findYear = function(el) {
	if (!el) {
		return null;
	}
	if (typeof el.year != "undefined") {
		return el;
	} else if (el.parentNode && typeof el.parentNode.year != "undefined") {
		return el.parentNode;
	}

	return null;
};

/**
 * This function displays the months combo box.  It doesn't need any parameters
 * because it uses the static activeCalendar variable which maintains a reference to the
 * last calendar that was clicked in the page.
 */
Zapatec.Calendar.showMonthsCombo = function () {
	var cal = Zapatec.Calendar.activeCalendar;
	if (!cal) {
		return false;
	}
	var cd = cal.activeDiv;
	var mc = cal.monthsCombo;

	var date = cal.config.date,
		MM = cal.config.date.getMonth(),
		YY = cal.config.date.getFullYear(),
		min = (YY == cal.minYear),
		max = (YY == cal.maxYear);
	for (var i = mc.firstChild; i; i = i.nextSibling) {
		var m = i.month;
		Zapatec.Utils.removeClass(i, "hilite");
		Zapatec.Utils.removeClass(i, "active");
		Zapatec.Utils.removeClass(i, "disabled");
		i.disabled = false;
		if ((min && m < cal.minMonth) ||
			 (max && m > cal.maxMonth)) {
			Zapatec.Utils.addClass(i, "disabled");
			i.disabled = true;
		}
		if (m == MM)
			Zapatec.Utils.addClass(cal.activeMonth = i, "active");
	}
	var oOffset = zapatecUtils.getElementOffsetRelative(cd);
	var s = mc.style;
	s.display = "block";
	if (cd.navtype < 0) {
		s.left = oOffset.left + "px";
	} else {
		var mcw = mc.offsetWidth;
		if (typeof mcw == "undefined") {
			mcw = 50;
		}
		s.left = oOffset.left + oOffset.width - mcw + "px";
	}
	s.top = oOffset.top + oOffset.height + "px";
	cal.updateWCH(mc);
};

/**
 * Same as the above, this function displays the history combo box for the
 * active calendar.
 */
Zapatec.Calendar.showHistoryCombo = function() {
	var cal = Zapatec.Calendar.activeCalendar;
	var a, h, i, cd, hc, s, tmp, div;
	if (!cal)
		return false;
	hc = cal.histCombo;
	while (hc.firstChild)
		hc.removeChild(hc.lastChild);

	if (cal.config.prefs.history) {
		a = cal.config.prefs.history.split(/,/);
		i = 0;
		while (tmp = a[i++]) {
			tmp = tmp.split(/\//);
			h = Zapatec.Utils.createElement("div");
			h.className = Zapatec.is_ie ? "label-IEfix" : "label";
			h.id = "zpCal" + cal.id + "HistoryDropdownItem" + (i - 1);
			h.histDate = new Date(parseInt(tmp[0], 10), parseInt(tmp[1], 10) - 1, parseInt(tmp[2], 10),
				tmp[3] ? parseInt(tmp[3], 10) : 0,
				tmp[4] ? parseInt(tmp[4], 10) : 0);
			h.appendChild(window.document.createTextNode(zapatecDate.print.call(cal, h.histDate, cal.historyDateFormat)));
			hc.appendChild(h);
			if (Zapatec.Date.dateEqualsTo(h.histDate, cal.config.date))
				Zapatec.Utils.addClass(h, "active");
		}
	}
	cd = cal.activeDiv;
	var oOffset = zapatecUtils.getElementOffsetRelative(cd);
	s = hc.style;
	s.display = "block";
	s.left = Math.floor(oOffset.left + (oOffset.width - hc.offsetWidth) / 2) + "px";
	s.top = oOffset.top + oOffset.height + "px";
	cal.updateWCH(hc);
	cal.bEventShowHistory = true; // Set state the we DID enter History event
};

/**
 * Displays the years combo box for the active calendar.  The "fwd" parameter
 * tells it if it should display future (right) or past (left) years.
 *
 * @param fwd [boolean] true if it's for the right combo (future), false
 * otherwise.
 */
Zapatec.Calendar.showYearsCombo = function (fwd) {
	var cal = Zapatec.Calendar.activeCalendar;
	if (!cal) {
		return false;
	}
	var cd = cal.activeDiv;
	var yc = cal.yearsCombo;

	if (cal.hilitedYear) {
		Zapatec.Utils.removeClass(cal.hilitedYear, "hilite");
	}
	if (cal.activeYear) {
		Zapatec.Utils.removeClass(cal.activeYear, "active");
	}
	cal.activeYear = null;
	var Y = cal.config.date.getFullYear() + (fwd ? 1 : -1);
	var yr = yc.firstChild;
	var show = false;
	for (var i = 12; i > 0; --i) {
		if (Y >= cal.minYear && Y <= cal.maxYear) {
			yr.firstChild.data = Y;
			yr.year = Y;
			yr.style.display = "block";
			show = true;
		} else {
			yr.style.display = "none";
		}
		yr = yr.nextSibling;
		Y += fwd ? cal.config.step : -cal.config.step;
	}
	if (show) {
		var oOffset = zapatecUtils.getElementOffsetRelative(cd);
		var s = yc.style;
		s.display = "block";
		if (cd.navtype < 0) {
			s.left = oOffset.left + "px";
		} else {
			var ycw = yc.offsetWidth;
			if (typeof ycw == "undefined") {
				ycw = 50;
			}
			s.left = oOffset.left + oOffset.width - ycw + "px";
		}
		s.top = oOffset.top + oOffset.height + "px";
	}
	cal.updateWCH(yc);
};

/**
 * This is a simple function that stops a "mousedown" related to the calendar's
 * table element.  This helps avoiding text selection in certain browsers (most
 * notably, Safari, since Mozilla already has a better way).
 *
 * @param ev [Event] the Event object
 * @return false
 */
Zapatec.Calendar.tableMouseDown = function (ev) {
	if (Zapatec.Utils.getTargetElement(ev) == Zapatec.Utils.getElement(ev)) {
		return Zapatec.Utils.stopEvent(ev);
	}
};

/**
 * Called when the mouse button is pressed upon a button.  The name of this
 * function is so for historical reasons; currently, this function is used for
 * \em any type of buttons used in the calendar, not only "days".
 *
 * This function does quite some things.  It checks if the clicked cell is the
 * title bar or the status bar, in which case it starts the calendar dragging
 * mechanism (cal._dragStart()).  If the cell is a time part, then it registers
 * Zapatec.Calendar.tableMouseOver() event handler on the document.  If the
 * cell is a "navigation" button (next/prev year or month, or today) then a
 * timeout is created that will show the appropriate combo box if the button is
 * not quickly depressed.
 *
 * @param ev [Event] the event object
 * @return false
 */
Zapatec.Calendar.dayMouseDown = function(ev) {
	var canDrag = true;
	var el = Zapatec.Utils.getElement(ev);
	if (el.className.indexOf("disabled") != -1 || el.className.indexOf("true") != -1) {
		return false;
	}
	var cal = el.calendar;
	//BEGIN: fix for the extra information bug in IE
	var parent = el.parentNode;
	if (parent.className.indexOf("disabled") != -1 || parent.className.indexOf("true") != -1) {
		return false;
	}
	while (!cal) {
		el = el.parentNode;
		cal = el.calendar;
	}
	//END
	cal.bEventShowHistory = false;  // Set state the we DID NOT enter History event
	cal.activeDiv = el;
	Zapatec.Calendar.activeCalendar = cal;
	if (el.navtype != 300) {
		if (el.navtype == 50 || el.navtype == 51) {
			//turns off changing the time by dragging if timeInterval is set
			if (!((cal.config.timeInterval == null) || ((cal.config.timeInterval < 60) && (el.className.indexOf("hour", 0) != -1)))) {
				canDrag = false;
			}
			el._current = el.firstChild.data;
			if (canDrag) {
				Zapatec.Utils.addEvent(window.document, "mousemove", Zapatec.Calendar.tableMouseOver);
			}
		} else {
			if (((el.navtype == 201) || (el.navtype == 202) || (el.navtype == 211) || (el.navtype == 212)) && (cal.config.timeInterval > 30) && (el.timePart.className.indexOf("minute", 0) != -1)) {
				canDrag = false;
			}
			if (canDrag) {
				Zapatec.Utils.addEvent(window.document, Zapatec.is_ie5 ? "mousemove" : "mouseover", Zapatec.Calendar.tableMouseOver);
			}
		}
		if (canDrag && !(el.navtype == 200 && cal.closeButton) && !(el.navtype == 400 && cal.helpButton)) {
			Zapatec.Utils.addClass(el, "hilite");
			Zapatec.Utils.addClass(el, "active");
		}
		Zapatec.Utils.addEvent(window.document, "mouseup", Zapatec.Calendar.tableMouseUp);
	} else if (cal.isPopup) {
		cal._dragStart(ev);
	} else {
		Zapatec.Calendar.activeCalendar = null;
	}
	if (el.navtype == -1 || el.navtype == 1) {
		if (cal.timeout) clearTimeout(cal.timeout);
		cal.timeout = setTimeout("Zapatec.Calendar.showMonthsCombo()", 250);
	} else if (el.navtype == -2 || el.navtype == 2) {
		if (cal.timeout) clearTimeout(cal.timeout);
		cal.timeout = setTimeout((el.navtype > 0) ? "Zapatec.Calendar.showYearsCombo(true)" : "Zapatec.Calendar.showYearsCombo(false)", 250);
	} else if (el.navtype == 0 && cal.config.prefs.history) {
		if (cal.timeout) clearTimeout(cal.timeout);
		cal.timeout = setTimeout("Zapatec.Calendar.showHistoryCombo()", 250);
	} else {
		cal.timeout = null;
	}

	return Zapatec.Utils.stopEvent(ev);
};

/**
 * Dblclick event handler. Fires calDateDblclicked event if a date is double
 * clicked. In IE voids the selection.
 * @private
 */
Zapatec.Calendar.dayMouseDblClick = function() {
	var oEv = window.event;
	var oEl = oEv.currentTarget || oEv.srcElement;
	var oCal = oEl.calendar;
	while (!oCal) {
		oEl = oEl.parentNode;
		oCal = oEl.calendar;
	}
	if (typeof oEl.navtype == 'undefined') {
		oCal.fireEvent('calDateDblclicked', oCal.currentDate);
	}
	if (Zapatec.is_ie) {
		window.document.selection.empty();
	}
};

/**
 * This function gets called at "onmouseover" events that trigger on any kind
 * of button, like dates, navigation buttons, etc.  Basically, the function
 * computes and caches the tooltip (if it's a date cell for instance) and
 * displays it in the status bar.  If the cell is not a navigation button, it
 * will also add "rowhilite" class to the containing TR element.
 *
 * @param ev [Event] the event object.
 * @return false
 */
Zapatec.Calendar.dayMouseOver = function(ev) {
	var el = Zapatec.Utils.getElement(ev);
	//BEGIN: fix for the extra information bug in IE
	while (!el.calendar) {
		el = el.parentNode;
		caldate = el.caldate;
	}
	//END
	var cal = el.calendar;
	caldate = el.caldate;
	var cel = el.timePart;
	if (caldate) {
		caldate = new Date(caldate[0], caldate[1], caldate[2]);
		if (caldate.getDate() != el.caldate[2]) caldate.setDate(el.caldate[2]);
	}
	if (Zapatec.Utils.isRelated(el, ev) || el.className.indexOf("disabled") != -1 || el.className.indexOf("true") != -1) {
		return false;
	}
	if (el.ttip) {
		if (el.ttip.substr(0, 1) == "_") {
			el.ttip = zapatecDate.print.call(cal, caldate, el.calendar.ttDateFormat) + el.ttip.substr(1);
		}
		cal.showHint(el.ttip);
	}
	if (el.navtype != 300) {
		//turns off highliting of the time part which can not be changed by dragging
		if (!((cal.config.timeInterval == null) || (el.className.indexOf("ampm", 0) != -1) || ((cal.config.timeInterval < 60) && (el.className.indexOf("hour", 0) != -1))) && (el.navtype == 50)) {
			return Zapatec.Utils.stopEvent(ev);
		}
		if (((el.navtype == 201) || (el.navtype == 202)) && (cal.config.timeInterval > 30) && (cel.className.indexOf("minute", 0) != -1)) {
			return Zapatec.Utils.stopEvent(ev);
		}
		if (!(el.navtype == 200 && cal.closeButton) && !(el.navtype == 400 && cal.helpButton))
			Zapatec.Utils.addClass(el, "hilite");
		if (caldate && el.className.indexOf("disabled") == -1 && el.className.indexOf("true") == -1) {
			if (cal.lastRowHilite) {
				Zapatec.Utils.removeClass(cal.lastRowHilite, "rowhilite");
				cal.lastRowHilite = null;
			}
			Zapatec.Utils.addClass(el.parentNode, "rowhilite");
		}
	}

	return Zapatec.Utils.stopEvent(ev);
};

/**
 * Gets called when the mouse leaves a button.  This function "undoes" what
 * dayMouseOver did, that is, it removes the "rowhilite" class from the
 * containing TR and restores the status bar display to read "Select date".
 *
 * @param ev [Event] the event object.
 * @return false
 */
Zapatec.Calendar.dayMouseOut = function(ev) {
	var el = Zapatec.Utils.getElement(ev);
	//BEGIN: fix for the extra information bug in IE
	while (!el.calendar) {
		el = el.parentNode;
		caldate = el.caldate;
	}
	//END
	var cal = el.calendar;
	caldate = el.caldate;
	if (Zapatec.Utils.isRelated(el, ev) || el.className.indexOf("disabled") != -1 || el.className.indexOf("true") != -1)
		return false;
	Zapatec.Utils.removeClass(el, "hilite");
	if (caldate)
		Zapatec.Utils.removeClass(el.parentNode, "rowhilite");
	if (cal)
		cal.showHint(Zapatec.Calendar.i18n("SEL_DATE", null, cal));
	return Zapatec.Utils.stopEvent(ev);
};

/**
 * The generic "click" handler.  This function handles actions on any kind of
 * buttons that appear inside our calendar.  It determines the button type by
 * querying \em el.navtype.  The following types of objects are supported:
 *
 * - Date cells (navtype is undefined).  The function will select that date,
 *	add appropriate class names and remove them from the previously selected
 *	date.  If the date in the calendar \em has \em changed, it calls the
 *	calendar's onSelect handler (see the constructor).  If multiple dates is
 *	enabled, it will not unselect previously selected date but rather maintain
 *	an array of dates which will be avaliable to the onSelect or onClose
 *	handler.
 * - The Close button (navtype == 200).  If this is clicked, then the
 *	calendar's onClose handler is called immediately.
 * - The Today button (navtype == 0).  The calendar will jump to the "today"
 *	date and time, unless it's already there.
 * - The About button (navtype == 400).  It will display an alert with the
 *	"about message", as defined in the translation file.
 * - Previous year (navtype == -2)
 * - Previous month (navtype == -1)
 * - Next month (navtype == 1)
 * - Next year (navtype == 2)
 * - Day names (navtype == 100).  If any of them is clicked, the calendar will
 *	display that day as the first day of week.  It calls the "onFDOW" event
 *	handler if defined.
 * - Time parts (navtype == 50).  If any of them is clicked, this function will
 *	determine if it's a click or shift-click, and will take the appropriate
 *	action (simple click means add 1, shift-click means substract 1 from that
 *	time part).  Then it calls onUpdateTime() to refresh the display.
 * - Week number clicked (navtype == 150)
 *
 * - Time scroll buttons (navtype == 201 or navtype == 202).  If such buttons
 *	are clicked, the time part involved is determined and it is incremented or
 *	decremented with the current step (default: 5).  201 is for "add", 202 for
 *	"substract".
 *
 * @param el [HTMLElement] the object being clicked on
 */
Zapatec.Calendar.cellClick = function(el, ev) {
	var cal = el.calendar;
	var closing = false;
	var newdate = false;
	var date = null;
	//BEGIN: fix for the extra information bug in IE
	while (!cal) {
		el = el.parentNode;
		cal = el.calendar;
	}
	//END fix
	if (el.className.indexOf("disabled") != -1 || el.className.indexOf("true") != -1) {
		Zapatec.Utils.removeClass(el, "hilite");
		return false;
	}

	// if sel can not choosing
	if (cal.config.multiple && cal.config.maxSelection > 0 && (cal._getMultipleLength() + 1) > cal.config.maxSelection) {
		return;
	}

	if (typeof el.navtype == "undefined") {
		if (cal.currentDateEl) {
			Zapatec.Utils.removeClass(cal.currentDateEl, "selected");
			Zapatec.Utils.addClass(el, "selected");
			closing = (cal.currentDateEl == el);
			if (!closing) {
				cal.currentDateEl = el;
			}
		}
		var tmpDate = new Date(el.caldate[0], el.caldate[1], el.caldate[2]);
		if (tmpDate.getDate() != el.caldate[2]) {
			tmpDate.setDate(el.caldate[2]);
		}
		Zapatec.Date.setDateOnly(cal.config.date, tmpDate);
		Zapatec.Date.setDateOnly(cal.currentDate, tmpDate);
		if (cal.currentDateEnd) {
			Zapatec.Date.setDateOnly(cal.currentDateEnd, tmpDate);
		}
		date = cal.config.date;
		cal.dateClicked = true;
		if (cal.config.multiple) {
			cal.toggleMultipleDate(new Date(cal.currentDate), new Date(cal.currentDateEnd));
		}
		// Update history only if date selected
		if (!cal.config.noHistory) {
			cal.updateHistory();
		}
		newdate = true;
		cal.onSetTime();
		// Fire event
		if (ev) {
			// On dblclick fire event only once
			var iNow = Date.parse(new Date());
			if (!cal.calDateClicked || iNow - cal.calDateClicked > 500) {
				cal.fireEvent('calDateClicked', tmpDate);
				cal.calDateClicked = iNow;
			}
		} else {
			cal.fireEvent('calDateSwitched', tmpDate);
		}
	} else {
		if (el.navtype == 200) {
			if (!cal.closeButton) {
				Zapatec.Utils.removeClass(el, "hilite");
				cal.callCloseHandler();
			}
			return;
		}
		date = new Date(cal.config.date);
		// Set date to Today if Today clicked AND History NOT shown
		if (el.navtype == 0 && !cal.bEventShowHistory) {
			// TODAY
			Zapatec.Date.setDateOnly(date, new Date());
		}
		// unless "today" was clicked, we assume no date was clicked so
		// the selected handler will know not to close the calenar when
		// in single-click mode.
		// cal.dateClicked = (el.navtype == 0);
		cal.dateClicked = false;
		var year = date.getFullYear();
		var mon = date.getMonth();
		function setMonth(m) {
			var day = date.getDate();
			var max = Zapatec.Date.getMonthDays(date, m);
			if (day > max) {
				date.setDate(max);
			}
			date.setMonth(m);
		}
		;

		var dateStart = null;
		switch (el.navtype) {

			case 400:
				if (!cal.helpButton) {
					Zapatec.Utils.removeClass(el, "hilite");
					cal.callHelpHandler();
				}
				return;

			case -2:
				if (year > cal.minYear) {
					Zapatec.Date.setFullYear(date, year - 1);
					// Call user function after year selected
					if (typeof cal.config.onYearSelect == "function")
						cal.config.onYearSelect(year - 1);
				}
				break;

			case -1:
				if (mon > 0) {
					setMonth(mon - cal.config.stepMonths);
				} else if (year-- > cal.minYear) {
					Zapatec.Date.setFullYear(date, year);
					setMonth(11);
				}
			// Call user function after month selected
				if (typeof cal.config.onMonthSelect == "function") {
					cal.config.onMonthSelect(mon > 0 ? mon - 1 : 11);
				}
				break;

			case 1:
				if (mon < 11) {
					setMonth(mon + cal.config.stepMonths);
				} else if (year < cal.maxYear) {
					Zapatec.Date.setFullYear(date, year + 1);
					setMonth(0);
				}
			// Call user function after month selected
				if (typeof cal.config.onMonthSelect == "function") {
					cal.config.onMonthSelect(mon < 11 ? mon + 1 : 0);
				}
				break;

			case 2:
				if (year < cal.maxYear) {
					Zapatec.Date.setFullYear(date, year + 1);
					// Call user function after year selected
					if (typeof cal.config.onYearSelect == "function") {
						cal.config.onYearSelect(year + 1);
					}
				}
				break;

			case 100:
				cal.setFirstDayOfWeek(el.fdow);
				cal.config.prefs.fdow = cal.config.firstDay;
				Zapatec.Calendar.savePrefs(cal.id);
				if (cal.config.onFDOW) {
					cal.config.onFDOW(cal.config.firstDay);
				}
				return;

			case 150:
				if (cal.config.onWeekClick) {
					cal.config.onWeekClick(el.innerHTML);
				}
				return;

			case 50:
			case 51:
			//turns off time changing if timeInterval is set with special value
				var date = cal.currentDate;
				if (el.navtype == 51) {
					date = cal.currentDateEnd;
					dateStart = cal.currentDate;
				}
			// always check ampm changes
				if (el.className.indexOf("ampm", 0) < 0 &&
					 !((cal.config.timeInterval == null) || ((cal.config.timeInterval < 60) && (el.className.indexOf("hour", 0) != -1)))) {
					break;
				}
				var range = el._range;
				var current = el.firstChild.data;
				var pm = (date.getHours() >= 12);
				for (var i = range.length; --i >= 0;) {
					if (range[i] == current) {
						break;
					}
				}
				if (ev && ev.shiftKey) {
					if (--i < 0) {
						i = range.length - 1;
					}
				} else if (++i >= range.length) {
					i = 0;
				}
			//ALLOWED TIME CHECK
			// Fills "minute" and "hour" variables with the time that user wants to set, to pass them to the dateStatusHandler.
			// As the script passes hours in 24 format, we need to convert inputed values if they are not in the needed format
				var minute = null; // minutes to be passed
				var hour = null; // hours to be passed
			// as we pass date element to the handler, we need to create new one and fill it with new minutes or hours (depending on what had changed)
				var new_date = new Date(date);
			// if "ampm" was clicked
				if (el.className.indexOf("ampm", 0) != -1) {
					minute = date.getMinutes(); // minutes didn't change
					// if the "ampm" value has changed we need to correct hours (add 12 or exclude 12 or set it to zero)
					hour = (range[i] == Zapatec.Calendar.i18n("pm", "ampm", cal)) ? ((date.getHours() == 12) ? (date.getHours()) : (date.getHours() + 12)) : (date.getHours() - 12);
					// if the time is disabled we seek the first one disabled.
					// It fixes the bug when you can not change from 'am' to 'pm' or vice versa for the dates that have restrictions for time.
					// This part of code is very easy to understand, so it don't need much comments
					if (cal.getDateStatus && cal.getDateStatus(new_date, date.getFullYear(), date.getMonth(), date.getDate(), parseInt(hour, 10), parseInt(minute, 10))) {
						var dirrect;
						if (range[i] == Zapatec.Calendar.i18n("pm", "ampm", cal)) {
							dirrect = -5;
						} else {
							dirrect = 5;
						}
						hours = hour;
						minutes = minute;
						do {
							minutes += dirrect;
							if (minutes >= 60) {
								minutes -= 60;
								++hours;
								if (hours >= 24) {
									hours -= 24;
								}
								new_date.setHours(hours);
							}
							if (minutes < 0) {
								minutes += 60;
								--hours;
								if (hours < 0) {
									hours += 24;
								}
								new_date.setHours(hours);
							}
							new_date.setMinutes(minutes);
							if (dateStart) {
								if (new_date.getHours() > dateStart.getHourse()) {
									new_date.setHours(dateStart.getHourse());
								}
								if (new_date.Minutes() > dateStart.Minutes()) {
									new_date.setMinutes(dateStart.getMinutes() + 1);
								}
							}
							if (!cal.getDateStatus(new_date, date.getFullYear(), date.getMonth(), date.getDate(), parseInt(hours, 10), parseInt(minutes, 10))) {
								hour = hours;
								minute = minutes;
								if (hour > 12) {
									i = 1;
								} else {
									i = 0;
								}
								if (dateStart) {
									var tmpDate = new Date(cal.config.dateEnd);
									tmpDate.setHours(hour);
									tmpDate.setMinutes(minute);
									if (hour > dateStart.getHours()) {
										hour = dateStart.getHours();
									}
									if (minute > dateStart.getMinutes() > dateStart.getMinutes() && cal.config.dateEnd < dateStart) {
										minute = dateStart.getMinutes();
									}
									cal.config.dateEnd.setHours(hour);
									cal.config.dateEnd.setMinutes(minute);
									cal.onSetTime(cal.currentDateEnd);
								} else {
									cal.config.date.setHours(hour);
									cal.config.date.setMinutes(minute);
									cal.onSetTime();
								}
							}
						} while ((hour != hours) || (minute != minutes));
					}
					// updates our new Date object that will be passed to the handler
					new_date.setHours(hour);
				}
			// if hours were clicked
				if (el.className.indexOf("hour", 0) != -1) {
					minute = date.getMinutes(); // minutes didn't change
					hour = (!cal.time24) ? ((pm) ? ((range[i] != 12) ? (parseInt(range[i], 10) + 12) : (12)) : ((range[i] != 12) ? (range[i]) : (0))) : (range[i]);  // new value of hours
					new_date.setHours(hour);
				}
			// if minutes were clicked
				if (el.className.indexOf("minute", 0) != -1) {
					hour = date.getHours(); // hours didn't change
					minute = range[i]; // new value of minutes
					new_date.setMinutes(minute);
				}
				var status = false;
			// if the handler is set, we pass new values and retreive result in "status" variable
				if (cal.getDateStatus) {
					status = cal.getDateStatus(new_date, date.getFullYear(), date.getMonth(), date.getDate(), parseInt(hour, 10), parseInt(minute, 10));
					if (dateStart && (hour < dateStart.getHours() || minute < dateStart.getMinutes())) {
						status = true;
					}
				}
				if (dateStart) {
					var testDate = new Date(new_date);
					testDate.setHours = parseInt(hour, 10);
					testDate.setMinutes = parseInt(minute, 10);
					if (testDate < cal.currentDate) {
						status = true;
					}
				}
				if (!status) {
					el.firstChild.data = range[i];
				}
			//END OF ALLOWED TIME CHECK
				if (dateStart) {
					cal.onUpdateTime(cal.currentDateEnd);
				} else {
					cal.onUpdateTime();
				}
				return;

			case 211:
			case 212:
				dateStart = cal.currentDate;

			case 201: // timepart, UP
			case 202: // timepart, DOWN
				var cel = el.timePart;
			//turns off time changing if timeInterval is set with special value
				var date = null;
				if (dateStart) {
					date = cal.currentDateEnd;
				} else {
					date = cal.currentDate;
				}
				if ((cel.className.indexOf("minute", 0) != -1) && (cal.config.timeInterval > 30)) {
					break;
				}
				var val = parseInt(cel.firstChild.data, 10);
				var pm = (date.getHours() >= 12);
				var range = cel._range;
				for (var i = range.length; --i >= 0;) {
					if (val == range[i]) {
						val = i;
						break;
					}
				}
				var step = cel._step;
				if (el.navtype == 201 || el.navtype == 211) {
					val = step * Math.floor(val / step);
					val += step;
					if (val >= range.length) {
						val = 0;
					}
				} else {
					val = step * Math.ceil(val / step);
					val -= step;
					if (val < 0) {
						val = range.length - step;
					}
				}
			//ALLOWED TIME CHECK
			//if (cal.getDateStatus) { //Current time is changing, check with the callback to see if it's in range of allowed times
			// Fills "minute" and "hour" variables with the time that user wants to set, to pass them to the dateStatusHandler.
			// As the script passes hours in 24 format, we need to convert inputed values if they are not in the needed format
				var minute = null; // minutes to be passed
				var hour = null; // hours to be passed
			// as we pass date element to the handler, we need to create new one and fill it with new minutes or hours (depending on what had changed)
				var new_date = new Date(date);
			// if hours were changed
				if (cel.className == "hour") {
					minute = date.getMinutes();
					hour = (!cal.time24) ? ((pm) ? ((range[val] != 12) ? (parseInt(range[val], 10) + 12) : (12)) : ((range[val] != 12) ? (range[val]) : (0))) : (range[val]);
					new_date.setHours(hour);
				}
			// if minutes were changed
				if (cel.className == "minute") {
					hour = date.getHours();
					minute = val;
					new_date.setMinutes(range[val]);
				}
				var status = false;
			// if the handler is set, we pass new values and retreive result in "status" variable
				if (cal.getDateStatus) {
					status = cal.getDateStatus(new_date, date.getFullYear(), date.getMonth(), date.getDate(), parseInt(hour, 10), parseInt(minute, 10));
					if (dateStart && (hour < dateStart.getHours() || minute < dateStart.getMinutes())) {
						status = true;
					}
				}
				if (dateStart) {
					var testDate = new Date(new_date);
					testDate.setHours = parseInt(hour, 10);
					testDate.setMinutes = parseInt(minute, 10);
					if (testDate < cal.currentDate) {
						status = true;
					}
				}
				if (!status) {
					cel.firstChild.data = range[val];
				}
				if (dateStart) {
					cal.onUpdateTime(cal.currentDateEnd);
				} else {
					cal.onUpdateTime();
				}
			//END OF ALLOWED TIME CHECK
				return;

			case 0:
			// TODAY will bring us here
				if (cal.config.onTodayClick) {
					cal.config.onTodayClick(el.innerHTML);
				}
			//fix for the today bug for the special dates
				if (cal.getDateStatus && ((cal.getDateStatus(date, date.getFullYear(), date.getMonth(), date.getDate()) == true) || (cal.getDateStatus(date, date.getFullYear(), date.getMonth(), date.getDate()) == "disabled"))) {
					// remember, "date" was previously set to new Date() if TODAY was clicked; thus, it  contains today date.
					return false;
				}
				break;
		}

		if (!Zapatec.Date.equalsTo(date, cal.config.date) /*|| cal.config.numberMonths*/) {
			if (el.navtype && el.navtype >= -2 && el.navtype <= 2) {
				cal._init(cal.config.firstDay, date, true);
				return;
			}
			cal.setDate(date);
			newdate = true;
			// Fire event
			if (ev) {
				// On dblclick fire event only once
				var iNow = Date.parse(new Date());
				if (!cal.calDateClicked || iNow - cal.calDateClicked > 500) {
					cal.fireEvent('calDateClicked', date);
					cal.calDateClicked = iNow;
				}
			} else {
				cal.fireEvent('calDateSwitched', date);
			}
		}
	}
	if (newdate) {
		cal.callHandler();
	}
	if (closing && cal.isPopup) {
		Zapatec.Utils.removeClass(el, "hilite");
		cal.callCloseHandler();
	}
};


// event handlers

/**
 * This is an event handler that gets called when the mouse button is released
 * upon the document.  The name (tableMouseUp) is because of historic reasons
 * (in the initial calendar versions this event was triggered by the calendar
 * table, but now it's the document who does it).
 *
 * This function does a number of things.  It determines which is the element
 * that was actually clicked.  Note that the "mouseup" event usually means
 * "something was clicked"; it's "mouseup" who fires the "onclick" event, not
 * "mousedown" ;-).  So, if the clicked element is a member of one of the combo
 * boxes such as month, year or history, then the appropriate action is taken
 * (switch month, year or go to history date).
 *
 * Also, the Zapatec.Calendar.cellClick() function is called, which further
 * examines the target element and might do other things.
 *
 * Finally, this handler deregisters itself (it's automatically enabled at
 * "mousedown" on document), stops the event propagation, sets the static _C
 * variable to \em null (meaning "no calendar is currently in use").
 *
 * @param ev [Event] the event object
 * @return false
 */
Zapatec.Calendar.tableMouseUp = function(ev) {
	var cal = Zapatec.Calendar.activeCalendar;
	if (!cal) {
		return false;
	}
	if (cal.timeout) {
		clearTimeout(cal.timeout);
	}
	var el = cal.activeDiv;
	if (!el) {
		return false;
	}
	var target = Zapatec.Utils.getTargetElement(ev);
	if (typeof(el.navtype) == "undefined") {
		while (target && !target.calendar) {
			target = target.parentNode;
		}
	}
	ev || (ev = window.event);
	Zapatec.Utils.removeClass(el, "active");
	if (target && (target == el || target.parentNode == el)) {
		Zapatec.Calendar.cellClick(el, ev);
	}
	var mon = Zapatec.Calendar.findMonth(target);
	var date = null;
	if (mon) {
		if (!mon.disabled) {
			date = new Date(cal.config.date);
			if (mon.month != date.getMonth()) {
				date.setMonth(mon.month);
				date.setMonth(mon.month);
				cal.setDate(date, true);
				cal.dateClicked = false;
				cal.callHandler();
			}
		}
		// Call user function after month selected
		if (typeof cal.config.onMonthSelect == "function")
			cal.config.onMonthSelect(mon.month);
	} else {
		var year = Zapatec.Calendar.findYear(target);
		if (year) {
			date = new Date(cal.config.date);
			if (year.year != date.getFullYear()) {
				Zapatec.Date.setFullYear(date, year.year);
				cal.setDate(date, true);
				cal.dateClicked = false;
				cal.callHandler();
			}
			// Call user function after year selected
			if (typeof cal.config.onYearSelect == "function")
				cal.config.onYearSelect(year.year);
		} else {
			var hist = Zapatec.Calendar.findHist(target);
			if (hist && !Zapatec.Date.dateEqualsTo(hist.histDate, cal.config.date)) {
				//Zapatec.Date.setDateOnly((date = new Date(cal.config.date)), hist.histDate);
				date = new Date(hist.histDate);
				cal._init(cal.config.firstDay, cal.config.date = date);
				cal.dateClicked = false;
				cal.callHandler();
				// Call user function after history selected
				if (typeof cal.config.onHistorySelect == "function")
					cal.config.onHistorySelect(hist.histDate);
			}
		}
	}

	Zapatec.Utils.removeEvent(window.document, "mouseup", Zapatec.Calendar.tableMouseUp);
	Zapatec.Utils.removeEvent(window.document, "mouseover", Zapatec.Calendar.tableMouseOver);
	Zapatec.Utils.removeEvent(window.document, "mousemove", Zapatec.Calendar.tableMouseOver);

	cal._hideCombos();

	return Zapatec.Utils.stopEvent(ev);
};

/**
 * Event handler that gets called when the end-user moves the mouse over the
 * document.
 *
 * This function is pretty complicated too.  It adds hover/active state class
 * to elements that are highlighted and/or clicked.  It determines whether one
 * is trying to modify the time by "drag'n'drop" (the original interface
 * implemented by the calendar).  Finally, it determines if the
 * mouse is over combo box items, also adding/removing hover states and setting
 * some calendar variables with reference to the element involved.
 *
 * @param ev
 *
 */
Zapatec.Calendar.tableMouseOver = function (ev) {
	var cal = Zapatec.Calendar.activeCalendar;
	if (!cal) {
		return;
	}
	var el = cal.activeDiv;
	var target = Zapatec.Utils.getTargetElement(ev);
	if (target == el || target.parentNode == el) {
		// Remove rowhilite for _keyEvents
		if (this.lastRowHilite) {
			Zapatec.Utils.removeClass(this.lastRowHilite, "rowhilite");
			this.lastRowHilite = null;
		}
		if (!(el.navtype == 200 && cal.closeButton) && !(el.navtype == 400 && cal.helpButton))
			Zapatec.Utils.addClass(el, "hilite");
		Zapatec.Utils.addClass(el, "active");
		if (el.navtype != 50 && el.navtype != 51)
			Zapatec.Utils.addClass(el.parentNode, "rowhilite");
	} else {
		if (typeof el.navtype == "undefined" ||
			 ((el.navtype != 50 || el.navtype != 51) && ((el.navtype == 0 && !cal.histCombo) || Math.abs(el.navtype) > 2)))
			Zapatec.Utils.removeClass(el, "active");
		Zapatec.Utils.removeClass(el, "hilite");
		Zapatec.Utils.removeClass(el.parentNode, "rowhilite");
	}
	ev || (ev = window.event);
	if ((el.navtype == 50 || el.navtype == 51) && target != el) {
		var pos = Zapatec.Utils.getAbsolutePos(el);
		var w = el.offsetWidth;
		var x = ev.clientX;
		var dx;
		var decrease = true;
		if (x > pos.x + w) {
			dx = x - pos.x - w;
			decrease = false;
		} else
			dx = pos.x - x;

		if (dx < 0) dx = 0;
		var range = el._range;
		var current = el._current;
		var date = null;
		var dateStart = null;
		if (el.navtype == 51)
			dateStart = cal.currentDate;
		if (dateStart)
			date = cal.currentDateEnd;
		else
			date = cal.currentDate;

		var pm = (date.getHours() >= 12);
		var old = el.firstChild.data;  // old value of the element
		var count = Math.floor(dx / 10) % range.length;
		for (var i = range.length; --i >= 0;)
			if (range[i] == current)
				break;
		while (count-- > 0)
			if (decrease) {
				if (--i < 0) {
					i = range.length - 1;
				}
			} else if (++i >= range.length) {
				i = 0;
			}

		//ALLOWED TIME CHECK
		//Current time is changing, check with the callback to see if it's in range of allowed times
		// Fills the "minute" and "hour" variables with the time that user wants to set, to pass them to the dateStatusHandler for verification.
		// As the script passes hours in 24 format, we need to convert input values if they are not in the needed format.
		var minute = null; // minutes to be passed
		var hour = null; // hours to be passed
		var new_date = new Date(date); // as we pass date element to the handler, we need to create new one and fill it with new minutes or hours (depending on what had changed)
		// if "ampm" was clicked
		if (el.className.indexOf("ampm", 0) != -1) {
			minute = date.getMinutes(); // minutes didn't change
			// if the "ampm" value has changed we need to correct hours (add 12 or exclude 12 or set it to zero)
			if (old != range[i]) {
				hour = (range[i] == Zapatec.Calendar.i18n("pm", "ampm", cal)) ? ((date.getHours() == 0) ? (12) : (date.getHours() + 12)) : (date.getHours() - 12);
			} else {
				hour = date.getHours();
			}
			// updates our new Date object that will be passed to the handler
			new_date.setHours(hour);
		}
		// if hours were clicked
		if (el.className.indexOf("hour", 0) != -1) {
			minute = date.getMinutes(); // minutes didn't change
			hour = (!cal.time24) ? ((pm) ? ((range[i] != 12) ? (parseInt(range[i], 10) + 12) : (12)) : ((range[i] != 12) ? (range[i]) : (0))) : (range[i]); // new value of hours
			new_date.setHours(hour);
		}
		// if minutes were clicked
		if (el.className.indexOf("minute", 0) != -1) {
			hour = date.getHours(); // hours didn't change
			minute = range[i]; // new value of minutes
			new_date.setMinutes(minute);
		}

		var status = false;
		// if the handler is set, we pass new values and retrieve result in "status" variable
		if (cal.getDateStatus) {
			status = cal.getDateStatus(new_date, date.getFullYear(), date.getMonth(), date.getDate(), parseInt(hour, 10), parseInt(minute, 10));
		}

		// if time is enabled, we set new value
		if (status == false) {
			if (!((!cal.time24) && (range[i] == Zapatec.Calendar.i18n("pm", "ampm", cal)) && (hour > 23))) {
				el.firstChild.data = range[i];
			}
		}

		cal.onUpdateTime();
		//END OF ALLOWED TIME CHECK
	}
	var mon = Zapatec.Calendar.findMonth(target);
	if (mon) {
		if (!mon.disabled) {
			if (mon.month != cal.config.date.getMonth()) {
				if (cal.hilitedMonth) {
					Zapatec.Utils.removeClass(cal.hilitedMonth, "hilite");
				}
				Zapatec.Utils.addClass(mon, "hilite");
				cal.hilitedMonth = mon;
			} else if (cal.hilitedMonth) {
				Zapatec.Utils.removeClass(cal.hilitedMonth, "hilite");
			}
		}
	} else {
		if (cal.hilitedMonth) {
			Zapatec.Utils.removeClass(cal.hilitedMonth, "hilite");
		}
		var year = Zapatec.Calendar.findYear(target);
		if (year) {
			if (year.year != cal.config.date.getFullYear()) {
				if (cal.hilitedYear) {
					Zapatec.Utils.removeClass(cal.hilitedYear, "hilite");
				}
				Zapatec.Utils.addClass(year, "hilite");
				cal.hilitedYear = year;
			} else if (cal.hilitedYear) {
				Zapatec.Utils.removeClass(cal.hilitedYear, "hilite");
			}
		} else {
			if (cal.hilitedYear) {
				Zapatec.Utils.removeClass(cal.hilitedYear, "hilite");
			}
			var hist = Zapatec.Calendar.findHist(target);
			if (hist) {
				if (!Zapatec.Date.dateEqualsTo(hist.histDate, cal.config.date)) {
					if (cal.hilitedHist) {
						Zapatec.Utils.removeClass(cal.hilitedHist, "hilite");
					}
					Zapatec.Utils.addClass(hist, "hilite");
					cal.hilitedHist = hist;
				} else if (cal.hilitedHist) {
					Zapatec.Utils.removeClass(cal.hilitedHist, "hilite");
				}
			} else if (cal.hilitedHist) {
				Zapatec.Utils.removeClass(cal.hilitedHist, "hilite");
			}
		}
	}

	return Zapatec.Utils.stopEvent(ev);
};

/**
 * \defgroup dndmove Drag'n'drop (move calendar) functions
 *
 * Contains some functions that implement calendar "drag'n'drop" facility which
 * allows one to move the calendar around the browser's view.
 */
//@{
/**
 * Called at mouseover and/or mousemove on document, this function repositions
 * the calendar according to the current mouse position.
 *
 * @param ev [Event] The Event object
 * @return false
 */
Zapatec.Calendar.calDragIt = function (ev) {
	ev || (ev = window.event);
	var cal = Zapatec.Calendar.activeCalendar;

	if (!cal) {
		Zapatec.Caslendar.calDragEnd();
	}
	if (!cal.config.disableDrag) {
		if (!(cal && cal.dragging)) {
			return false;
		}
		var posX = ev.clientX + window.document.body.scrollLeft;
		var posY = ev.clientY + window.document.body.scrollTop;
		cal.hideShowCovered();
		var st = cal.element.style, L = posX - cal.xOffs, T = posY - cal.yOffs;
		st.left = L + "px";
		st.top = T + "px";
		Zapatec.Utils.setupWCH(cal.WCH, L, T);
	}
	return Zapatec.Utils.stopEvent(ev);
};

/**
 * Gets called when the drag and drop operation is finished; thus, at
 * "onmouseup".  This function unregisters D'n'D event handlers and calls
 * Zapatec.Calendar.hideShowCovered() which repaints as appropriate any
 * "windowed controls" that might have been hidden by the end user moving the
 * calendar. (note, this is only for IE5; for IE5.5 there are better--albeit
 * uglier--workarounds).
 *
 * @param ev [Event] the event object
 * @return false
 */
Zapatec.Calendar.calDragEnd = function (ev) {
	var cal = Zapatec.Calendar.activeCalendar;
	Zapatec.Utils.removeEvent(window.document, "mousemove", Zapatec.Calendar.calDragIt);
	Zapatec.Utils.removeEvent(window.document, "mouseover", Zapatec.Calendar.calDragIt);
	Zapatec.Utils.removeEvent(window.document, "mouseup", Zapatec.Calendar.calDragEnd);
	if (!cal) {
		return false;
	}
	cal.dragging = false;
	Zapatec.Calendar.tableMouseUp(ev);
	cal.hideShowCovered();
};


/**
 * Function for changig calendar size (used in IE)
 *
 * @private
 * @param {string} elementId - id of the changing element
 */
Zapatec.Calendar._zoomIn = function (elementId) {
	var oZoom = document.getElementById(elementId);
	var newZoom = parseInt(oZoom.style.zoom) + 10 + '%'
	oZoom.style.zoom = newZoom;
}

/**
 * Function for changig calendar size (used in IE)
 *
 * @private
 * @param {string} elementId - id of the changing element
 */
Zapatec.Calendar._zoomOut = function (elementId) {
	var oZoom = document.getElementById(elementId);
	var newZoom = parseInt(oZoom.style.zoom) - 10 + '%'
	oZoom.style.zoom = newZoom;
}

/**
 * Function for zoom in ie
 *
 * @private
 * @param {Object} event
 */
Zapatec.Calendar.zoomElement = function (event, elementId) {
	if (!Zapatec.is_ie)
		return;

	if (!document.getElementById(elementId).style.zoom)
		document.getElementById(elementId).style.zoom = "100%";
	var delta = 0;
	if (!event) event = window.event;
	if (event.wheelDelta) {
		delta = event.wheelDelta / 120;
		if (window.opera) delta = -delta;
	} else if (event.detail) {
		delta = -event.detail / 3;
	}

	if (delta && event.ctrlKey) {
		if (delta > 0)
			Zapatec.Calendar._zoomOut(elementId);
		if (delta < 0)
			Zapatec.Calendar._zoomIn(elementId);
	}

	if (event.preventDefault)
		event.preventDefault();
	event.returnValue = false;
}

//@}

// END: CALENDAR STATIC FUNCTIONS

// BEGIN: CALENDAR OBJECT FUNCTIONS

/**
 * This function creates the calendar HTML elements inside the given parent.
 * If _par is null than it creates a popup calendar inside the BODY element.
 * If _par is an element, be it BODY, then it creates a non-popup calendar
 * (still hidden).
 *
 * The function looks rather complicated, but what it does is quite simple.
 * The basic calendar elements will be created, that is, a containing DIV, a
 * TABLE that contains a headers (titles, navigation bar and day names bars), a
 * body containing up to 12 months, each has 6 rows with 7 or 8 cells (this depends on whether week
 * numbers are on or off) and a footer containing the status bar.  Appropriate
 * event handlers are assigned to all buttons or to the titles and status bar
 * (for drag'n'drop).
 *
 * This function also builds the time selector if the calendar is configured
 * so, and it also creates the elements required for combo boxes (years,
 * months, history).
 *
 * This function does not display day names or dates.  This is done in
 * Zapatec.Calendar.prototype._init().  Therefore, by separating these 2
 * actions we can make date switching happen much faster because the _init
 * function will already have the elements in place (so we don't need to create
 * them again and again).  This was a major improvement which got in
 * the calendar v0.9.1.
 *
 * @param _par
 */
Zapatec.Calendar.prototype.create = function (_par) {
	var parent = null;
	if (! _par) {
		// default parent is the document body, in which case we create
		// a popup calendar.
		var oInputField = this.config.inputField;
		if (oInputField) {
			parent = oInputField.parentNode;
		} else {
			parent = window.document.getElementsByTagName("body")[0];
		}
		this.isPopup = true;
		this.WCH = Zapatec.Utils.createWCH(parent);
	} else {
		parent = _par;
		this.isPopup = false;
	}
	this.currentDate = this.config.date = this.dateStr ? new Date(this.dateStr) : new Date();
	if (this.config.timeRange)
		this.currentDateEnd = new Date(this.currentDate);

	var rootTable = Zapatec.Utils.createElement("table");
	rootTable.cellSpacing = 0;
	rootTable.cellPadding = 0;
	rootTable.id = "zpCalendar" + this.id + "RootTable";
	rootTable.className = 'zpCalRootTable';
	this.table = rootTable;
	Zapatec.Utils.createProperty(rootTable, "calendar", this);
	Zapatec.Utils.addEvent(rootTable, "mousedown", Zapatec.Calendar.tableMouseDown);
	//FIX for Opera's bug with row highlighting
	if (Zapatec.is_opera) {
		rootTable.style.width = (this.config.monthsInRow * ((this.config.weekNumbers) ? (8) : (7)) * 2 + 4.4 * this.config.monthsInRow) + "em";
	}

	var div = Zapatec.Utils.createElement("div");
	this.element = div;
	this.container = this.element;
	div.className = "calendar " + this.getClassName({prefix: "zpCalendar"}) + " zpCalendar" + this.config.themeSize;

	div.id = "zpCal" + this.id + "Container";
	// Set size for calendar in IE
	if (Zapatec.is_ie) {
		Zapatec.Utils.addEvent(div, "mousewheel", new Function("Zapatec.Calendar.zoomElement(window.event,'" + div.id + "')"));
	}

	if (this.isPopup) {
		div.style.position = "absolute";
		div.style.display = "none";
	}
	div.appendChild(rootTable);

	var cell = null;
	var row = null;

	var cal = this;
	var hh = function (text, cs, navtype, buttonType) {
		cell = Zapatec.Utils.createElement("td", row);
		if (buttonType) {
			cell.id = "zpCal" + cal.id + buttonType + "ButtonStatus";
		}
		cell.colSpan = cs;
		cell.className = "button";
		if (Math.abs(navtype) <= 2)
			cell.className += " nav";
		Zapatec.Calendar._add_evs(cell);
		Zapatec.Utils.createProperty(cell, "calendar", cal);
		cell.navtype = navtype;
		if (text.substr(0, 1) != "&") {
			cell.appendChild(document.createTextNode(text));
		}
		else {
			// FIXME: dirty hack for entities
			cell.innerHTML = text;
		}
		return cell;
	};
	var hd = function(par, colspan, buttonType) {
		cell = Zapatec.Utils.createElement("td", par);
		if (buttonType) {
			cell.id = "zpCal" + cal.id + buttonType + "ButtonStatus";
		}
		cell.colSpan = colspan;
		cell.className = "button";
		cell.innerHTML = "<div>&nbsp</div>";
		return cell;
	};

	//Creating all the controls on the top
	var title_length = ((this.config.weekNumbers) ? (8) : (7)) * this.config.monthsInRow - 2;

	var rootTbody = Zapatec.Utils.createElement("tbody", rootTable);
	var trOfRootTable = Zapatec.Utils.createElement("tr", rootTbody);
	trOfRootTable.id = "zpCalendar" + this.id + "RootTableTR1";
	var tdOfRootTable = Zapatec.Utils.createElement("td", trOfRootTable);
	tdOfRootTable.id = "zpCalendar" + this.id + "RootTableTR1TD1";
	tdOfRootTable.className = "RootTableTD";
	var table = Zapatec.Utils.createElement("table", tdOfRootTable);
	table.id = "zpCalendar" + this.id + "Calendar1RootContainer";
	table.className = 'zpCalTable';
	table.cellSpacing = 0;
	table.cellPadding = 0;
	var thead = Zapatec.Utils.createElement("thead", table);
	if (this.config.numberMonths == 1) {
		this.title = thead;
	} else {
		// http://trac.zapatec.net/changeset/16829 && SUITE-6
		//thead.style.display = 'none';
	}

	row = Zapatec.Utils.createElement("tr", thead);
	var help_length = 0, close_length = 0;

	if (!this.config.minimal) {
		if (this.config.closeButton || this.config.helpButton) {
			// Set buttons
			cell = Zapatec.Utils.createElement("td", row);
			cell.colSpan = title_length + 2;
			var table1 = Zapatec.Utils.createElement("table", cell);
			table1.style.border = "none";
			table1.width = "100%";
			table1.cellPadding = 0;
			table1.cellSpacing = 0;
			table1 = Zapatec.Utils.createElement("tbody", table1);
			row = Zapatec.Utils.createElement("tr", table1);
			row.vAlign = "middle";
		}
		if (!this.config.noHelp) {
			if (this.config.helpButton) {
				var calendarHelpButton = hh(this.config.helpButton ? "" : "?", 1, 400, "Help");
				calendarHelpButton.appendChild(this.helpButton.getContainer());
				if (this.helpButton.getContainer().style.width)
					help_length = this.helpButton.getContainer().style.width;
				if (this.helpButton.img.width)
					help_length = this.helpButton.img.width;
			} else {
				var calendarHelpButton = hh(this.config.helpButton ? "" : "?", 1, 400, "Help");
			}
			calendarHelpButton.ttip = Zapatec.Calendar.i18n("INFO", null, this);
		} else {
			hd(row, 1, "Help");
		}
		this.title = hh("&nbsp;", title_length, 300);
		this.title.className = "title";
		this.title.id = "zpCal" + this.id + "Title";
		if (this.isPopup) {
			if (!this.config.disableDrag) {
				this.title.ttip = Zapatec.Calendar.i18n("DRAG_TO_MOVE", null, this);
				this.title.style.cursor = "move";
			}
			if (!this.config.noCloseButton) {
				if (this.config.closeButton) {
					var calendarCloseButton = hh(this.config.closeButton ? "" : "&#x00d7;", 1, 200, "Close");
					calendarCloseButton.appendChild(this.closeButton.getContainer());
					if (this.closeButton.getContainer().style.width)
						close_length = this.closeButton.getContainer().style.width;
					if (this.closeButton.img.width)
						close_length = this.closeButton.img.width;
				} else {
					var calendarCloseButton = hh(this.config.closeButton ? "" : "&#x00d7;", 1, 200, "Close");
				}
				calendarCloseButton.ttip = Zapatec.Calendar.i18n("CLOSE", null, this);
			} else {
				hd(row, 1, "Close");
			}
		} else {
			hd(row, 1, "Close");
		}
		if (help_length > 0 || close_length > 0) {
			calendarHelpButton.width = calendarCloseButton.width = Math.max(help_length, close_length);
		}

		row = Zapatec.Utils.createElement("tr", thead);
		this._nav_py = hh("&#x00ab;", 1, -2, "PrevYear");
		this._nav_py.ttip = Zapatec.Calendar.i18n("PREV_YEAR", null, this);
		this._nav_pm = hh("&#x2039;", 1, -1, "PrevMonth");
		this._nav_pm.ttip = Zapatec.Calendar.i18n("PREV_MONTH", null, this);
		this._nav_now = hh(Zapatec.Calendar.i18n("TODAY", null, this), title_length - 2, 0, "Today");
		this._nav_now.ttip = Zapatec.Calendar.i18n("GO_TODAY", null, this);
		this._nav_nm = hh("&#x203a;", 1, 1, "NextMonth");
		this._nav_nm.ttip = Zapatec.Calendar.i18n("NEXT_MONTH", null, this);
		this._nav_ny = hh("&#x00bb;", 1, 2, "NextYear");
		this._nav_ny.ttip = Zapatec.Calendar.i18n("NEXT_YEAR", null, this);

	} else {
		this._nav_py = {disabled:true};
		this._nav_ny = {disabled:true};

		if (this.config.hideNavPanel) {
			this._nav_pm = {disabled:true};
			this.title = {disabled:true};
			this._nav_nm = {disabled:true};
		} else {
			this._nav_pm = hh("&#x2039;", 1, -1, "PrevMonth");
			this._nav_pm.ttip = Zapatec.Calendar.i18n("PREV_MONTH", null, this);
			this.title = hh("&nbsp;", title_length, 300);
			this.title.className = "title";
			this.title.id = "zpCal" + this.id + "Title";
			if (this.isPopup) {
				if (!this.config.disableDrag) {
					this.title.ttip = Zapatec.Calendar.i18n("DRAG_TO_MOVE", null, this);
					this.title.style.cursor = "move";
				}
			}
			this._nav_nm = hh("&#x203a;", 1, 1, "NextMonth");
			this._nav_nm.ttip = Zapatec.Calendar.i18n("NEXT_MONTH", null, this);
		}
	}


	//Here we calculate the number of rows for multimonth calendar
	var rowsOfMonths = Math.floor(this.config.numberMonths / this.config.monthsInRow);
	if (this.config.numberMonths % this.config.monthsInRow > 0) {
		++rowsOfMonths;
	}
	//Every iteration of this cycle creates a row of months in the calendar
	var iId = this.id;
	var oConfig = this.config;
	var iMonths = oConfig.numberMonths;
	var iMonthInRow = oConfig.monthsInRow;
	var bHideNavPanel = oConfig.hideNavPanel;
	for (var l = 1; l <= rowsOfMonths; ++l) {
		if (l > 1) {
			trOfRootTable = Zapatec.Utils.createElement("tr", rootTbody);
			trOfRootTable.id = "zpCalendar" + this.id + "RootTableMarginTR" + (l - 1);
			trOfRootTable.className = "marginTR";
			// creating td that will be a "margin"
			tdOfRootTable = Zapatec.Utils.createElement("td", trOfRootTable);
			tdOfRootTable.id = "zpCalendar" + this.id + "RootTableMarginTR" + (l - 1) + "TD" + (l - 1);
			tdOfRootTable.className = "marginTD";
			trOfRootTable = Zapatec.Utils.createElement("tr", rootTbody);
			trOfRootTable.id = "zpCalendar" + this.id + "RootTableTR" + l;
			tdOfRootTable = Zapatec.Utils.createElement("td", trOfRootTable);
			tdOfRootTable.id = "zpCalendar" + this.id + "RootTableTR" + l + "TD" + l;
			tdOfRootTable.className = "RootTableTD" + l;
			table = Zapatec.Utils.createElement("table", tdOfRootTable);
			table.id = "zpCalendar" + this.id + "Calendar" + l + "RootContainer";
			table.className = 'zpCalTable';
			table.cellSpacing = 0;
			table.cellPadding = 0;
		}
		var thead = Zapatec.Utils.createElement("thead", table);
		//Fix for the Operas bug, this is a workaround which makes Opera display THEAD elements as TBODY el.
		//The problem is that Opera displays all the THEAD elements in the table first, and only then TBODY elements (an ugly look!).
		if (Zapatec.is_opera) {
			thead.style.display = "table-row-group";
		}
		if (iMonths != 1) {
			row = zapatecUtils.createElement("tr", thead);
			row.className = "rowSubTitleContainer";
			var title_length = 5;
			oConfig.weekNumbers && ++title_length;
			//creating the titles for the months
			this.titles[l] = new Array();
			for (var k = 1; (k <= iMonthInRow) && ((l - 1) * iMonthInRow + k <= iMonths); ++k) {
				if (bHideNavPanel) {
					if (l == 1) {
						cell = zapatecUtils.createElement("td", row);
						cell.colSpan = 1;
						cell.className = "zpCalPrevMonth";
						cell.navtype = -1;
						this._nav_pm = {navtype: -1, calendar: this, className: ""};
						cell.onclick = function() {
							zapatecCalendar.cellClick(cal._nav_pm)
						};
						cell.innerHTML = '<div class="zpCalPrevMonthArrow"></div>';
						this.titles[l][k] = hh("&nbsp;", title_length, 300);
						this.titles[l][k].className = "title";
						this.titles[l][k].id = "zpCal" + iId + "SubTitle" + ((l - 1) * iMonthInRow + k);
						cell = zapatecUtils.createElement("td", row);
						cell.colSpan = 1;
						cell.className = "zpCalNextMonth";
						this._nav_nm = {navtype: 1, calendar: this, className: ""};
						cell.onclick = function() {
							zapatecCalendar.cellClick(cal._nav_nm)
						};
						cell.innerHTML = '<div class="zpCalNextMonthArrow"></div>';
					} else {
						this.titles[l][k] = hh("&nbsp;", title_length + 2, 300);
						this.titles[l][k].className = "title";
						this.titles[l][k].id = "zpCal" + iId + "SubTitle" + ((l - 1) * iMonthInRow + k);
					}
				} else {
					hd(row, 1);
					this.titles[l][k] = hh("&nbsp;", title_length, 300);
					this.titles[l][k].className = "title";
					this.titles[l][k].id = "zpCal" + iId + "SubTitle" + ((l - 1) * iMonthInRow + k);
					hd(row, 1);
				}
			}
		}
		// day names
		row = Zapatec.Utils.createElement("tr", thead);
		row.className = "daynames";
		for (k = 1; (k <= this.config.monthsInRow) && ((l - 1) * this.config.monthsInRow + k <= this.config.numberMonths); ++k) {
			if (this.config.weekNumbers) {
				cell = Zapatec.Utils.createElement("td", row);
				cell.className = "name wn";
				cell.appendChild(window.document.createTextNode(Zapatec.Calendar.i18n("WK", null, this)));
				if (k > 1) {
					Zapatec.Utils.addClass(cell, "month-left-border");
				}
				var cal_wk = Zapatec.Calendar.i18n("WK", null, this)
				if (cal_wk == null) {
					//if it's not defined in the language file, leave it blank
					cal_wk = "";
				}

			}
			//week day names cells
			for (var i = 7; i > 0; --i) {
				cell = Zapatec.Utils.createElement("td", row);
				cell.appendChild(document.createTextNode("&nbsp;"));
				cell.id = "zpCal" + this.id + "WeekDayButton" + (7 - i) + "Status";
			}
		}
		this.firstDayName = row.childNodes[this.config.weekNumbers ? 1 : 0];
		this.rowsOfDayNames[l] = this.firstDayName;
		this._displayWeekdays();

		var tbody = Zapatec.Utils.createElement("tbody", table);
		this.tbody[l] = tbody;

		for (i = 6; i > 0; --i) {
			//creating a row of days for all the months in the row
			row = Zapatec.Utils.createElement("tr", tbody);
			for (k = 1; (k <= this.config.monthsInRow) && ((l - 1) * this.config.monthsInRow + k <= this.config.numberMonths); ++k) {
				if (this.config.weekNumbers) {
					cell = Zapatec.Utils.createElement("td", row);
					cell.id = "zpCal" + this.id + "WeekNumber" + (6 - i);
					if (typeof this.config.onWeekClick == "function") {
						cell.navtype = 150;
						cell.calendar = this;
						cell.value = k;
						Zapatec.Calendar._add_evs(cell);
					}
					cell.appendChild(document.createTextNode("&nbsp;"));
				}
				for (var j = 7; j > 0; --j) {
					cell = Zapatec.Utils.createElement("td", row);
					cell.id = "zpCal" + this.id + "DateCell" + ((l - 1) * this.config.monthsInRow + k) + "-" + (6 - i) + "-" + (7 - j);
					cell.appendChild(document.createTextNode("&nbsp;"));
					Zapatec.Utils.createProperty(cell, "calendar", this);
					Zapatec.Calendar._add_evs(cell);
				}
			}
		}
	}

	var tfoot = Zapatec.Utils.createElement("tfoot", table);

	if (this.config.showsTime) {
		row = Zapatec.Utils.createElement("tr", tfoot);
		row.className = "time";
		//empty area for positioning the time controls under the control month
		var emptyColspan;
		if (this.config.monthsInRow != 1) {
			cell = Zapatec.Utils.createElement("td", row);
			emptyColspan = cell.colSpan = Math.ceil((((this.config.weekNumbers) ? 8 : 7) * (this.config.monthsInRow - 1)) / 2);
			if (this.config.timeRange) cell.rowSpan = 2;
			cell.className = "timetext";
			cell.innerHTML = "&nbsp";
		}

		cell = Zapatec.Utils.createElement("td", row);
		cell.className = "timetext";
		cell.colSpan = this.config.weekNumbers ? 2 : 1;
		if (this.config.timeRange)
			cell.rowSpan = 2;
		cell.innerHTML = Zapatec.Calendar.i18n("TIME", null, this) || "&nbsp;";
		var firstrow = row;
		// For later "TIME_PART" init (ex.2)
		Zapatec.Calendar.activeCalendar = this;

		(function() {
			function makeTimePart(className, partId, init, range_start, range_end, timeRange) {
				var table, tbody, tr, tr2, part;
				if (range_end) {
					cell = Zapatec.Utils.createElement("td", row);
					cell.colSpan = 1;
					if (cal.config.showsTime != "seconds") {
						++cell.colSpan;
					}
					cell.className = "parent-" + className;
					table = Zapatec.Utils.createElement("table", cell);
					table.cellSpacing = table.cellPadding = 0;
					if (className == "hour")
						table.align = "right";
					table.className = "calendar-time-scroller";
					tbody = Zapatec.Utils.createElement("tbody", table);
					tr = Zapatec.Utils.createElement("tr", tbody);
					tr2 = Zapatec.Utils.createElement("tr", tbody);
					if (timeRange) cell.style.border = "none";
				} else
					tr = row;
				part = Zapatec.Utils.createElement("td", tr);
				part.className = className;
				part.id = "zpTime" + cal.id + partId + "SelectStatus";
				part.appendChild(window.document.createTextNode(init < 10 ? '0' + init : init));
				Zapatec.Utils.createProperty(part, "calendar", cal);
				part.ttip = Zapatec.Calendar.i18n("TIME_PART", null);
				part.navtype = 50;
				if (cal.config.timeRange && partId.substr(partId.length - 1) == '1')
					part.navtype = 51;
				part._range = [];
				if (!range_end)
					part._range = range_start < 10 ? '0' + range_start : range_start;
				else {
					part.rowSpan = 2;
					for (var i = range_start; i <= range_end; ++i) {
						var txt;
						if (i < 10 && range_end >= 10) txt = '0' + i;
						else txt = '' + i;
						part._range[part._range.length] = txt;
					}
					var up = Zapatec.Utils.createElement("td", tr);
					up.className = "up";
					up.navtype = 201;
					if (cal.config.timeRange && partId.substr(partId.length - 1) == '1')
						up.navtype = 211;
					up.id = "zpTime" + cal.id + partId + "UpButtonStatus";
					Zapatec.Utils.createProperty(up, "calendar", cal);
					up.timePart = part;
					if (Zapatec.is_khtml)
						up.innerHTML = "&nbsp;";
					Zapatec.Calendar._add_evs(up);

					var down = Zapatec.Utils.createElement("td", tr2);
					down.className = "down";
					down.navtype = 202;
					if (cal.config.timeRange && partId.substr(partId.length - 1) == '1')
						down.navtype = 212;
					down.id = "zpTime" + cal.id + partId + "DownButtonStatus";
					Zapatec.Utils.createProperty(down, "calendar", cal);
					down.timePart = part;
					if (Zapatec.is_khtml)
						down.innerHTML = "&nbsp;";
					Zapatec.Calendar._add_evs(down);
				}
				Zapatec.Calendar._add_evs(part);
				return part;
			}
			;


			var hrs = cal.currentDate.getHours();
			var mins = cal.currentDate.getMinutes();
			if (cal.config.showsTime == "seconds") {
				var secs = cal.currentDate.getSeconds();
			}
			var t12 = !cal.time24;
			var pm = (hrs > 12);
			if (t12 && pm) hrs -= 12;
			var H = makeTimePart("hour", "Hours", hrs, t12 ? 1 : 0, t12 ? 12 : 23);
			//calculating of the step for hours
			H._step = (cal.config.timeInterval > 30) ? (cal.config.timeInterval / 60) : 1;
			cell = Zapatec.Utils.createElement("td", row);
			cell.innerHTML = ":";
			cell.className = "colon";
			var M = makeTimePart("minute", "Minutes", mins, 0, 59);
			//calculating of the step for minutes
			M._step = ((cal.config.timeInterval) && (cal.config.timeInterval < 60)) ? (cal.config.timeInterval) : 5; // FIXME: make this part configurable
			if (cal.config.showsTime == "seconds") {
				cell = Zapatec.Utils.createElement("td", row);
				cell.innerHTML = ":";
				cell.className = "colon";
				var S = makeTimePart("minute", "Seconds", secs, 0, 59);
				S._step = 5;
			}
			var AP = null;
			if (t12) {
				AP = makeTimePart("ampm", "AMPM", pm ? Zapatec.Calendar.i18n("pm", "ampm", cal) : Zapatec.Calendar.i18n("am", "ampm", cal), [Zapatec.Calendar.i18n("am", "ampm", cal), Zapatec.Calendar.i18n("pm", "ampm", cal)]);
				AP.className += " button";
				//if (cal.config.timeRange) AP.style.borderBottom = "none";
			} else {
				AP = Zapatec.Utils.createElement("td", row).innerHTML = "&nbsp;";
			}

			if (cal.config.timeRange) {

				row = Zapatec.Utils.createElement("tr", tfoot);
				row.className = "time";

				hrs = cal.currentDateEnd.getHours();
				mins = cal.currentDateEnd.getMinutes();
				if (cal.showsTime == "seconds") {
					secs = cal.currentDateEnd.getSeconds();
				}
				t12 = !cal.time24;
				pm = (hrs > 12);
				if (t12 && pm) hrs -= 12;
				var H1 = makeTimePart("hour", "Hours1", hrs, t12 ? 1 : 0, t12 ? 12 : 23, cal.config.timeRange);
				//calculating of the step for hours
				H1._step = (cal.config.timeInterval > 30) ? (cal.config.timeInterval / 60) : 1;
				cell = Zapatec.Utils.createElement("td", row);
				cell.innerHTML = ":";
				cell.className = "colon";
				cell.style.border = "none";
				var M1 = makeTimePart("minute", "Minutes1", mins, 0, 59, cal.config.timeRange);
				//calculating of the step for minutes
				M1._step = ((cal.config.timeInterval) && (cal.config.timeInterval < 60)) ? (cal.config.timeInterval) : 5; // FIXME: make this part configurable
				if (cal.config.showsTime == "seconds") {
					cell = Zapatec.Utils.createElement("td", row);
					cell.innerHTML = ":";
					cell.className = "colon";
					cell.style.border = "none";
					var S1 = makeTimePart("minute", "Seconds1", secs, 0, 59, cal.config.timeRange);
					S1._step = 5;
				}
				var AP1 = null
				if (t12) {
					AP1 = makeTimePart("ampm", "AMPM1", pm ? Zapatec.Calendar.i18n("pm", "ampm", cal) : Zapatec.Calendar.i18n("am", "ampm", cal), [Zapatec.Calendar.i18n("am", "ampm", cal), Zapatec.Calendar.i18n("pm", "ampm", cal)], false, cal.config.timeRange);
					AP1.className += " button";
					//if (cal.config.timeRange) AP1.style.borderTop = "none";
				} else {
					AP1 = Zapatec.Utils.createElement("td", row).innerHTML = "&nbsp;";
				}
			}

			cal.onSetTime = function(currentDate) {
				var dateStartH = dateStartM = null;
				var thisH = H;
				var thisM = M;
				var thisS = S;
				var thisAP = AP;
				if (!currentDate) {
					currentDate = this.currentDate;
				}
				else {
					dateStartH = this.currentDate.getHours();
					dateStartM = this.currentDate.getMinutes();
					thisH = H1;
					thisM = M1;
					thisS = S1;
					thisAP = AP1;
				}

				var hrs = currentDate.getHours();
				var mins = currentDate.getMinutes();
				if (this.config.showsTime == "seconds") {
					var secs = cal.currentDate.getSeconds();
				}
				if (this.config.timeInterval) {
					mins += this.config.timeInterval - ((mins - 1 + this.config.timeInterval) % this.config.timeInterval) - 1;
				}
				while (mins >= 60) {
					mins -= 60;
					++hrs;
				}
				if (this.config.timeInterval > 60) {
					var interval = this.config.timeInterval / 60;
					if (hrs % interval != 0) {
						hrs += interval - ((hrs - 1 + interval) % interval) - 1;
					}
					if (hrs >= 24) {
						hrs -= 24;
					}
				}
				//ALLOWED TIME CHECK
				// This part of code seeks for the first enabled time value for this date.
				// It is written for the cases when you change day, month or year and the time value is disabled for the new date.
				// So if you only allow 8:00 - 17:00 on Mondays and you change the date to a Monday but the time is 7:00 it will
				// automatically move forward to 8:00.

				var new_date = new Date(currentDate);
				if (this.getDateStatus && this.getDateStatus(currentDate, currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), hrs, mins)) {
					hours = hrs;
					minutes = mins;
					var thresholdDate;
					var now = new Date();
					do {
						if (this.config.timeInterval) {
							if (this.config.timeInterval < 60) {
								minutes += this.config.timeInterval;
								thresholdDate = new Date(now.getTime() + Date.MINUTE * this.config.timeInterval);
							} else {
								hrs += this.config.timeInterval / 60;
							}
						} else {
							minutes += 5;
							thresholdDate = new Date(now.getTime() + Date.MINUTE * 5);
						}
						if (dateStartH) {
							if (hours > dateStartH) hours = dateStartH;
							if (minutes > dateStartM) minutes = dateStartM + 1;
						}

						if (minutes >= 60) {
							minutes -= 60;
							hours += 1;
						}
						if (hours >= 24) {
							hours -= 24;
						}

						new_date.setMinutes(minutes);
						new_date.setHours(hours);
						if (thresholdDate.getDate() != now.getDate() || !this.getDateStatus(new_date, currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), hours, minutes)) {
							hrs = hours;
							mins = minutes;
						}
					} while ((hrs != hours) || (mins != minutes));
				}

				//END OF ALLOWED TIME CHECK
				if (dateStartH) {
					var tmpDate = new Date(new_date);
					tmpDate.setHours(hrs);
					tmpDate.setMinutes(mins);
					if (hrs < dateStartH) hrs = dateStartH;
					if (mins < dateStartM && tmpDate < this.currentDate) mins = dateStartM;
				}
				currentDate.setMinutes(mins);
				currentDate.setHours(hrs);
				var pm = (hrs >= 12);
				if (pm && t12 && hrs != 12) hrs -= 12;
				if (!pm && t12 && hrs == 0) hrs = 12;
				thisH.firstChild.data = (hrs < 10) ? ("0" + hrs) : hrs;
				thisM.firstChild.data = (mins < 10) ? ("0" + mins) : mins;
				if (this.config.showsTime == "seconds") {
					thisS.firstChild.data = (secs < 10) ? ("0" + secs) : secs;
				}
				if (t12)
					thisAP.firstChild.data = pm ? Zapatec.Calendar.i18n("pm", "ampm", this) : Zapatec.Calendar.i18n("am", "ampm", this);
			};

			cal.onUpdateTime = function(currentDate) {
				var date = dateStart = null;
				var thisH = H;
				var thisM = M;
				var thisS = S;
				var thisAP = AP;
				if (!currentDate)
					date = this.currentDate;
				else {
					date = currentDate;
					dateStart = this.currentDate;
					thisH = H1;
					thisM = M1;
					thisS = S1;
					thisAP = AP1;
				}
				var h = parseInt(thisH.firstChild.data, 10);
				if (t12) {
					if (/pm/i.test(thisAP.firstChild.data) && h < 12)
						h += 12;
					else if (/am/i.test(thisAP.firstChild.data) && h == 12)
						h = 0;
				}
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
				date.setHours(h);
				if (dateStart) {
					if (date.setMinutes(parseInt(thisM.firstChild.data, 10)) < dateStart)
						date.setMinutes(dateStart.getMinutes());
				}
				else
					date.setMinutes(parseInt(thisM.firstChild.data, 10));
				if (this.config.showsTime == "seconds") {
					date.setSeconds(parseInt(thisS.firstChild.data, 10));
				}
				Zapatec.Date.setFullYear(date, y);
				date.setMonth(m);
				date.setDate(d);
				this.dateClicked = false;
				this.callHandler();
				if (!currentDate)
					this.onSetTime(this.currentDateEnd);
			};
		})();

		//empty area after the time controls
		if (this.config.monthsInRow != 1) {
			if (this.config.timeRange) row = firstrow;
			cell = Zapatec.Utils.createElement("td", row);
			cell.colSpan = ((this.config.weekNumbers) ? 8 : 7) * (this.config.monthsInRow - 1) - Math.ceil(emptyColspan);
			if (this.config.timeRange) cell.rowSpan = 2;
			cell.className = "timetext";
			cell.innerHTML = "&nbsp";
		}
	} else {
		this.onSetTime = this.onUpdateTime = function() {
		};
	}

	// Status bar
	if (!this.config.noStatus) {
		row = Zapatec.Utils.createElement("tr", tfoot);
		row.className = "footrow";

		cell = hh(Zapatec.Calendar.i18n("SEL_DATE", null, this), this.config.weekNumbers ? (8 * this.config.numberMonths) : (7 * this.config.numberMonths), 300);
		cell.className = "ttip";
		cell.id = "zpCal" + this.id + "Status";
		if (this.isPopup && !this.config.disableDrag) {
			cell.ttip = Zapatec.Calendar.i18n("DRAG_TO_MOVE", null, this);
			cell.style.cursor = "move";
		}
		this.tooltips = cell;
	}

	div = this.monthsCombo = Zapatec.Utils.createElement("div", this.element);
	div.className = "combo";
	div.id = "zpCal" + this.id + "MonthDropdownCombo";
	for (i = 0; i < 12; ++i) {
		var mn = Zapatec.Utils.createElement("div");
		mn.className = Zapatec.is_ie ? "label-IEfix" : "label";
		mn.id = "zpCal" + this.id + "MonthDropdownItem" + i;
		mn.month = i;
		mn.appendChild(window.document.createTextNode(Zapatec.Calendar.i18n(i, "smn", this)));
		div.appendChild(mn);
	}

	div = this.yearsCombo = Zapatec.Utils.createElement("div", this.element);
	div.className = "combo";
	div.id = "zpCal" + this.id + "YearDropdownCombo";
	for (i = 0; i < 12; ++i) {
		var yr = Zapatec.Utils.createElement("div");
		yr.className = Zapatec.is_ie ? "label-IEfix" : "label";
		yr.id = "zpCal" + this.id + "YearDropdownItem" + i;
		yr.appendChild(window.document.createTextNode("&nbsp;"));
		div.appendChild(yr);
	}

	div = Zapatec.Utils.createElement("div", this.element);
	div.id = "zpCal" + cal.id + "HistoryDropdownCombo";
	div.className = "combo history";
	this.histCombo = div;

	// Set this.element to container = first div = upper div
	this.element = this.container;

	this._init(this.config.firstDay, this.config.date);

	parent.appendChild(this.element);
	this.isCreate = true;

	if (typeof this.config.onCreate == 'function')
		this.config.onCreate(this);
};

/**
 * This function handles keypress events that occur while a popup calendar is
 * displayed.  The implementation is quite complicated; this function calls
 * cellClick in order to set the new date as if it was clicked.
 *
 * @param ev [Event] the event object
 * @return false
 */
Zapatec.Calendar._keyEvent = function(ev) {
	var cal = Zapatec.Calendar.activeCalendar;

	if (!cal) {
		return false;
	}

	if (Zapatec.is_ie) {
		ev = window.event;
	}

	var act = (Zapatec.is_ie || ev.type == "keypress");
	var K = ev.keyCode;
	var date = new Date(cal.currentDate);
	if (ev.ctrlKey) {
		switch (K) {
			case 37: // KEY left
				act && Zapatec.Calendar.cellClick(cal._nav_pm);
				break;
			case 38: // KEY up
				act && Zapatec.Calendar.cellClick(cal._nav_py);
				break;
			case 39: // KEY right
				act && Zapatec.Calendar.cellClick(cal._nav_nm);
				break;
			case 40: // KEY down
				act && Zapatec.Calendar.cellClick(cal._nav_ny);
				break;
			default:
				return false;
		}
	} else switch (K) {
		case 32: // KEY space (now)
			Zapatec.Calendar.cellClick(cal._nav_now);
			break;
		case 27: // KEY esc
			act && cal.callCloseHandler();
			break;
		//Fix for the key navigation
		case 37: // KEY left
			if (act && !cal.multiple) {
				date.setTime(date.getTime() - 86400000);
				cal.setDate(date);
			}
			break;
		case 38: // KEY up
			if (act && !cal.multiple) {
				date.setTime(date.getTime() - 7 * 86400000);
				cal.setDate(date);
			}
			break;
		case 39: // KEY right
			if (act && !cal.multiple) {
				date.setTime(date.getTime() + 86400000);
				cal.setDate(date);
			}
			break;
		case 40: // KEY down
			if (act && !cal.multiple) {
				date.setTime(date.getTime() + 7 * 86400000);
				cal.setDate(date);
			}
			break;
		case 13: // KEY enter
			if (act) {
				//FIX for Enter key!
				Zapatec.Calendar.cellClick(cal.currentDateEl);
			}
			break;
		default:
		// Close the calendar.
			Zapatec.Calendar._checkCalendar;
			return false;
	}
	return Zapatec.Utils.stopEvent(ev);
};

/**
 * (RE)Initializes the calendar to the given date and firstDay.
 *
 * This function perform the action of actually displaying the day names and
 * dates in the calendar.  But first, it checks if the passed date fits in the
 * allowed range, configured by the "minYear", "maxYear", "minMonth" and
 * "maxMonth" properties of the Calendar object.
 *
 * It takes care to highlight special days (calling the
 * calendar.getDateStatus() function which can be overridden by external
 * scripts) or to highlight any dates that might be selected (for instance when
 * multiple dates is on, this function will call _initMultipleDates() to
 * highlight selected dates accordingly).
 *
 * This function is highly optimized for speed, therefore the code in it is not
 * trivial and what it does might not seem obvious. :-) So, WARNING, this is
 * voodoo.  If you want to properly understand the code you should analyze it
 * line by line and try to execute it step by step; use the Venkman JS
 * debugger.
 *
 * @param firstDay [int] the first day of week, 0 for Sunday, 1 for Monday, etc.
 * @param date [Date] the date to initialize the calendar to
 *
 */
Zapatec.Calendar.prototype._init = function (firstDay, date, last) {
	var today = new Date();
	var TD = today.getDate();
	var TY = today.getFullYear();
	var TM = today.getMonth();
	var status, toolTip, k, tmpDate;
	//this.table.style.visibility = "hidden";

	if (this.getDateStatus && !last) {
		status = this.getDateStatus(date, date.getFullYear(), date.getMonth(), date.getDate());
		var backupDate = new Date(date);
		while (((status == true) || (status == "disabled")) && (backupDate.getMonth() == date.getMonth())) {
			date.setTime(date.getTime() + 86400000);
			status = this.getDateStatus(date, date.getFullYear(), date.getMonth(), date.getDate());
		}
		if (backupDate.getMonth() != date.getMonth()) {
			date = new Date(backupDate);
			while (((status == true) || (status == "disabled")) && (backupDate.getMonth() == date.getMonth())) {
				date.setTime(date.getTime() - 86400000);
				status = this.getDateStatus(date, date.getFullYear(), date.getMonth(), date.getDate());
			}
		}
		if (backupDate.getMonth() != date.getMonth()) {
			last = true;
			date = new Date(backupDate);
		}
	}
	var year = date.getFullYear();
	var month = date.getMonth();
	var rowsOfMonths = Math.floor(this.config.numberMonths / this.config.monthsInRow);
	var minMonth;
	var diffMonth, last_row, before_control;
	if (!this.config.vertical) {
		diffMonth = (this.config.controlMonth - 1);
		minMonth = month - diffMonth;
	} else {
		last_row = ((this.config.numberMonths - 1) % this.config.monthsInRow) + 1;
		before_control = (this.config.controlMonth - 1) % this.config.monthsInRow;
		bottom = (before_control >= (last_row) ? (last_row) : (before_control));
		diffMonth = (before_control) * (rowsOfMonths - 1) + Math.floor((this.config.controlMonth - 1) / this.config.monthsInRow) + bottom;
		minMonth = month - diffMonth;
	}
	var minYear = year;
	if (minMonth < 0) {
		minMonth += 12;
		--minYear;
	}
	var maxMonth = minMonth + this.config.numberMonths - 1;
	var maxYear = minYear;
	if (maxMonth > 11) {
		maxMonth -= 12;
		++maxYear;
	}
	function disableControl(ctrl) {
		Zapatec.Calendar._del_evs(ctrl);
		ctrl.disabled = true;
		ctrl.className = "button";
		ctrl.innerHTML = "<div>&nbsp</div>";
	}
	function enableControl(ctrl, sign) {
		Zapatec.Calendar._add_evs(ctrl);
		ctrl.disabled = false;
		ctrl.className = "button nav";
		ctrl.innerHTML = sign;
	}

	if ((minYear <= this.minYear) || this.config.disableYearNav) {
		if (!this._nav_py.disabled) {
			disableControl(this._nav_py);
		}
	} else {
		if (this._nav_py.disabled) {
			enableControl(this._nav_py, "&#x00ab;");
		}
	}

	if (maxYear >= this.maxYear || this.config.disableYearNav) {
		if (!this._nav_ny.disabled) {
			disableControl(this._nav_ny);
		}
	} else {
		if (this._nav_ny.disabled) {
			enableControl(this._nav_ny, "&#x00bb;");
		}
	}

	if (((minYear == this.minYear) && (minMonth <= this.minMonth)) || (minYear < this.minYear)) {
		if (!this._nav_pm.disabled) {
			disableControl(this._nav_pm);
		}
	} else {
		if (this._nav_pm.disabled) {
			enableControl(this._nav_pm, "&#x2039;");
		}
	}
	if (((maxYear == this.maxYear) && (maxMonth >= this.maxMonth)) || (maxYear > this.maxYear)) {
		if (!this._nav_nm.disabled) {
			disableControl(this._nav_nm);
		}
	} else {
		if (this._nav_nm.disabled) {
			enableControl(this._nav_nm, "&#x203a;");
		}
	}

	//FIX for range checking : spreading of the range on 1 month on the both sides;
	upperMonth = this.maxMonth + 1;
	upperYear = this.maxYear;
	if (upperMonth > 11) {
		upperMonth -= 12;
		++upperYear;
	}
	bottomMonth = this.minMonth - 1;
	bottomYear = this.minYear;
	if (bottomMonth < 0) {
		bottomMonth += 12;
		--bottomYear;
	}
	maxDate1 = new Date(maxYear, maxMonth, Zapatec.Date.getMonthDays(date, maxMonth), 23, 59, 59, 999);
	maxDate2 = new Date(upperYear, upperMonth, 1, 0, 0, 0, 0);
	minDate1 = new Date(minYear, minMonth, 1, 0, 0, 0, 0);
	minDate2 = new Date(bottomYear, bottomMonth, Zapatec.Date.getMonthDays(date, bottomMonth), 23, 59, 59, 999);
	var today = new Date();

	if (maxDate1.getTime() > maxDate2.getTime()) {
		if (today < maxDate2.getTime())
			date.setTime(today.getTime());
		else
			date.setTime(date.getTime() - (maxDate1.getTime() - maxDate2.getTime()) - 4);
	}
	if (minDate1.getTime() < minDate2.getTime()) {
		if (today > minDate2.getTime())
			date.setTime(today.getTime());
		else
			date.setTime(date.getTime() + (minDate2.getTime() - minDate1.getTime()) + 4);
	}
	delete maxDate1;
	delete maxDate2;
	delete minDate1;
	delete minDate2;
	this.config.firstDay = firstDay;
	if (!last) {
		this.currentDate = date;
		if (this.config.timeRange && !this.currentDateEnd) this.currentDateEnd = new Date(date);
	}
	this.config.date = date;
	Zapatec.Date.setDateOnly((this.config.date = new Date(this.config.date)), date);
	year = this.config.date.getFullYear();
	month = this.config.date.getMonth();
	var initMonth = date.getMonth();
	var mday = this.config.date.getDate();
	var no_days = Zapatec.Date.getMonthDays(date);

	// Get first displayed date
	var months = new Array();
	var validMonths = new Array();
	if (this.config.numberMonths % this.config.monthsInRow > 0) {
		++rowsOfMonths;
	}
	//creating of the array of date objects for every month
	var validMonth, day1, hrs;
	for (var l = 1; l <= rowsOfMonths; ++l) {
		months[l] = new Array();
		validMonths[l] = new Array();
		for (k = 1; (k <= this.config.monthsInRow) && ((l - 1) * this.config.monthsInRow + k <= this.config.numberMonths); ++k) {
			tmpDate = new Date(date);
			if (this.config.vertical) {
				validMonth = date.getMonth() - diffMonth + ((k - 1) * (rowsOfMonths - 1) + (l - 1) + ((last_row < k) ? (last_row) : (k - 1)));
			} else {
				validMonth = date.getMonth() - diffMonth + (l - 1) * this.config.monthsInRow + k - 1;
			}
			if (validMonth < 0) {
				zapatecDate.setFullYear(tmpDate, tmpDate.getFullYear() - 1);
				validMonth = validMonth + 12;
			}
			if (validMonth > 11) {
				zapatecDate.setFullYear(tmpDate, tmpDate.getFullYear() + 1);
				validMonth = validMonth - 12;
			}
			validMonths[l][k] = validMonth;
			tmpDate.setDate(1);
			tmpDate.setMonth(validMonth);
			day1 = (tmpDate.getDay() - this.config.firstDay) % 7;
			if (day1 < 0) {
				day1 += 7;
			}
			hrs = tmpDate.getHours();
			tmpDate.setDate(-day1);
			tmpDate.setDate(tmpDate.getDate() + 1);
			if (hrs != tmpDate.getHours()) {
				tmpDate.setDate(1);
				tmpDate.setMonth(validMonth);
				tmpDate.setDate(-day1);
				tmpDate.setDate(tmpDate.getDate() + 1);
			}
			months[l][k] = tmpDate;
		}
	}
	// Range of displayed dates
	// Start date
	var oRange = this.calRange = {
		from: new Date(months[1][1])
	};
	//every iteration of the cycle fills one row of months with values;
	var MN = Zapatec.Calendar.i18n(month, "smn", this);
	var weekend = Zapatec.Calendar.i18n("WEEKEND", null, this);
	var dates = this.config.multiple ? (this.datesCells = {}) : null;
	var DATETXT = this.config.dateText;
	var row, i, k, cell, hasdays, iday, wday, dmonth, dyear, current_month;
	for (var l = 1; l <= rowsOfMonths; ++l) {
		row = this.tbody[l].firstChild;
		for (i = 7; --i > 0; row = row.nextSibling) {
			cell = row.firstChild;
			hasdays = false;
			//this fills one row of days for all the months in the row
			for (k = 1; (k <= this.config.monthsInRow) && ((l - 1) * this.config.monthsInRow + k <= this.config.numberMonths); ++k) {
				date = months[l][k];
				if (this.config.weekNumbers) {
					cell.className = "day wn";
					cell.innerHTML = zapatecDate.getWeekNumber(date);
					if (k > 1) {
						cell.className += " month-left-border";
					}
					cell = cell.nextSibling;
				}
				row.className = "daysrow";
				row.id = "zpCal" + this.id + "Daysrow" + (6 - i);
				if (this.config.hideNavPanel) {
					hasdays = false;
				}
				for (j = 7; cell && (iday = date.getDate()) && (j > 0); date.setDate(iday + 1),((date.getDate() == iday) ? (date.setHours(1) && date.setDate(iday + 1)) : (false)),cell = cell.nextSibling,--j) {
					wday = date.getDay();
					dmonth = date.getMonth();
					dyear = date.getFullYear();
					cell.className = "day";
					if ((!this.config.weekNumbers) && (j == 7) && (k != 1)) {
						cell.className += " month-left-border";
					}
					if ((j == 1) && (k != this.config.monthsInRow)) {
						cell.className += " month-right-border";
					}
					current_month = !(cell.otherMonth = !(dmonth == validMonths[l][k]));
					if (!current_month) {
						if (this.config.showOthers) {
							cell.className += " othermonth";
						} else {
							cell.className += " true";
							cell.innerHTML = "&nbsp;";
							continue;
						}
					} else {
						hasdays = true;
					}
					cell.innerHTML = DATETXT ? DATETXT(date, dyear, dmonth, iday) : iday;
					dates && (dates[zapatecDate.print.call(this, date, "%Y%m%d")] = cell);
					if (!cell.disabled) {
						cell.caldate = [dyear, dmonth, iday];
						cell.ttip = "_";
						if ((weekend != null) && (weekend.indexOf(wday.toString()) != -1)) {
							cell.className += cell.otherMonth ? " oweekend" : " weekend";
						}
						if (dyear == TY && dmonth == TM && iday == TD) {
							cell.className += " today";
							if (!current_month && this.config.showOthers) {
								cell.className += " othermonthtoday";
							}
							cell.ttip += Zapatec.Calendar.i18n("PART_TODAY", null, this);
						}
						if (
							!this.config.multiple && current_month &&
							iday == this.currentDate.getDate() && this.hiliteToday &&
							(dmonth == this.currentDate.getMonth()) &&
							(dyear == this.currentDate.getFullYear())
							) {
							cell.className += " selected";
							row.className += " rowhilite";
							this.lastRowHilite = row;
							this.currentDateEl = cell;
						}
					}
					if (this.getDateStatus) {
						status = this.getDateStatus(date, dyear, dmonth, iday);
						if (this.getDateToolTip) {
							toolTip = this.getDateToolTip(date, dyear, dmonth, iday);
							if (toolTip) {
								cell.title = toolTip;
							}
						}
						if (status == true) {
							cell.className += " disabled";
						} else {
							cell.className += " " + status;
						}
					}
				}
				if (!(hasdays || !this.config.hideNavPanel && this.config.showOthers)) {
					row.className = "emptyrow";
				}
			}
			if ((i == 1) && (l < rowsOfMonths)) {
				if (row.className == "emptyrow") {
					row = row.previousSibling;
				}
				cell = row.firstChild;
				while (cell != null) {
					cell.className += " month-bottom-border";
					cell = cell.nextSibling;
				}
			}
		}
	}
	// End date
	oRange.to = new Date(date.setDate(date.getDate() - 1));

	//filling of all titles for the months
	if (this.config.numberMonths == 1) {
		this.title.innerHTML = Zapatec.Calendar.i18n(month, "mn", this) + " " + year;
		if (this.config && this.config.titleHtml)
			if (typeof this.config.titleHtml == 'function')
				this.title.innerHTML = this.config.titleHtml(this.title.innerHTML, month, year)
			else
				this.title.innerHTML += this.config.titleHtml
	} else {

		if (this.config && this.config.titleHtml)
			if (typeof this.config.titleHtml == 'function')
				this.title.innerHTML = this.config.titleHtml(Zapatec.Calendar.i18n(month, "mn", this) + ", " + year, month, year)
			else
				this.title.innerHTML = this.config.titleHtml

		for (var l = 1; l <= rowsOfMonths; ++l) {
			for (k = 1; (k <= this.config.monthsInRow) && ((l - 1) * this.config.monthsInRow + k <= this.config.numberMonths); ++k) {
				if (this.config.vertical) {
					validMonth = month - diffMonth + ((k - 1) * (rowsOfMonths - 1) + (l - 1) + ((last_row < k) ? (last_row) : (k - 1)));
				} else {
					validMonth = month - diffMonth + (l - 1) * this.config.monthsInRow + k - 1;
				}
				validYear = year;
				if (validMonth < 0) {
					--validYear;
					validMonth = 12 + validMonth;
				}
				if (validMonth > 11) {
					++validYear;
					validMonth = validMonth - 12;
				}
				this.titles[l][k].onclick = new Function(
					'zapatecWidgetCallMethod(' + this.id +
					',"fireEvent","calMonthClicked",{fullYear:"' + validYear +
					'",month:"' + validMonths[l][k] + '"})'
					);
				this.titles[l][k].innerHTML = Zapatec.Calendar.i18n(validMonths[l][k], "mn", this) + " " + validYear;
			}
		}
	}

	this.onSetTime();
	if (this.config.timeRange)
		this.onSetTime(this.currentDateEnd);
	//this.table.style.visibility = "visible";
	this._initMultipleDates();
	this.updateWCH();
	// PROFILE
	// this.showHint("Generated in " + ((new Date()) - today) + " ms");
};

/**
 * Returns range of displayed dates.
 *
 * <pre>
 * Returns object:
 * {
 *   from: [object] first displayed Date,
 *   to: [object] last displayed Date
 * }
 * </pre>
 *
 * @return Range of dates
 * @type object
 */
Zapatec.Calendar.prototype.getRange = function() {
	// Range is formed in _init
	return this.calRange;
};

/**
 * Find a range date for date in multiple array
 * @private
 * @param {Object} date
 */
Zapatec.Calendar.prototype._findDateFormMultiple = function (date, multipleRange) {
	var d = null;
	for (var i in multipleRange) {
		d = multipleRange[i];
		if (date.substr(0, 8) == zapatecDate.print.call(this, d, "%Y%m%d")) {
			this.config.multipleRange[date] = multipleRange[i];
			return this.config.multipleRange[date];
		}
	}

	// If pair was not found set end date to start date
	this.config.multipleRange[date] = date;
	return;
}

/**
 * If "multiple dates" is selected (the calendar.multiple property) this
 * function will highlight cells that display dates that are selected.  It is
 * only called from the _init() function.
 */
Zapatec.Calendar.prototype._initMultipleDates = function() {
	if (this.config.multiple) {
		var d = null;
		var dateEnd = null;
		for (var i in this.config.multiple) {
			d = this.config.multiple[i];
			if (this.config.timeRange) dateEnd = this.config.multiple[i];
			var cell = this.datesCells[zapatecDate.print.call(this, d, "%Y%m%d")];
			if (!this.config.multiple[zapatecDate.print.call(this, d, "%Y%m%d")]) {
				this.config.multiple[zapatecDate.print.call(this, d, "%Y%m%d")] = d;
				delete(this.config.multiple[i]);
			}
			if (!d)
				continue;
			if (cell) {
				Zapatec.Utils.addClass(cell, "selected");
			}
		}
		if (d != null && this.config.showsTime) {
			this.currentDate = new Date(d);
			this.onSetTime();
			if (this.config.timeRange) {
				this.currentDateEnd = new Date(dateEnd);
				this.onSetTime(this.currentDateEnd);
			}
		}
	}
};

/**
 * Given a Date object, this function will "toggle" it in the calendar; that
 * is, it will select it if not already selected, or unselect it if was already
 * selected.  The array of dates is updated accordingly and the cell object
 * will be added or removed the appropriate class name ("selected").  Of
 * course, this only takes place if "multiple dates" is selected.
 *
 * _toggleMultipleDate - for old versions
 *
 * @param date [Date] the date to (un)select.
 * @param date1 [Date] the multiple pair to date for (un)selection.
 */
Zapatec.Calendar.prototype._toggleMultipleDate = Zapatec.Calendar.prototype.toggleMultipleDate = function(date, date1) {
	if (this.config.multiple) {
		var ds = zapatecDate.print.call(this, date, "%Y%m%d");
		var cell = this.datesCells[zapatecDate.print.call(this, date, "%Y%m%d")];
		if (cell) {
			var d = this.config.multiple[ds];
			if (!d) {
				Zapatec.Utils.addClass(cell, "selected");
				this.config.multiple[ds] = date;
				if (this.config.timeRange) {
					this.config.multipleRange[ds] = (date1 ? date1 : date);
				}
			} else {
				Zapatec.Utils.removeClass(cell, "selected");
				delete this.config.multiple[ds];
				if (this.config.timeRange) delete this.config.multipleRange[ds];
			}
		}
	}
};

/**
 * This method affects control month. It changes the range of displayed
 * dates so the control month contains the date passed as an argument.
 * For example if we have 3 month Calendar with second month as a control
 * and we call cal.navigateTo(new Date(2007, 10, 11)), the Calendar will show
 * October-November-December (10 is November as numeration starts with zero).
 *
 * @public
 *
 * @param date [Date] the date to set.
 */
Zapatec.Calendar.prototype.navigateTo = function (date) {
	if (this.setDate(date, false) && Zapatec.Calendar.cellClick(this.currentDateEl))
		return true;
	return false;
}

/**
 * This method returns the date representing the year and month shown in control month.
 * The rest part of the Date object is 1st day and zeros.
 *
 * @public
 */
Zapatec.Calendar.prototype.getNavigationPos = function () {
	if (!this.currentDate)
		return null;
	return this.currentDate;
}

/**
 * Moves the Calendar view one month forward.
 *
 * @public
 */
Zapatec.Calendar.prototype.nextMonth = function () {
	if (this._nav_nm && Zapatec.Calendar.cellClick(this._nav_nm))
		return true;

	return false;
}

/**
 * Moves the Calendar view one month backward.
 *
 * @public
 */
Zapatec.Calendar.prototype.prevMonth = function () {
	if (this._nav_pm && Zapatec.Calendar.cellClick(this._nav_pm))
		return true;

	return false;
}

/**
 * Moves the Calendar view one year forward.
 *
 * @public
 */
Zapatec.Calendar.prototype.nextYear = function () {
	if (this._nav_ny && Zapatec.Calendar.cellClick(this._nav_ny))
		return true;

	return false;
}

/**
 * Moves the Calendar view one year backward.
 *
 * @public
 */
Zapatec.Calendar.prototype.prevYear = function () {
	if (this._nav_py && Zapatec.Calendar.cellClick(this._nav_py))
		return true;

	return false;
}

/**
 * Call this in order to install a function handler that returns a tooltip for
 * the given date.  For example:
 *
 * \code
 *	function myHandler(date) {
 *		var str = Zapatec.Date.print(date, "%Y/%m/%d");
 *		if (str == "1979/08/03") {
 *			return "Happy birthday Mishoo! :D";
 *		}
 *		return str;
 *	}
 *	calendar.setDateToolTipHandler(myHandler);
 * \endcode
 *
 * The tooltip handler is a "unary" function (receives one argument).  The
 * argument passed is a date object and the function should return the tooltip
 * for that date.
 *
 * @param unaryFunction [function] your tooltip handler, as described above
 */
Zapatec.Calendar.prototype.setDateToolTipHandler = function (unaryFunction) {
	this.getDateToolTip = unaryFunction;
};

/**
 * Moves the calendar to the specified date.  If \em date is not passed, then
 * the "today" date is assumed.  This function does range checking and displays
 * an error in the status bar if the new date is not allowed by the configured
 * calendar range.  Otherwise, it simply calls _init() with the new date.
 *
 * @param date [Date, optional] the date object.
 *
 */
Zapatec.Calendar.prototype.setDate = function (date, justInit) {
	// workaround for some bugs in our parseDate code
	if (!date)
		date = new Date();
	if (!Zapatec.Date.equalsTo(date, this.config.date)) {
		var year = date.getFullYear(), m = date.getMonth();
		if (year < this.minYear || (year == this.minYear && m < this.minMonth))
			this.showHint("<div class='error'>" + Zapatec.Calendar.i18n("E_RANGE", null, this) + " \>\>\></div>");
		else if (year > this.maxYear || (year == this.maxYear && m > this.maxMonth))
			this.showHint("<div class='error'>\<\<\< " + Zapatec.Calendar.i18n("E_RANGE", null, this) + "</div>");
		else {
			this._init(this.config.firstDay, date, justInit);
			return true;
		}

		return false;
	}

	return true;
};

/**
 * Displays a hint in the status bar
 *
 * @param text [string] what to display
 */
Zapatec.Calendar.prototype.showHint = function(text) {
	if (!this.config.noStatus)
		this.tooltips.innerHTML = text;
};

/**
 * Refreshes the calendar.  Useful if the "disabledHandler" function is
 * dynamic, meaning that the list of disabled date can change at runtime.  Just
 * call this function if you think that the list of disabled dates should
 * change.
 *
 * This function simply calls _init() using the current firstDay and the
 * current calendar date.
 */
Zapatec.Calendar.prototype.reinit = function() {
	this._init(this.config.firstDay, this.config.date);
};

/**
 * "refresh()" isn't a good name for it: this function _destroys_ the calendar
 * object and creates another one with the same parameters.  This comes in
 * handy for the calendar wizard where we need to reconstruct the calendar for
 * virtually any property change.
 */
Zapatec.Calendar.prototype.refresh = function() {
	var p = this.isPopup ? null : this.element.parentNode;
	var x = parseInt(this.element.style.left);
	var y = parseInt(this.element.style.top);
	this.destroy();
	this.isCreate = false;
	this.init(this.config);
	if (this.isPopup) {
		this.showAt(x, y);
	}
};

/**
 * Configures the "firstDay" parameter of the calendar.
 *
 * @param firstDay [int] the new first day of week, 0 for Sunday, 1 for Monday, etc.
 */
Zapatec.Calendar.prototype.setFirstDayOfWeek = function (firstDay) {
	if (this.config.firstDay != firstDay) {
		this._init(firstDay, this.config.date);
		//displaying the day names for all the rows of the months
		var rowsOfMonths = Math.floor(this.config.numberMonths / this.config.monthsInRow);
		if (this.config.numberMonths % this.config.monthsInRow > 0) {
			++rowsOfMonths;
		}
		for (var l = 1; l <= rowsOfMonths; ++l) {
			this.firstDayName = this.rowsOfDayNames[l];
			this._displayWeekdays();
		}
	}
};

/**
 * These functions allow one to install a handler that gets called for each
 * date when a month is displayed in the calendar.  Based on this handler's
 * return value, that date can be disabled or highlighted using a class name
 * returned by the handler.
 *
 * The handler has the following prototype:
 *
 * \code
 *	function dateStatus(date, year, month, day);
 * \endcode
 *
 * While all 4 parameters are passed, the handler can for instance use only the
 * first one.  The year, month and day can all be determined from the first
 * parameter which is a Date object, but because many people will explicitely
 * need the year, month or day, we pass them too to speed things up (since we
 * already know them at the time the handler is called).
 *
 * Here is an example of a not-so-complex handler:
 *
 * \code
 *	function my_DateStatus(date, year, month, day) {
 *		var str = Zapatec.Date.print(date, "%Y/%m/%d");
 *		if (str >= '2000/01/01' && str <= '2000/12/31') {
 *			return true; // disable all dates in 2000
 *		}
 *		if (str == "1979/08/03") {
 *			return "birthday";
 *		}
 *		return false;
 *	}
 *	calendar.setDateStatusHandler(my_DateStatus);
 * \endcode
 *
 * The above handler will disable all dates in 2000 (returns true) and
 * highlight "1979/08/03" using the class "birthday".  From this example we can
 * notice that the handler can return a boolean value or a string value.  The
 * "boolean" return type is supported for backwards compatibility (function
 * setDisabledHandler, which is deprecated by setDateStatusHandler).  Here's
 * what the return value means:
 *
 * - \b true: the date will be disabled.
 * - \b false: no action taken (date stays enabled).
 * - "disabled": the date will be disabled.
 * - "other_string": the "other_string" will be added to the cell's class name.
 * - "disabled other_string": the date will be disabled and "disabled other_string"
 *	will be added to cell's class name; this helps one make a date disabled while
 *	still highlighting it in a special way.
 *
 * Note that user defined class names should have an associated CSS part
 * somewhere in the document that specifies how the days will look like;
 * otherwise, no difference will be visible.  For instance, for highlighting
 * "birthday" dates, one should also add:
 *
 * \code
 *	.birthday { color: #f00; }
 * \endcode
 *
 * somewhere in the CSS of the calling document.  (the above will make them
 * red).
 *
 * Disabled dates are not clickable; however, if one overrides the "disable"
 * CSS class, or if the cell also gets an "other_string" class that contains
 * settings that override the "disabled" class, those cells might not look
 * "disabled" but still behave so.
 *
 * \b WARNING: this function gets called 28 to 31 times each time a month is
 * displayed.  This means that if you are doing crazy computations in order to
 * determine the status of a day, things \em will slow down dramatically.  You
 * have been warned.
 *
 * @param unaryFunction [function] handler that decides the status of the passed date
 */
Zapatec.Calendar.prototype.setDateStatusHandler = Zapatec.Calendar.prototype.setDisabledHandler = function (unaryFunction) {
	this.getDateStatus = unaryFunction;
};

/**
 * Configures a range of allowed dates for the calendar.  Currently, this
 * function supports setting a range on a "month granularity".  This means,
 * using it you can't disable part of a month.  Both parameters are numeric and
 * can be float.  The range is "inclusive".
 *
 * This function might seem somehow complicated, but it's designed in a way
 * that keeps backwards compatibility with the calendar v0.9.6.
 *
 * -# when the end points are integers, the full years will be included.  That
 *	 is, if you call calendar.setRange(1999, 2005) then only dates between and
 *	 including 1999/01/01 and 2005/12/31 will be allowed.
 * -# when the end points are floats, the decimal part specifies the month.
 *	 Therefore, calendar.setRange(1999.03, 2005.05) will allow dates between
 *	 and including 1999/03/01 (March 1) and 2005/05/31 (May 31).
 *
 * The above statements mean that the following two lines are equivalent:
 *
 * \code
 *	calendar.setDate(1999, 2005);		 // or
 *	calendar.setDate(1999.01, 2005.12);
 * \endcode
 *
 * @param A [number] the range start point
 * @param Z [number] the range end point
 */
Zapatec.Calendar.prototype.setRange = function (A, Z) {
	var m,
		a = Math.min(A, Z),
		z = Math.max(A, Z);
	this.minYear = m = Math.floor(a);
	this.minMonth = (m == a) ? 0 : Math.ceil((a - m) * 100 - 1);
	this.maxYear = Math.floor(z);
	this.maxMonth = (this.maxYear == z) ? 11 : Math.ceil(Math.round((z - this.maxYear) * 100) - 1);
};

/**
 * This function sets up the cal.multiple property initially when the flat or popup calendar is created.
 * If there are dates to be displayed or added to the first time, this property will be filled with those
 * dates at the beginning.
 *
 * multiple -- [Array] - stores the current dates for future use and appending of additional dates
 */
Zapatec.Calendar.prototype.setMultipleDates = function(multiple) {
	if (!multiple || typeof multiple == "undefined") return;

	this.config.multiple = [];
	if (this.config.timeRange) {
		var multipleRange = this.config.multipleRange;
		this.config.multipleRange = [];
	}
	Zapatec.Calendar.activeCalendar = this;
	var ds = null;
	for (var i = multiple.length; --i >= 0;) {
		var d = multiple[i];
		ds = zapatecDate.print.call(this, d, "%Y%m%d");
		this.config.multiple[ds] = d;
		if (this.config.timeRange) this._findDateFormMultiple(ds, multipleRange);
	}
};

/**
 * Selects the passed date. If date is already selected method just returns true.
 * Passing a range is done using array with two elements, but range should go inside the array.
 * In this case if at least one date is handled correctly method returns true.
 * So for example the following code is legal:
 *  cal.selectDate(date); //select one date
 *  cal.selectDate([date1, date2]); //select array of dates
 *  cal.selectDate([[rangeStartDate, rangeEndDate]]); //select date range
 *  cal.selectDate([[rangeStartDate1, rangeEndDate1], [rangeStartDate2, rangeEndDate2]]); //selct two date ranges
 *
 * @param {Object} dates - date ranges
 */
Zapatec.Calendar.prototype.selectDate = function (dates) {
	var cal = this;
	function setDateRange(dateRange) {
		var count = 0;
		for (var i in dateRange)
			count++;
		if (count == 0) {
			dateRange[0] = dateRange;
		}
		if (count != 2) {
			for (var i in dateRange)
				if (typeof dateRange[i] != 'array')
					cal.toggleMultipleDate(new Date(dateRange[i]))
				else
					return false;
			return true;
		}

		var maxDate = dateRange[0] < dateRange[1] ? dateRange[1] : dateRange[0];
		var minDate = dateRange[0] < dateRange[1] ? dateRange[0] : dateRange[1];
		for (var i = new Date(minDate); i <= maxDate; i.setDate(i.getDate() + 1))
			cal.toggleMultipleDate(new Date(i));
		return true;
	}

	var count = 0;
	for (var i in dates)
		count++;
	if (count == 0)
		dates[0] = dates;

	if (this.config.multiple)
		for (var i in dates) {
			if (!setDateRange(dates[i]))
				return false;
		}
	else {
		var tmpDate = dates[0];
		while (tmpDate[0])
			tmpDate = tmpDate[0];
		this.navigateTo(tmpDate);
	}
}

/**
 *
 * @param {Object} dates
 */
Zapatec.Calendar.deselectDate = function (dates) {
}


/**
 * Call the calendar's callback function, if defined.  The passed argument
 * is the date object. This is a public function meant to be invoked by the user so that s/he can
 * have more controls on what to do with the dates selected.
 */
Zapatec.Calendar.prototype.submitFlatDates = function()
{
	if (typeof this.config.flatCallback == "function") {
		//Specify the pre-set sorting so that Zapatec.Utils will sort the multiple dates accordingly.
		//Default to "asc" if it does not equal to "asc" or "desc".
		Zapatec.Calendar.sortOrder = (this.config.sortOrder != "asc" && this.config.sortOrder != "desc" && this.config.sortOrder != "none") ? "none" : this.config.sortOrder;

		if (this.config.multiple && (Zapatec.Calendar.sortOrder != "none")) {
			var dateArray = new Array();

			for (var i in this.config.multiple) {
				var currentDate = this.config.multiple[i];
				// sometimes the date is not actually selected, that's why we need to check.
				if (currentDate) {
					// and push it in the "dateArray", in case one triggers the calendar again.
					dateArray[dateArray.length] = currentDate;
				}
				//Now let's sort the dateArray array
				dateArray.sort(Zapatec.Calendar.compareDates);
			}

			this.config.multiple = {};
			for (var i = 0; i < dateArray.length; i++) {
				var d = dateArray[i];
				//var ds = zapatecDate.print.call(this, d, "%Y%m%d%H%M");
				var ds = zapatecDate.print.call(this, d, "%Y%m%d");
				this.config.multiple[ds] = d;
				if (this.config.timeRange) this._findDateFormMultiple(ds);
			}
		} //Else no need to sort the multiple dates.
		this.config.flatCallback(this);
	}
}

/**
 * Call the calendar's "onSelected" handler, if defined.  The passed arguments
 * are the date object and a string with the date formatted by the specifier in
 * calendar.dateFormat.
 */
Zapatec.Calendar.prototype.callHandler = function () {
	if (this.onSelected) {
		this.onSelected(this,
			zapatecDate.print.call(this, this.config.date, this.dateFormat));
	}
};

/**
 * This function updates the calendar history and saves the cookie.  The
 * history is a string containing date and time formatted as "%Y/%m/%d/%H/%M"
 * (that is, all time parts separated by slashes, in a "most significant to
 * least significant order").  Further, such formats are separated by commas,
 * and the current calendar date is added the first, then the cookie saved.
 */
Zapatec.Calendar.prototype.updateHistory = function () {
	var a, i, d, tmp, s, str = "", len = this.config.prefs.hsize - 1;
	if (this.config.prefs.history) {
		a = this.config.prefs.history.split(/,/);
		i = 0;
		while (i < len && (tmp = a[i++])) {
			s = tmp.split(/\//);
			d = new Date(parseInt(s[0], 10), parseInt(s[1], 10) - 1, parseInt(s[2], 10),
				parseInt(s[3], 10), parseInt(s[4], 10));
			if (!Zapatec.Date.dateEqualsTo(d, this.config.date))
				str += "," + tmp;
		}
	}
	this.config.prefs.history = zapatecDate.print.call(this, this.config.date, "%Y/%m/%d/%H/%M") + str;
	Zapatec.Calendar.savePrefs(this.id);
};

/**
 * Show "ABOUT" information
 */
Zapatec.Calendar.prototype.callHelpHandler = function () {
	var cal = this;
	var text = Zapatec.Calendar.i18n("ABOUT", null, cal);
	if (typeof text != "undefined") {
		text += cal.config.showsTime ? Zapatec.Calendar.i18n("ABOUT_TIME", null, cal) : "";
	} else {
		// FIXME: this should be removed as soon as lang files get updated!
		text = "Help and about box text is not translated into this language.\n" +
				 "If you know this language and you feel generous please update\n" +
				 "the corresponding file in \"lang\" subdir to match calendar-en.js\n" +
				 "and send it back to <support@zapatec.com> to get it into the distribution  ;-)\n\n" +
				 "Thank you!\n" +
				 "http://www.zapatec.com\n";
	}
	alert(text);
}

/**
 * Calls the calendar's onClose handler, if present.  Either way, this function
 * calls updateHistory() in order to update the history cookie.
 */
Zapatec.Calendar.prototype.callCloseHandler = function () {
	if (this.dateClicked && !this.config.noHistory) {
		this.updateHistory();
	}
	if (this.config.onClose) {
		this.config.onClose(this);
	}
	this.hideShowCovered();
};

/** Removes the calendar object from the DOM tree and destroys it. */
Zapatec.Calendar.prototype.destroy = function () {
	this.hide();	 // this also removes keyboard events :-\
	Zapatec.Utils.destroy(this.element);
	Zapatec.Utils.destroy(this.WCH);
	Zapatec.Calendar.activeCalendar = null;
};

/**
 * Moves the calendar element to a different section in the DOM tree (changes
 * its parent).  This might be useful for flat calendars.
 *
 * @param new_parent [HTMLElement] the new parent for the calendar.
 */
Zapatec.Calendar.prototype.reparent = function (new_parent) {
	var el = this.element;
	el.parentNode.removeChild(el);
	new_parent.appendChild(el);
};

/**
 * This gets called when the user presses a mouse button anywhere in the
 * document, if the calendar is shown.  If the click was outside the open
 * calendar this function closes it and stops the event from propagating.
 *
 * @param ev [Event] the event object.
 * @return false if the event is stopped.
 */
Zapatec.Calendar._checkCalendar = function(ev) {
	var cal = Zapatec.Calendar.activeCalendar;

	if (!cal) {
		return false;
	}

	// Opera call this justAfterCreation
	/*if (Zapatec.is_opera && cal.justCreate) {
	 cal.justCreate = false;
	 return;
	 }*/

	var el = Zapatec.is_ie ? Zapatec.Utils.getElement(ev) : Zapatec.Utils.getTargetElement(ev);
	for (; el != null && el != cal.element; el = el.parentNode) ;
	if (el == null) {
		// calls closeHandler which should hide the calendar.
		cal.callCloseHandler();
	}
};

/**
 * Updates the calendar "WCH" (windowed controls hider).  A WCH is an
 * "invention" (read: "miserable hack") that works around one of the most
 * common and old bug in Internet Explorer: the SELECT boxes or IFRAMES show on
 * top of any other HTML element.  This function makes sure that the WCH covers
 * correctly the calendar element and another element if passed.
 *
 * @param other_el [HTMLElement, optional] a second element that the WCH should cover.
 */
Zapatec.Calendar.prototype.updateWCH = function(other_el) {
	Zapatec.Utils.setupWCH_el(this.WCH, this.element, other_el);
};

/**
 * Displays a hidden calendar.  It walks quickly through the HTML elements and
 * makes sure that they don't have "hover" or "active" class names that might
 * be there from a previous time the same calendar was displayed (exept rowhilite ;)).
 * This function also calls updateWCH() and hideShowCovered() to workaround
 * miserable IE bugs.
 *
 * If the calendar is a popup calendar and doesn't have the "noGrab" property
 * set, this function also adds document event handlers to intercept key events
 * or to close the calendar when one clicks outside it.
 */
Zapatec.Calendar.prototype.show = function () {
	if (!this.table)
		this.create();
	var rows = this.table.getElementsByTagName("tr");
	for (var i = rows.length; i > 0;) {
		var row = rows[--i];
		if (/zpCalendar\d{1,3}RootTableTR\d{1,2}/.test(row.id)) {
			continue;
		}
		Zapatec.Utils.removeClass(row, "rowhilite");
		var cells = row.getElementsByTagName("td");
		for (var j = cells.length; j > 0;) {
			var cell = cells[--j];
			if (/zpCalendar\d{1,3}RootTableTR\d{1,2}TD\d{1,2}/.test(cell.id)) {
				continue;
			}
			Zapatec.Utils.removeClass(cell, "hilite");
			Zapatec.Utils.removeClass(cell, "active");
		}
	}

	// Show with effects

	if (this.element.style.display != "block") {
		this.element.style.visibility = "hidden";
		this.element.style.display = "block";
	}
	if (this.config.showEffect.length > 0) {
		this.showContainer(this.config.showEffect, this.config.showEffectSpeed, this.config.showEffectOnFinish);
	} else {
		// Enable trigger element
		if (this.triggerEl) {
			this.triggerEl.disabled = false;
		}
	}
	if (this.element.style.visibility == "hidden") {
		this.element.style.visibility = "";
	}

	this.hidden = false;

	if (this.isPopup) {
		this.updateWCH();
		Zapatec.Calendar.activeCalendar = this;
		if (!this.config.noGrab) {
			Zapatec.Utils.addEvent(window.document, "keydown", Zapatec.Calendar._keyEvent);
			Zapatec.Utils.addEvent(window.document, "keypress", Zapatec.Calendar._keyEvent);
			//this.justCreate = true;
			Zapatec.Utils.addEvent(window.document, "mousedown", Zapatec.Calendar._checkCalendar);
		}
	}

	this.hideShowCovered();
};

/**
 * Set activeCalendar = null after hide effect
 * @param {Object} calId - calendar id
 */
Zapatec.Calendar.prototype.onHide = function () {
	Zapatec.Calendar.activeCalendar = null;

	// Romove rowhilite class
	if (this.lastRowHilite) {
		Zapatec.Utils.removeClass(this.lastRowHilite, "rowhilite");
	}
	if (this.config.hideEffectOnFinish)
		this.config.hideEffectOnFinish

	// IE WCH hack
	if (Zapatec.Utils.__wch_id > 0)
		Zapatec.Utils.hideWCH(document.getElementById("WCH" + Zapatec.Utils.__wch_id));

	// Enable trigger element
	if (this.triggerEl) {
		this.triggerEl.disabled = false;
	}
}

/**
 * Hides the calendar.  Also removes any "hilite" from the class of any TD
 * element.  Unregisters the document event handlers for key presses and
 * mousedown.
 */
Zapatec.Calendar.prototype.hide = function () {
	if (this.isPopup) {
		Zapatec.Utils.removeEvent(window.document, "keydown", Zapatec.Calendar._keyEvent);
		Zapatec.Utils.removeEvent(window.document, "keypress", Zapatec.Calendar._keyEvent);
		Zapatec.Utils.removeEvent(window.document, "mousedown", Zapatec.Calendar._checkCalendar);
	}

	Zapatec.Utils.hideWCH(this.WCH);
	this.hidden = true;
	this.hideShowCovered();

	if (this.config.hideEffect.length > 0) {
		if (this.triggerEl) {
			this.triggerEl.disabled = true;
		}
		this.hideContainer(this.config.hideEffect, this.config.hideEffectSpeed, new Function("Zapatec.Widget.getWidgetById(" + this.id + ").onHide()"));
	}
	else if (this.element) {
		this.element.style.display = "none";
		// Romove rowhilite class
		if (this.lastRowHilite) {
			Zapatec.Utils.removeClass(this.lastRowHilite, "rowhilite");
		}
	}


};

/**
 * Shows the calendar at a given absolute position (beware that, depending on
 * the calendar element style -- position property -- this might be relative to
 * the parent's containing rectangle).
 *
 * @param x [int] the X position
 * @param y [int] the Y position
 */
Zapatec.Calendar.prototype.showAt = function (x, y) {
	if (this.element) {
		var s = this.element.style;
		s.left = x + "px";
		s.top = y + "px";
	}

	this.show();
};

/**
 * This function displays the calendar near a given "anchor" element, according
 * to some rules passed in \em opts.  The \em opts argument is a string
 * containing one or 2 letters.  The first letter decides the vertical
 * alignment, and the second letter decides the horizontal alignment relative
 * to the anchor element.  Following we will describe these options; in parens
 * we will use simple descriptions like "top to bottom" which means that the
 * top margin of the calendar is aligned with the bottom margin of the object.
 *
 * \b Vertical align:
 *
 * - T -- the calendar is completely above the element (bottom to top)
 * - t -- the calendar is above the element but might overlap it (bottom to bottom)
 * - C -- the calendar is vertically centered to the element
 * - b -- the calendar is below the element but might overlap it (top to top)
 * - B -- the calendar is completely below the element (top to bottom)
 *
 * \b Horizontal align (defaults to 'l' if no letter passed):
 *
 * - L -- the calendar is completely to the left of the element (right to left)
 * - l -- the calendar is to the left of the element but might overlap it (right to right)
 * - C -- the calendar is horizontally centered to the element
 * - r -- the calendar is to the right of the element but might overlap it (left to left)
 * - R -- the calendar is completely to the right of the element (left to right)
 *
 * @param el [HTMLElement] the anchor element
 * @param opts [string, optional] the align options, as described above.  Defaults to "Bl" if nothing passed.
 */
Zapatec.Calendar.prototype.showAtElement = function (el, opts) {
	var self = this;
	var p = Zapatec.Utils.getElementOffsetRelative(el);
	if (!opts || typeof opts != "string") {
		this.showAt(p.x, p.y + el.offsetHeight);
		return true;
	}
	self.element.style.visibility = "hidden";
	self.element.style.display = "block";
	var w = self.element.offsetWidth;
	var h = self.element.offsetHeight;
	self.element.style.display = "none";
	self.element.style.visibility = "";
	var valign = opts.substr(0, 1);
	var halign = "l";
	if (opts.length > 1) {
		halign = opts.substr(1, 1);
	}
	// vertical alignment
	switch (valign) {
		case "T": p.y -= h; break;
		case "B": p.y += el.offsetHeight; break;
		case "C": p.y += (el.offsetHeight - h) / 2; break;
		case "t": p.y += el.offsetHeight - h; break;
		case "b": break; // already there
	}
	// horizontal alignment
	switch (halign) {
		case "L": p.x -= w; break;
		case "R": p.x += el.offsetWidth; break;
		case "C": p.x += (el.offsetWidth - w) / 2; break;
		case "l": p.x += el.offsetWidth - w; break;
		case "r": break; // already there
	}
	p.width = w;
	p.height = h;
	self.monthsCombo.style.display = "none";
	self.showAt(p.x, p.y);
};

/**
 * Print date with timeRange paramiter
 * @param {Object} date
 * @param {Object} format
 */
Zapatec.Calendar.prototype.printWith2Time = function (date, date1, format) {
	// For 2 times print ours, minutes, seconds
	if (this.config.timeRange) {
		if (!date1) date1 = date;
		var s = {};
		var hr = date1.getHours();
		var pm = (hr >= 12);
		var ir = (pm) ? (hr - 12) : hr;
		var dy = Zapatec.Date.getDayOfYear(date1);
		if (ir == 0)
			ir = 12;
		var min = date1.getMinutes();
		var sec = date1.getSeconds();
		s["%H1"] = (hr < 10) ? ("0" + hr) : hr; // hour, range 00 to 23 (24h format)
		s["%I1"] = (ir < 10) ? ("0" + ir) : ir; // hour, range 01 to 12 (12h format)
		s["%k1"] = hr ? hr : "0"; // hour, range 0 to 23 (24h format)
		s["%l1"] = ir;		 // hour, range 1 to 12 (12h format)
		s["%M1"] = (min < 10) ? ("0" + min) : min; // minute, range 00 to 59
		s["%s1"] = Math.floor(date.getTime() / 1000);
		s["%S1"] = (sec < 10) ? ("0" + sec) : sec; // seconds, range 00 to 59
		var str = format;
		var re = /%.1/g;
		var a = str.match(re) || [];
		for (var i = 0; i < a.length; i++) {
			var tmp = s[a[i]];
			if (tmp) {
				re = new RegExp(a[i], 'g');
				str = str.replace(re, tmp);
			}
		}
		return zapatecDate.print.call(this, date, str);
	}
	else
		return zapatecDate.print.call(this, date, format);
}

/**
 * Customizes the date format that will be reported to the onSelect handler.
 * The format string is described in Zapatec.Date.print().
 *
 * @param str [string] the date format.
 */
Zapatec.Calendar.prototype.setDateFormat = function (str) {
	this.dateFormat = str;
};

/** Customizes the tooltip date format.  See
 * Zapatec.Calendar.prototype.setDateFormat() for a description of the \em str
 * format.
 *
 * @param str [string] the "tooltip" date format
 */
Zapatec.Calendar.prototype.setTtDateFormat = function (str) {
	this.ttDateFormat = str;
};

/**
 * Tries to identify the date represented in a string.  If successful it also
 * calls this.setDate which moves the calendar to the given date.
 *
 * @param str [string] a date
 * @param fmt [string] the format to try to parse \em str in
 */
Zapatec.Calendar.prototype.parseDate = function (str, fmt) {
	if (!str)
		return this.setDate(this.config.date);
	if (!fmt)
		fmt = this.dateFormat;
	var date = zapatecDate.parseDate.call(this, str, fmt);
	return this.setDate(date);
};

/**
 * This function hides or shows "windowed controls" accordingly so that the
 * calendar isn't obtured by any such control.  Historically, this function was
 * used for any browser.  It simply walks through all SELECT, IFRAME and APPLET
 * elements present in the DOM, checks if they intersect the calendar and hides
 * them if so or makes them visible otherwise.  This approacy has a number of
 * problems, the most important being that if the end-user's code contains a
 * SELECT which is already hidden and it must stay hidden, it will still be
 * made visible when the calendar closes.  The other obvious problem is that
 * there's an ugly effect generated by elements that suddenly (dis)appear when
 * you drag the calendar around the screen.
 *
 * Currently this function is only used on IE5.0/Windows, browser that leaves
 * no room for a better workaround to this problem.  For IE5.5+/Windows an
 * workaround is possible, albeit amazingly ugly (WCH).  For other browsers
 * such crazy techniques are not anymore useful because the bugs related to
 * windowed controls were fixed.
 */
Zapatec.Calendar.prototype.hideShowCovered = function () {
	if (!Zapatec.is_ie5)
		return;
	var self = this;
	function getVisib(obj) {
		var value = obj.style.visibility;
		if (!value) {
			if (window.document.defaultView && typeof (window.document.defaultView.getComputedStyle) == "function") { // Gecko, W3C
				if (!Zapatec.is_khtml)
					value = window.document.defaultView.
						getComputedStyle(obj, "").getPropertyValue("visibility");
				else
					value = '';
			} else if (obj.currentStyle) { // IE
				value = obj.currentStyle.visibility;
			} else
				value = '';
		}
		return value;
	}
	;

	var tags = ["applet", "iframe", "select"];
	var el = self.element;

	var p = Zapatec.Utils.getAbsolutePos(el);
	var EX1 = p.x;
	var EX2 = el.offsetWidth + EX1;
	var EY1 = p.y;
	var EY2 = el.offsetHeight + EY1;

	for (var k = tags.length; k > 0;) {
		var ar = window.document.getElementsByTagName(tags[--k]);
		var cc = null;

		for (var i = ar.length; i > 0;) {
			cc = ar[--i];

			p = Zapatec.Utils.getAbsolutePos(cc);
			var CX1 = p.x;
			var CX2 = cc.offsetWidth + CX1;
			var CY1 = p.y;
			var CY2 = cc.offsetHeight + CY1;

			if (self.hidden || (CX1 > EX2) || (CX2 < EX1) || (CY1 > EY2) || (CY2 < EY1)) {
				if (!cc.__msh_save_visibility) {
					cc.__msh_save_visibility = getVisib(cc);
				}
				cc.style.visibility = cc.__msh_save_visibility;
			} else {
				if (!cc.__msh_save_visibility) {
					cc.__msh_save_visibility = getVisib(cc);
				}
				cc.style.visibility = "hidden";
			}
		}
	}
};

/**
 * This function displays the week day names in the calendar header, according
 * to the current "firstDay".
 */
Zapatec.Calendar.prototype._displayWeekdays = function () {
	var fdow = this.config.firstDay;
	var cell = this.firstDayName;
	var weekend = Zapatec.Calendar.i18n("WEEKEND", null, this);
	//displaying one row of day names for every month in the row
	for (k = 1; (k <= this.config.monthsInRow) && (cell); ++k) {
		for (var i = 0; i < 7; i++) {
			cell.className = "day name";
			if ((!this.config.weekNumbers) && (i == 0) && (k != 1)) {
				Zapatec.Utils.addClass(cell, "month-left-border");
			}
			if ((i == 6) && (k != this.config.monthsInRow)) {
				Zapatec.Utils.addClass(cell, "month-right-border");
			}
			var realday = (i + fdow) % 7;

			if ((!this.config.disableFdowChange) && ((this.config && this.config.fdowClick) || i)) {
				if (Zapatec.Calendar.i18n("DAY_FIRST", null, this) != null) {
					cell.ttip = Zapatec.Calendar.i18n("DAY_FIRST", null, this).replace("%s", Zapatec.Calendar.i18n(realday, "dn", this));
				}
				cell.navtype = 100;
				cell.calendar = this;
				cell.fdow = realday;
				Zapatec.Calendar._add_evs(cell);
			}
			if ((weekend != null) && (weekend.indexOf(realday.toString()) != -1)) {
				Zapatec.Utils.addClass(cell, "weekend");
			}
			cell.innerHTML = Zapatec.Calendar.i18n((i + fdow) % 7, "sdn", this);
			cell = cell.nextSibling;
		}
		if (this.config.weekNumbers && cell) {
			cell = cell.nextSibling;
		}
	}
};


/**
 * Compare two dates in either ascending or descending order. To be used for
 * the multiple dates feature. This function is passed as an argument to the
 * sort routine which calls it to compare dates.
 *
 * @param date1 [date] first date
 * @param date2 [date] second date
 */
Zapatec.Calendar.compareDates = function(date1, date2)
{
	if (Zapatec.Calendar.sortOrder == "asc")
		return date1 - date2;
	else //"desc"ending order
		return date2 - date1;
}

/** \internal Hides all combo boxes that might be displayed. */
Zapatec.Calendar.prototype._hideCombos = function () {
	if (this.monthsCombo.style.display != "none")
		var combo = this.monthsCombo;
	else if (this.yearsCombo.style.display != "none")
		var combo = this.yearsCombo;
	else if (this.histCombo.style.display != "none")
		var combo = this.histCombo;
	if (combo)
		for (var i = combo.firstChild; i; i = i.nextSibling) {
			var m = i.month;
			Zapatec.Utils.removeClass(i, "hilite");
			Zapatec.Utils.removeClass(i, "active");
			Zapatec.Utils.removeClass(i, "disabled");
		}

	this.monthsCombo.style.display = "none";
	this.yearsCombo.style.display = "none";
	this.histCombo.style.display = "none";
	this.updateWCH();
};

/** \internal Starts dragging the element. */
Zapatec.Calendar.prototype._dragStart = function (ev) {
	ev || (ev = window.event);
	if (this.dragging) {
		return;
	}
	this.dragging = true;
	var posX = ev.clientX + window.document.body.scrollLeft;
	var posY = ev.clientY + window.document.body.scrollTop;
	var st = this.element.style;
	this.xOffs = posX - parseInt(st.left);
	this.yOffs = posY - parseInt(st.top);
	Zapatec.Utils.addEvent(window.document, "mousemove", Zapatec.Calendar.calDragIt);
	Zapatec.Utils.addEvent(window.document, "mouseover", Zapatec.Calendar.calDragIt);
	Zapatec.Utils.addEvent(window.document, "mouseup", Zapatec.Calendar.calDragEnd);
};

/**
 * Show error message
 * @private
 * @param [string] "Human readable error description"
 */
Zapatec.Calendar.submitErrorFunc = function(oError) {
	var oMsg = "Calendar ";
	if (typeof oError.id != "undefined")
		oMsg += "(" + oError.id + ") ";
	if (typeof oError.source != "undefined")
		oMsg += oError.source;
	else
		oMsg += "unknown";
	oMsg += " error";
	oMsg += "\n" + oError.errorDescription;

	alert(oMsg);
};
