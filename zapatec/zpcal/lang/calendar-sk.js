// $Id: calendar-sk.js 8274 2007-09-25 12:42:06Z nmaxim $
// ** I18N

// Calendar SK language
// Author: Peter Valach (pvalach@gmx.net)
// Encoding: utf-8
// Last update: 2003/10/29
// Distributed under the same terms as the calendar itself.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "sk"], {
  // full day names
  "_DN"  : new Array
           ("NedeÃ"Ä_a",
 "Pondelok",
 "Utorok",
 "Streda",
 "Ä¹Â tvrtok",
 "Piatok",
 "Sobota",
 "NedeÃ"Ä_a"),
  // short day names
  "_SDN" : new Array
           ("Ned",
 "Pon",
 "Uto",
 "Str",
 "Ä¹Â tv",
 "Pia",
 "Sob",
 "Ned"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("JanuÄ'Ë+r",
 "FebruÄ'Ë+r",
 "Marec",
 "AprÄ'Â-l",
 "MÄ'Ë+j",
 "JÄ'Å_n",
 "JÄ'Å_l",
 "August",
 "September",
 "OktÄ'Å'ber",
 "November",
 "December"),
  // short month names
  "_SMN" : new Array
           ("Jan",
 "Feb",
 "Mar",
 "Apr",
 "MÄ'Ë+j",
 "JÄ'Å_n",
 "JÄ'Å_l",
 "Aug",
 "Sep",
 "Okt",
 "Nov",
 "Dec"),
   // tooltips
   "INFO" : "O kalendÄ'Ë+ri",
   "ABOUT": "DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" +
"PoslednÄ'Å_ verziu nÄ'Ë+jdete na: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"VÄ'Ë_ber dÄ'Ë+tumu:\n" +
"- PouÄ¹Ä_ite tlaÃ"Å¤idlÄ'Ë+ \xab, \xbb pre vÄ'Ë_ber roku\n" +
"- PouÄ¹Ä_ite tlaÃ"Å¤idlÄ'Ë+ " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " pre vÄ'Ë_ber mesiaca\n" +
"- Ak ktorÄ'ÂckoÃ"Ä_vek z tÄ'Ë_chto tlaÃ"Å¤idiel podrÄ¹Ä_Ä'Â-te dlhÄ¹Ë+ie, zobrazÄ'Â- sa rÄ'Ë_chly vÄ'Ë_ber.",
   "ABOUT_TIME" : "\n\n" +
"VÄ'Ë_ber Ã"Å¤asu:\n" +
"- Kliknutie na niektorÄ'Å_ poloÄ¹Ä_ku Ã"Å¤asu ju zvÄ'Ë_Ä¹Ë+i\n" +
"- Shift-klik ju znÄ'Â-Ä¹Ä_i\n" +
"- Ak podrÄ¹Ä_Ä'Â-te tlaÃ"Å¤Ä'Â-tko stlaÃ"Å¤enÄ'Âc, posÄ'Å_vanÄ'Â-m menÄ'Â-te hodnotu.",

   "PREV_YEAR"    : "PredoÄ¹Ë+lÄ'Ë_ rok (podrÄ¹Ä_te pre menu)",
   "PREV_MONTH"   : "PredoÄ¹Ë+lÄ'Ë_ mesiac (podrÄ¹Ä_te pre menu)",
   "GO_TODAY"     : "PrejsÄ¹Ä" na dneÄ¹Ë+ok",
   "NEXT_MONTH"   : "Nasl. mesiac (podrÄ¹Ä_te pre menu)",
   "NEXT_YEAR"    : "Nasl. rok (podrÄ¹Ä_te pre menu)",
   "SEL_DATE"     : "ZvoÃ"Ä_te dÄ'Ë+tum",
   "DRAG_TO_MOVE" : "PodrÄ¹Ä_anÄ'Â-m tlaÃ"Å¤Ä'Â-tka zmenÄ'Â-te polohu",
   "PART_TODAY"   : " (dnes)",
   "MON_FIRST" : "ZobraziÄ¹Ä" pondelok ako prvÄ'Ë_",
   "SUN_FIRST" : "ZobraziÄ¹Ä" nedeÃ"Ä_u ako prvÄ'Å_",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Display %s first",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "ZavrieÄ¹Ä"",
   "TODAY"        : "Dnes",
   "TIME_PART"    : "(Shift-)klik/Ä¹Ä"ahanie zmenÄ'Â- hodnotu",

   // date formats
   "DEF_DATE_FORMAT"  : $d. %m. %Y",
   "TT_DATE_FORMAT"   : "%a, %e. %b",

   "WK"           : "tÄ'Ë_Ä¹Ä_",
   "TIME"         : "Time:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
