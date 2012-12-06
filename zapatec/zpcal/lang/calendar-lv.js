// $Id: calendar-lv.js 15736 2009-02-06 15:29:25Z nikolai $
// ** I18N

// Calendar EN language
// Contac: <support@zapatec.com>
// Encoding: any
// Copyright Zapatec 2004-2009

// For translators: please use UTF-8 if possible.  

// full day names
Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "lv"], {

"_DN" : new Array
("Sv\u0113tdiena",
 "Pirmdiena",
 "Otrdiena",
 "Tre\u0161diena",
 "Ceturtdiena",
 "Piektdiena",
 "Sestdiena",
 "Sv\u0113tdiena"),

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Zapatec.Calendar._SDN_len = N, // short day name length
//   Zapatec.Calendar._SMN_len = N, // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
"_SDN" : new Array
("Sv",
 "P",
 "O",
 "T",
 "C",
 "P",
 "St",
 "Sv"),

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
"_FD" : 0,

// full month names
"_MN" : new Array
("Janv\u0101ris",
 "Febru\u0101ris",
 "Marts",
 "Apr\u012blis",
 "Maijs",
 "J\u016bnijs",
 "J\u016blijs",
 "Augusts",
 "Septembris",
 "Oktobris",
 "Novembris",
 "Decembris"),

// short month names
"_SMN" : new Array
("Jan",
 "Feb",
 "Mar",
 "Apr",
 "Mai",
 "J\u016bn",
 "J\u016bl",
 "Aug",
 "Sep",
 "Okt",
 "Nov",
 "Dec"),

// tooltips

"INFO" :  "Par kalend\u0101ru",

"ABOUT" : 
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
"Lai apskat\u012btu p\u0113d\u0113jo versiju, apmekl\u0113jiet: http://www.zapatec.com/\n" +
"\n\n" +
"Datuma izv\u0113le:\n" +
"- Izmantojiet \xab, \xbb pogas, lai izv\u0113l\u0113tos gadu\n" +
"- Izmantojiet " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " pogas, lai izv\u0113l\u0113tos m\u0113nesi\n" +
"- Lai izv\u0113les izdar\u012b\u0161ana notiktu \u0101tr\u0101k, piespie\u017eot vienu no augst\u0101k min\u0113taj\u0101m pog\u0101m, turiet piespiest peles pogu.",
"ABOUT_TIME" :  "\n\n" +
"Laika izv\u0113le:\n" +
"- Lai palielin\u0101tu laiku, uzklik\u0161\u0137iniet uz jebkuras no t\u0101 da\u013c\u0101m\n" +
"- vai uzklik\u0161\u0137iniet Shift, lai to samazin\u0101tu\n" +
"- vai uzklik\u0161\u0137iniet un velciet, lai \u0101tr\u0101k izdar\u012btu izv\u0113li.",

"PREV_YEAR" :  "Iepr. gads (pieturiet, lai apskat\u012btu izv\u0113lni)",
"PREV_MONTH" :  "Iepr. m\u0113nesis (pieturiet, lai apskat\u012btu izv\u0113lni)",
"GO_TODAY" :  "Skat\u012bt \u0161odienu (pietur\u0113t, lai apskat\u012btu v\u0113sturi)",
"NEXT_MONTH" :  "N\u0101kamais m\u0113nesis (pietur\u0113t, lai apskat\u012btu izv\u0113lni)",
"NEXT_YEAR" :  "N\u0101kamais m\u0113nesis (pietur\u0113t, lai apskat\u012btu izv\u0113lni)",
"SEL_DATE" :  "Izv\u0113l\u0113ties datumu",
"DRAG_TO_MOVE" :  "Vilkt, lai p\u0101rvietotu",
"PART_TODAY" :  " (\u0161odiena)",

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
"DAY_FIRST" :  "Vispirms par\u0101d\u012bt %s",

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
"WEEKEND" :  "0,6",

"CLOSE" :  "Sl\u0113gts",
"TODAY" :  "\u0160odiena",
"TIME_PART" :  "(Shift-)Uzklik\u0161\u0137in\u0101t vai vilkt, lai main\u012btu v\u0113rt\u012bbu",

// date formats
"DEF_DATE_FORMAT" :  "%Y-%m-%d",
"TT_DATE_FORMAT" :  "%a, %b %e",

"WK" :  "ned",
"TIME" :  "Laiks:",

"E_RANGE" :  "\u0100rpus diapazona robe\u017e\u0101m",
	
"_AMPM" : {am : "no r\u012bta", pm : "p\u0113cpusdien\u0101"}

})
