// $Id: calendar-al.js 11966 2008-06-19 10:33:45Z nmaxim $
// Calendar ALBANIAN language
//author Rigels Gordani rige@hotmail.com

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "al"], {
  // full day names
  "_DN"  : new Array
           ("E Diele",
"E Hene",
"E Marte",
"E Merkure",
"E Enjte",
"E Premte",
"E Shtune",
"E Diele"),
  // short day names
  "_SDN" : new Array
("Die",
"Hen",
"Mar",
"Mer",
"Enj",
"Pre",
"Sht",
"Die"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("Janar",
"Shkurt",
"Mars",
"Prill",
"Maj",
"Qeshor",
"Korrik",
"Gusht",
"Shtator",
"Tetor",
"Nentor",
"Dhjetor"),
  // short month names
  "_SMN" : new Array
          ("Jan",
"Shk",
"Mar",
"Pri",
"Maj",
"Qes",
"Kor",
"Gus",
"Sht",
"Tet",
"Nen",
"Dhj"),
   // tooltips
   "INFO" : "Per kalendarin",
   "ABOUT": "Zgjedhes i ores/dates ne DHTML \n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"For latest version visit: http://www.zapatec.com/\n" +
"\n\n" +"Zgjedhja e Dates:\n" +
"- Perdor butonat \xab, \xbb per te zgjedhur vitin\n" +
"- Perdor  butonat" + String.fromCharCode(0x2039) + ", " +
String.fromCharCode(0x203a) +
" per te  zgjedhur muajin\n" +
"- Mbani shtypur butonin e mousit per nje zgjedje me te shpejte.",
   "ABOUT_TIME" : "\n\n" +
"Zgjedhja e kohes:\n" +
"- Kliko tek ndonje nga pjeset e ores per ta rritur ate\n" +
"- ose kliko me Shift per ta zvogeluar ate\n" +
"- ose cliko dhe terhiq per zgjedhje me te shpejte.",

   "PREV_YEAR"    : "Viti i shkuar (prit per menune)",
   "PREV_MONTH"   : "Muaji i shkuar (prit per menune)",
   "GO_TODAY"     : "Sot",
   "NEXT_MONTH"   : "Muaji i ardhshem (prit per menune)",
   "NEXT_YEAR"    : "Viti i ardhshem (prit per menune)",
   "SEL_DATE"     : "Zgjidh daten",
   "DRAG_TO_MOVE" : "Terhiqe per te levizur",
   "PART_TODAY"   : " (sot)",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Trego te %s te paren",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "Mbyll",
   "TODAY"        : "Sot",
   "TIME_PART"    : "Kliko me (Shift-)ose terhiqe per te ndryshuar vleren",

   // date formats
   "DEF_DATE_FORMAT"  : "%Y-%m-%d",
   "TT_DATE_FORMAT"   : "%a, %b %e",

   "WK"           : "Java",
   "TIME"         : "Koha:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
