// $Id: calendar-no.js 8274 2007-09-25 12:42:06Z nmaxim $
// ** I18N

// Calendar NO language
// Author: Daniel Holmen, <daniel.holmen@ciber.no>
// Encoding: UTF-8
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "no"], {
  // full day names
  "_DN"  : new Array
          ("S√∏ndag",
 "Mandag",
 "Tirsdag",
 "Onsdag",
 "Torsdag",
 "Fredag",
 "L√∏rdag",
 "S√∏ndag"),
  // short day names
  "_SDN" : new Array
           ("S√∏n",
 "Man",
 "Tir",
 "Ons",
 "Tor",
 "Fre",
 "L√∏r",
 "S√∏n"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("Januar",
 "Februar",
 "Mars",
 "April",
 "Mai",
 "Juni",
 "Juli",
 "August",
 "September",
 "Oktober",
 "November",
 "Desember"),
  // short month names
  "_SMN" : new Array
          ("Jan",
 "Feb",
 "Mar",
 "Apr",
 "Mai",
 "Jun",
 "Jul",
 "Aug",
 "Sep",
 "Okt",
 "Nov",
 "Des"),
   // tooltips
   "INFO" : "Om kalenderen",
   "ABOUT": "DHTML Dato-/Tidsvelger\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"For nyeste versjon, g√_ til: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Datovalg:\n" +
"- Bruk knappene \xab og \xbb for √_ velge √_r\n" +
"- Bruk knappene " + String.fromCharCode(0x2039) + " og " + String.fromCharCode(0x203a) + " for √_ velge m√_ned\n" +
"- Hold inne musknappen eller knappene over for raskere valg.",
   "ABOUT_TIME" : "\n\n" +
"Tidsvalg:\n" +
"- Klikk p√_ en av tidsdelene for √_ √∏ke den\n" +
"- eller Shift-klikk for √_ senke verdien\n" +
"- eller klikk-og-dra for raskere valg..",

   "PREV_YEAR"    : "Forrige. √_r (hold for meny)",
   "PREV_MONTH"   : "Forrige. m√_ned (hold for meny)",
   "GO_TODAY"     : "G√_ til idag",
   "NEXT_MONTH"   : "Neste m√_ned (hold for meny)",
   "NEXT_YEAR"    : "Neste √_r (hold for meny)",
   "SEL_DATE"     : "Velg dato",
   "DRAG_TO_MOVE" : "Dra for √_ flytte",
   "PART_TODAY"   : " (idag)",
   "MON_FIRST": "Vis mandag f√∏rst",
   "SUN_FIRST"  : "Vis s√∏ndag f√∏rst",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Display %s first",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "Lukk",
   "TODAY"        : "Idag",
   "TIME_PART"    : "(Shift-)Klikk eller dra for √_ endre verdi",

   // date formats
   "DEF_DATE_FORMAT"  : "%d.%m.%Y",
   "TT_DATE_FORMAT"   : "%a, %b %e",

   "WK"           : "uke",
   "TIME"         : "Time:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
