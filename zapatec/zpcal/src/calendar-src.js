/**
 * $Id: calendar.js 17416 2009-05-06 08:08:48Z nmaxim $
 * @fileoverview Zapatec Calendar widget. Include this file in your HTML page.
 * Includes Zapatec Calendar modules: calendar-core.js, calendar-date-core.js, calendar-setup.js.
 *
 * <pre>
 * Copyright (c) 2004-2009 by Zapatec, Inc.
 * http://www.zapatec.com
 * 1700 MLK Way, Berkeley, California,
 * 94709, U.S.A.
 * All rights reserved.
 * </pre>
 */

/**
 * @private Get path to this script
 */
Zapatec.calendarPath = Zapatec.getPath("Zapatec.CalendarWidget");

// Include required scripts
Zapatec.Transport.include(Zapatec.calendarPath + '../lang/calendar-en.js');
Zapatec.Transport.include(Zapatec.calendarPath + 'calendar-core.js', "Zapatec.Calendar");
Zapatec.Transport.include(Zapatec.calendarPath + 'calendar-setup.js');

