// $Id: calendar-ca.js 8295 2007-09-26 08:42:04Z nmaxim $
// ** I18N

// Calendar CA language
// Author: Mihai Bazon, <mihai_bazon@yahoo.com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "ca"], {
// full day names
"_DN" : new Array
("Diumenge",
 "Dilluns",
 "Dimarts",
 "Dimecres",
 "Dijous",
 "Divendres",
 "Dissabte",
 "Diumenge"),

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
("Diu",
 "Dil",
 "Dmt",
 "Dmc",
 "Dij",
 "Div",
 "Dis",
 "Diu"),

// full month names
"_MN" : new Array
("Gener",
 "Febrer",
 "Març",
 "Abril",
 "Maig",
 "Juny",
 "Juliol",
 "Agost",
 "Setembre",
 "Octubre",
 "Novembre",
 "Desembre"),

// short month names
"_SMN" : new Array
("Gen",
 "Feb",
 "Mar",
 "Abr",
 "Mai",
 "Jun",
 "Jul",
 "Ago",
 "Set",
 "Oct",
 "Nov",
 "Des"),

// tooltips

   "INFO": "Sobre el calendari",

  "ABOUT":
  "DHTML Selector de Data/Hora\n" +
       "(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
     "For latest version visit: http://www.zapatec.com/\n" +
     "This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
      "\n\n" +
       "Sel.lecció de Dates:\n" +
   "- Fes servir els botons \xab, \xbb per sel.leccionar l'any\n" +
   "- Fes servir els botons " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " per se.lecciconar el mes\n" +
   "- Manté el ratolí apretat en qualsevol dels anteriors per sel.lecció ràpida.",
   "ABOUT_TIME": "\n\n" +
   "Time selection:\n" +
   "- claca en qualsevol de les parts de la hora per augmentar-les\n" +
   "- o Shift-click per decrementar-la\n" +
   "- or click and arrastra per sel.lecció ràpida.",

   "PREV_YEAR": "Any anterior (Mantenir per menu)",
   "PREV_MONTH": "Mes anterior (Mantenir per menu)",
   "GO_TODAY": "Anar a avui",
   "NEXT_MONTH": "Mes següent (Mantenir per menu)",
   "NEXT_YEAR": "Any següent (Mantenir per menu)",
   "SEL_DATE": "Sel.leccionar data",
   "DRAG_TO_MOVE": "Arrastrar per moure",
   "PART_TODAY": " (avui)",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST": "Mostra %s primer",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND": "0,6",

   "CLOSE": "Tanca",
   "TODAY": "Avui",
   "TIME_PART": "(Shift-)Click a arrastra per canviar el valor",

   // date formats
   "DEF_DATE_FORMAT": "%Y-%m-%d",
   "TT_DATE_FORMAT": "%a, %b %e",

   "WK": "st",
   "TIME": "Hora:",

   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
