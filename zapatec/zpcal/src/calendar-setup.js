/* 
 * $Id: calendar-setup.js 15736 2009-02-06 15:29:25Z nikolai $
 * The Zapatec DHTML Calendar
 *
 * Copyright (c) 2004-2009 by Zapatec, Inc.
 * http://www.zapatec.com
 * 1700 MLK Way, Berkeley, California,
 * 94709, U.S.A. 
 * All rights reserved.
 *
 * Original version written by Mihai Bazon,
 * http://www.bazon.net/mishoo/calendar.epl
 *
 * This file defines helper functions for setting up the calendar.  They are
 * intended to help non-programmers get a working calendar on their site
 * quickly.  This script should not be seen as part of the calendar.  It just
 * shows you what one can do with the calendar, while in the same time
 * providing a quick and simple method for setting it up.  If you need
 * exhaustive customization of the calendar creation process feel free to
 * modify this code to suit your needs (this is recommended and much better
 * than modifying calendar.js itself).
 */

// $Id: calendar-setup.js 15736 2009-02-06 15:29:25Z nikolai $

Zapatec.Calendar.setup = function(oArg) {
  // Call constructor of Zapatec.Calendar
  return new Zapatec.Calendar(oArg);
};

Zapatec.Calendar.setup.id = "Zapatec.Calendar.setup";

Zapatec.inherit(Zapatec.Calendar.setup, Zapatec.Calendar);  
