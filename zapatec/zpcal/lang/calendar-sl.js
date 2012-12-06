// $Id: calendar-sl.js 15736 2009-02-06 15:29:25Z nikolai $
// ** I18N

// Calendar EN language
// Contac: <support@zapatec.com>
// Encoding: any
// Copyright Zapatec 2004-2009

// For translators: please use UTF-8 if possible.  

// full day names
Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "sl"], {

"_DN" : new Array
("nedelja",
 "ponedeljek",
 "torek",
 "sreda",
 "\u010detrtek",
 "petek",
 "sobota",
 "nedelja"),

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Zapatec.Calendar._SDN_len = N; // short day name length
//   Zapatec.Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
"_SDN" : new Array
("ne",
 "po",
 "to",
 "sr",
 "\u010de",
 "pe",
 "so",
 "ne"),

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
"_FD" : 0,

// full month names
"_MN" : new Array
("januar",
 "februar",
 "marec",
 "april",
 "maj",
 "junij",
 "julij",
 "avgust",
 "september",
 "oktober",
 "november",
 "december"),

// short month names
"_SMN" : new Array
("jan",
 "feb",
 "mar",
 "apr",
 "maj",
 "jun",
 "jul",
 "avg",
 "sep",
 "okt",
 "nov",
 "dec"),

// tooltips

"INFO" :  "Vizitka koledarja",

"ABOUT" : 
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
"Najnovej\u0161o razli\u010dico najdete na: http://www.zapatec.com/\n" +
"\n\n" +
"Izbiranje datuma:\n" +
"- leto izberete z gumboma \xab, \xbb \n" +
"- mesec izberete z gumboma " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " \n" +
"- Za hitrej\u0161e izbiranje kliknite ustreznega od zgornjih gumbov in dr\u017eite tipko mi\u0161ke pritisnjeno.",
"ABOUT_TIME" :  "\n\n" +
"Izbiranje \u010dasa:\n" +
"- \u010de \u017eelite pove\u010dati katerega od delov prikazanega \u010dasa, kliknite nanj\n" +
"- zmanj\u0161ate ga tako, da ob kliku nanj dr\u017eite pritisnjeno tipko Shift\n" +
"- za hitrej\u0161e izbiranje kliknite in povlecite.",

"PREV_YEAR" :  "Prej\u0161nje leto (podr\u017eite za prikaz menija)",
"PREV_MONTH" :  "Prej\u0161nji mesec (podr\u017eite za prikaz menija)",
"GO_TODAY" :  "Premik na dana\u0161nji dan (podr\u017eite za prikaz zgodovine)",
"NEXT_MONTH" :  "Naslednji mesec (podr\u017eite za prikaz menija)",
"NEXT_YEAR" :  "Naslednje leto (podr\u017eite za prikaz menija)",
"SEL_DATE" :  "Izberite datum",
"DRAG_TO_MOVE" :  "Premikajte z vle\u010denjem",
"PART_TODAY" :  " (dana\u0161nji dan)",

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
"DAY_FIRST" :  "Prvi dan v tednu je %s",

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
"WEEKEND" :  "0,6",

"CLOSE" :  "Zapri",
"TODAY" :  "Danes",
"TIME_PART" :  "Za spreminjanje vrednosti uporabite (Shift-)klik ali vle\u010denje",

// date formats
"DEF_DATE_FORMAT" :  "%Y-%m-%d",
"TT_DATE_FORMAT" :  "%a, %b %e",

"WK" :  "teden",
"TIME" :  "\u010cas:",

"E_RANGE" :  "Izven dovoljenega obsega",
	
"_AMPM" : {am : "dopoldan", pm : "popoldan"}

})
