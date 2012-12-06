// $Id: calendar-da.js 8274 2007-09-25 12:42:06Z nmaxim $
// ** I18N

// Calendar DA language

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "da"], {
  // full day names
  "_DN"  : new Array
           ("Søndag",
"Mandag",
"Tirsdag",
"Onsdag",
"Torsdag",
"Fredag",
"Lørdag",
"Søndag"),
  // short day names
  "_SDN" : new Array
           ("Søn",
"Man",
"Tir",
"Ons",
"Tor",
"Fre",
"Lør",
"Søn"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("Januar",
"Februar",
"Marts",
"April",
"Maj",
"Juni",
"Juli",
"August",
"September",
"Oktober",
"November",
"December"),
  // short month names
  "_SMN" : new Array
          ("Jan",
"Feb",
"Mar",
"Apr",
"Maj",
"Jun",
"Jul",
"Aug",
"Sep",
"Okt",
"Nov",
"Dec"),
   // tooltips
   "INFO" : "Om Kalenderen",
   "ABOUT": "DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"For latest version visit: http://www.zapatec.com/\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Valg af dato:\n" +
"- Brug \xab, \xbb knapperne for at vælge år\n" +
"- Brug " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " knapperne for at vælge måned\n" +
"- Hold knappen på musen nede på knapperne ovenfor for hurtigere valg.",
   "ABOUT_TIME" : "\n\n" +
"Valg af tid:\n" +
"- Klik på en vilkårlig del for større værdi\n" +
"- eller Shift-klik for for mindre værdi\n" +
"- eller klik og træk for hurtigere valg.",

   "PREV_YEAR"    : "Ét år tilbage (hold for menu)",
   "PREV_MONTH"   : "Én måned tilbage (hold for menu)",
   "GO_TODAY"     : "Gå til i dag",
   "NEXT_MONTH"   : "Én måned frem (hold for menu)",
   "NEXT_YEAR"    : "Ét år frem (hold for menu)",
   "SEL_DATE"     : "Vælg dag",
   "DRAG_TO_MOVE" : "Træk vinduet",
   "PART_TODAY"   : " (i dag)",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Vis %s først",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "Luk",
   "TODAY"        : "I dag",
   "TIME_PART"    : "(Shift-)klik eller træk for at ændre værdi",

   // date formats
   "DEF_DATE_FORMAT"  : "%d-%m-%Y",
   "TT_DATE_FORMAT"   : "%a, %b %e",

   "WK"           : "Uge",
   "TIME"         : "Tid:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
