// $Id: calendar-pl.js 8295 2007-09-26 08:42:04Z nmaxim $
// ** I18N
// Calendar PL language
// Author: Artur Filipiak, <imagen@poczta.fm>
// January, 2004
// Encoding: UTF-8

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "pl"], {
  // full day names
  "_DN"  : new Array
           ("Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"),
  // short day names
  "_SDN" : new Array
           ("N", "Pn", "Wt", "Śr", "Cz", "Pt", "So", "N"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
           ("Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"),
  // short month names
  "_SMN" : new Array
           ("Sty", "Lut", "Mar", "Kwi", "Maj", "Cze", "Lip", "Sie", "Wrz", "Paź", "Lis", "Gru"),
   // tooltips
   "INFO" : "O kalendarzu",
   "ABOUT": "DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"For latest version visit: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Wybór daty:\n" +
"- aby wybrać rok użyj przycisków \xab, \xbb\n" +
"- aby wybrać miesiąc użyj przycisków " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + "\n" +
"- aby przyspieszyć wybór przytrzymaj wciśnięty przycisk myszy nad ww. przyciskami.",
   "ABOUT_TIME" : "\n\n" +
"Wybór czasu:\n" +
"- aby zwiększyć wartość kliknij na dowolnym elemencie selekcji czasu\n" +
"- aby zmniejszyć wartość użyj dodatkowo klawisza Shift\n" +
"- możesz również poruszać myszkę w lewo i prawo wraz z wciśniętym lewym klawiszem.",

   "PREV_YEAR"    : "Poprz. rok (przytrzymaj dla menu)",
   "PREV_MONTH"   : "Poprz. miesiąc (przytrzymaj dla menu)",
   "GO_TODAY"     : "Pokaż dziś",
   "NEXT_MONTH"   : "Nast. miesiąc (przytrzymaj dla menu)",
   "NEXT_YEAR"    : "Nast. rok (przytrzymaj dla menu)",
   "SEL_DATE"     : "Wybierz datę",
   "DRAG_TO_MOVE" : "Przesuń okienko",
   "PART_TODAY"   : " (dziś)",
   "MON_FIRST" : "Pokaż Poniedziałek jako pierwszy",
   "SUN_FIRST" : "Pokaż Niedzielę jako pierwszą",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Display %s first",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "Zamknij",
   "TODAY"        : "Dziś",
   "TIME_PART"    : "(Shift-)klik | drag, aby zmienić wartość",

   // date formats
   "DEF_DATE_FORMAT"  : "%Y.%m.%d",
   "TT_DATE_FORMAT"   : "%a, %b %e",

   "WK"           : "wk",
   "TIME"         : "Time:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});



