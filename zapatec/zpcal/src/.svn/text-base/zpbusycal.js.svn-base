/**
 * @fileoverview Zapatec Busy Calendar widget. Extends Zapatec Calendar widget
 * and displays busy dates on it.
 *
 * <pre>
 * Copyright (c) 2004-2009 by Zapatec, Inc.
 * http://www.zapatec.com
 * 1700 MLK Way, Berkeley, California,
 * 94709, U.S.A.
 * All rights reserved.
 * </pre>
 */

/* $Id: zpbusycal.js 17416 2009-05-06 08:08:48Z nmaxim $ */

/**
 * Zapatec Busy Calendar widget class. Extends Zapatec Calendar class.
 *
 * <pre>
 * Accepts JSON source only.
 *
 * Input data format:
 * {
 *   busydates: [
 *     array of busy dates as Date objects or strings in RFC 2445 (yyyymmdd) or
 *     ISO 8601 (yyyy-mm-dd) format
 *   ]
 * }
 *
 * If callbackSource config option is defined, callback function receives range
 * of displayed dates:
 * {
 *   from: [string] first displayed date in RFC 2445 format,
 *   to: [string] last displayed date in RFC 2445 format
 * }
 *
 * <strong>In addition to config options defined in base Zapatec.Calendar class
 * provides following config options:</strong>
 *
 * <b>preloadMonths</b> [number] Number of months to preload. 0 - no preload.
 * Default: 1.
 * </pre>
 *
 * @constructor
 * @extends Zapatec.Calendar
 * @requires Zapatec.Calendar Requires zpcal/src/calendar.js
 * @param {any} any Any number of arguments passed to parent method
 */
Zapatec.Busycal = function() {
	// Call constructor of superclass with passed arguments
	zapatecBusycal.SUPERconstructor.apply(this, arguments);
};

/**
 * Shortcut for faster access.
 * @private
 * @final
 */
zapatecBusycal = Zapatec.Busycal;

/**
 * Unique static id of the widget class. Gives ability for
 * {@link Zapatec#inherit} to determine and store path to this file correctly
 * when it is included using {@link Zapatec#include}. When this file is included
 * using {@link Zapatec#include} or path to this file is obtained using
 * {@link Zapatec#getPath}, this value must be specified as script id.
 * @private
 * @final
 */
Zapatec.Busycal.id = 'Zapatec.Busycal';

// Inherit Zapatec Calendar
Zapatec.inherit(zapatecBusycal, zapatecCalendar);

/**
 * Configures the widget.
 *
 * @private
 * @param {any} any Any number of arguments passed to parent method
 */
Zapatec.Busycal.prototype.configure = function() {
	// Overwrite default config options
	this.defineConfigOption('dateStatusFunc', zapatecBusycal.dateStatusFunc);
	this.defineConfigOption('preloadMonths', 1);
	this.defineConfigOption('source', {});
	this.defineConfigOption('sourceType', 'json');
	// Call parent method with passed arguments
	zapatecBusycal.SUPERclass.configure.apply(this, arguments);
};

/**
 * Default dateStatusFunc. See dateStatusFunc config option of
 * {@link Zapatec#Calendar}.
 *
 * @private
 * @param {object} oDate Date object
 */
Zapatec.Busycal.dateStatusFunc = function(oDate) {
	// Get data
	var aBusydates = this.data;
	if (!aBusydates) {
		return;
	}
	aBusydates = aBusydates.busydates;
	if (!(aBusydates instanceof Array)) {
		return;
	}
	// Check date
	if (zapatecUtils.arrIndexOf(
		aBusydates,
		zapatecDate.dateToDateStamp({date: oDate})
	) >= 0) {
		// Display cell busy
		return 'zpBusycalBusy';
	}
	return false;
};

/**
 * Pulls information about busy dates from server. Preloads previous and next
 * months. Calls parent method first to display grid with previously preloaded
 * data. Then loads new data and updates grid with loaded data.
 *
 * @private
 * @param {any} any Any number of arguments passed to parent method
 */
Zapatec.Busycal.prototype._init = function() {
	// Call parent method with passed arguments
	zapatecBusycal.SUPERclass._init.apply(this, arguments);
	// Check loaded flag
	if (this.bcLoaded) {
		// Remove flag
		this.bcLoaded = null;
	} else {
		// Get range of displayed dates in RFC 2445 format
		var oRange = this.getRange();
		var iPreloadDays = parseInt(this.config.preloadMonths);
		if (isNaN(iPreloadDays) || iPreloadDays < 0) {
			iPreloadDays = 0;
		}
		iPreloadDays *= 42;
		var sFrom = zapatecDate.dateToDateStamp({
			// Extend range to preload previous n days
			date: zapatecDate.getTomorrow({
				date: oRange.from,
				days: -iPreloadDays
			})
		});
		var sTo = zapatecDate.dateToDateStamp({
			// Extend range to preload next n days
			date: zapatecDate.getTomorrow({
				date: oRange.to,
				// End date is non-inclusive
				days: iPreloadDays + 1
			})
		});
		if (!sFrom || !sTo) {
			return;
		}
		// Abort previous data request
		this.loadDataAbort();
		// Load data
		// Pass range to callbackSource
		this.loadData({
			from: sFrom,
			to: sTo
		});
	}
};

/**
 * Loads data from JSON source.
 *
 * @private
 * @param {object} oData Input data object
 */
Zapatec.Busycal.prototype.loadDataJson = function(oData) {
	// Get data
	if (!(oData instanceof Object)) {
		oData = {};
	}
	if (!(oData.busydates instanceof Array)) {
		oData.busydates = [];
	}
	// Convert dates to RFC 2445 format
	var fDateToDateStamp = zapatecDate.dateToDateStamp;
	var fTimeIsoToTimeStamp = zapatecDate.timeIsoToTimeStamp;
	var aBusydates = oData.busydates;
	var iDates = aBusydates.length;
	var oDate;
	for (var iDate = 0; iDate < iDates; iDate++) {
		oDate = aBusydates[iDate];
		if (oDate instanceof Date) {
			aBusydates[iDate] = fDateToDateStamp({
				date: oDate
			});
		} else {
			aBusydates[iDate] = fTimeIsoToTimeStamp({
				dateIso: oDate
			}).substr(0, 8);
		}
	}
	// Store for later use
	this.data = oData;
	// Flag data were loaded
	this.bcLoaded = true;
	// Display grid
	zapatecBusycal.SUPERclass.reinit.call(this);
};
