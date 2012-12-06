// $Id: calendar-sr.js 13413 2008-10-14 11:25:11Z mike $
// ** I18N

// Calendar SR language
// Author: Slavko Grubač, <grubacs@yahoo.com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.


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

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "en"], {
  // full day names
  "_DN"  : new Array
           ("nedelja",
            "ponedeljak",
            "utorak",
            "srijeda",
            "četvrtak",
            "petak",
            "subota",
            "nedelja"),
  // short day names
  "_SDN" : new Array
           ("ned",
            "pon",
            "uto",
            "sri",
            "čet",
            "pet",
            "sub",
            "ned"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 1,
  // full month names
  "_MN"  : new Array
            ("januar",
             "februar",
             "mart",
             "april",
             "maj",
             "jun",
             "jul",
             "avgust",
             "septembar",
             "oktobar",
             "novembar",
             "decembar"),
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
   "INFO" : "O kalendaru",
   "ABOUT": "DHTML Datumski/vremenski Selektor\n" +
            "(c) zapatec.com 2002-2008\n" + // don't translate this this ;-)
            "Za posljednju verziju posjetite: http://www.zapatec.com/" +
            "\n\n" +
            "Selekcija datuma:\n" +
            "- Koristite \xab, \xbb dugmiće da odaberete godinu\n" +
            "- Koristite" + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " dugmiće da odaberete mjesec\n" +
            "- Uradite dugi lijevi klik miša na bilo koji od gornjih dugmića za bržu selekciju.",
   "ABOUT_TIME" : "\n\n" +
                  "Selekcija vremena:\n" +
                  "- Kliknite na bilo koji dio sati:minute da ga uvećate\n" +
                  "- ili Shift-klik da umanjite\n" +
                  "- ili dugi klik za bržu selekciju.",

   "PREV_YEAR"    : "prethodna godina (držite pritisnuto za meni)",
   "PREV_MONTH"   : "prethodni mjesec (držite pritisnuto za meni)",
   "GO_TODAY"     : "današnji datum (držite pritisnuto za istoriju korištenja)",
   "NEXT_MONTH"   : "slijedeći mjesec (držite pritisnuto za meni)",
   "NEXT_YEAR"    : "slijedeća godina (držite pritisnuto za meni)",
   "SEL_DATE"     : "odaberite datum",
   "DRAG_TO_MOVE" : "pritisnite i vucite za premještanje kalendara",
   "PART_TODAY"   : " (danas)",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Prikaži dan %s prvi",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "zatvori",
   "TODAY"        : "danas",
   "TIME_PART"    : "Shift-klik ili pritisni i vuci za promjenu vrijednosti",

   // date formats
   "DEF_DATE_FORMAT"  : "%Y-%m-%d",
   "TT_DATE_FORMAT"   : "%a, %b %e",

   "WK"           : "sedmica",
   "TIME"         : "vrijeme:",
   "E_RANGE"      : "izvan opsega",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
