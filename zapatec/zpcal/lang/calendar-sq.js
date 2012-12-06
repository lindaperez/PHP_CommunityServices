// $Id: calendar-sq.js 15736 2009-02-06 15:29:25Z nikolai $
// ** I18N

// Calendar EN language
// Contac: <support@zapatec.com>
// Encoding: any
// Copyright Zapatec 2004-2009

// For translators: please use UTF-8 if possible. 

// full day names
Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "sq"], {

"_DN" : new Array
("E diel",
 "E hënë",
 "E martë",
 "E mërkurë",
 "E enjte",
 "E premte",
 "E shtunë",
 "E diel"),

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary. We give it here
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
("Die",
 "Hën",
 "Mar",
 "Mër",
 "Enj",
 "Pre",
 "Sht",
 "Die"),

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
"_FD" : 0,

// full month names
"_MN" : new Array
("Janar",
 "Shkurt",
 "Mars",
 "Prill",
 "Maj",
 "Qershor",
 "Korrik",
 "Gusht",
 "Shtator",
 "Tetor",
 "Nëntor",
 "Dhjetor"),

// short month names
"_SMN" : new Array
("Jan",
 "Shk",
 "Mar",
 "Pri",
 "Maj",
 "Qer",
 "Kor",
 "Gus",
 "Sht",
 "Tet",
 "Nën",
 "Dhj"),

// tooltips

"INFO" :  "Rreth kalendarit",

"ABOUT" : 
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
"Për versionin e fundit vizitoni: http://www.zapatec.com/\n" +
"\n\n" +
"Selektimi i datës:\n" +
"- Përdorni butonat \xab, \xbb për të selektuar vitin\n" +
"- Përdorni butonat  " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " për të selektuar muajin\n" +
"- Mbani butonin e mous-it në çdonjërin nga butonat e mësipërm për një selektim më të shpejtë.",
"ABOUT_TIME" :  "\n\n" +
"Selektimi i orës:\n" +
"- Klikoni në çfarëdo pjesë të kohës për ta rritur atë\n" +
"- ose Shift-klik për ta zvogëluar atë\n" +
"- ose klikoni dhe tërhiqni për një selektim më të shpejtë.",

"PREV_YEAR" :  "Viti  paraardhës (mbani për meny)",
"PREV_YEAR" :  "Muaji  paraardhës (mbani për meny)",
"GO_TODAY" :  "Shkoni Sot (mbani për historinë)",
"NEXT_MONTH" :  "Muaji tjetër (mbani për meny)",
"NEXT_YEAR" :  "Viti tjetër (mbani për meny)",
"SEL_DATE" :  "Selektoni datën",
"DRAG_TO_MOVE" :  "Tërhiq për të lëvizur",
"PART_TODAY" :  " (sot)",

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
"DAY_FIRST" :  "Shfaq %s përpara",

// This may be locale-dependent. It specifies the week-end days, as an array
// of comma-separated numbers. The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
"WEEKEND" :  "0,6",

"CLOSE" :  "Mbyll",
"TODAY" :  "Sot",
"TIME_PART" :  "(Shift-)Klikoni ose tërhiqni për të ndryshuar vlerën",

// date formats
"DEF_DATE_FORMAT" :  "%Y-%m-%d",
"TT_DATE_FORMAT" :  "%a, %b %e",

"WK" :  "jav",
"TIME" :  "Ora:",

"E_RANGE" :  "Jashtë gamës",
	
"_AMPM" : {am : "am", pm : "pm"}

})
