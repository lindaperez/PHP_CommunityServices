// $Id: calendar-hr.js 15736 2009-02-06 15:29:25Z nikolai $
// ** I18N

// Calendar EN language
// Contac: <support@zapatec.com>
// Encoding: any
// Copyright Zapatec 2004-2009

// For translators: please use UTF-8 if possible.  

// full day names
Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "hr"], {

"_DN" : new Array
("Nedjelja",
 "Ponedjeljak",
 "Utorak",
 "Srijeda",
 "\u010cetvrtak",
 "Petak",
 "Subota",
 "Nedjelja"),

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
("Ned",
 "Pon",
 "Uto",
 "Sri",
 "\u010cet",
 "Pet",
 "Sub",
 "Ned"),

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
"_FD" : 0,

// full month names
"_MN" : new Array
("Sije\u010danj",
 "Velja\u010da",
 "O\u017eujak",
 "Travanj",
 "Svibanj",
 "Lipanj",
 "Srpanj",
 "Kolovoz",
 "Rujan",
 "Listopad",
 "Studeni",
 "Prosinac"),

// short month names
"_SMN" : new Array
("Sij",
 "Vel",
 "O\u017eu",
 "Tra",
 "Svi",
 "Lip",
 "Srp",
 "Kol",
 "Ruj",
 "Lis",
 "Stu",
 "Pro"),

// tooltips

"INFO" :  "O kalendaru",

"ABOUT" : 
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
"Za zadnju verziju posjetite: http://www.zapatec.com/\n" +
"\n\n" +
"Odabir datuma:\n" +
"- Upotrijebite tipke \xab, \xbb za odabir godine\n" +
"- Upotrijebite tipke " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " za odabir mjeseca\n" +
"- Dr\u017eite pritisnutom tipku mi\u0161a na bilo kojoj od gornjih tipki zbog br\u017eeg odabira.",
"ABOUT_TIME" :  "\n\n" +
"Odabir vremena:\n" +
"- Kliknite na bilo koji dio vremena da biste ga pove\u0107ali\n" +
"- ili na Shift-klik da biste ga smanjili\n" +
"- ili kliknite i odvucite zbog br\u017eeg odabira.",

"PREV_YEAR" :  "Pret. godina (dr\u017eati zbog izbornika)",
"PREV_MONTH" :  "Pret. mjesec (dr\u017eati zbog izbornika)",
"GO_TODAY" :  "Idi danas (dr\u017eati zbog povijesti)",
"NEXT_MONTH" :  "Slijede\u0107i mjesec (dr\u017eati zbog izbornika)",
"NEXT_YEAR" :  "Slijede\u0107a godina (dr\u017eati zbog izbornika)",
"SEL_DATE" :  "Odaberi datum",
"DRAG_TO_MOVE" :  "Odvuci za pomak",
"PART_TODAY" :  " (danas)",

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
"DAY_FIRST" :  "Prvo %s prika\u017ei",

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
"WEEKEND" :  "0,6",

"CLOSE" :  "Zatvori",
"TODAY" :  "Danas",
"TIME_PART" :  "(Shift-)Klik ili odvu\u0107i za promjenu vrijednosti",

// date formats
"DEF_DATE_FORMAT" :  "%G-%m-%d",
"TT_DATE_FORMAT" :  "%a, %b %e",

"WK" :  "tj",
"TIME" :  "Vrijeme:",

"E_RANGE" :  "Izvan opsega",
	
"_AMPM" : {am : "am", pm : "pm"}

})
