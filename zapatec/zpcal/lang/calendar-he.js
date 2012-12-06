// $Id: calendar-he.js 8297 2007-09-26 09:58:04Z nmaxim $
// ** I18N

// Calendar EN language
// Author: Idan Sofer, <idan@idanso.dyndns.org>
// Encoding: UTF-8
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "he"], {
  // full day names
  "_DN"  : new Array
          ("ראשון",
 "שני",
 "שלישי",
 "רביעי",
 "חמישי",
 "שישי",
 "שבת",
 "ראשון"),
  // short day names
  "_SDN" : new Array
           ("א",
 "ב",
 "ג",
 "ד",
 "ה",
 "ו",
 "ש",
 "א"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("ינואר",
 "פברואר",
 "מרץ",
 "אפריל",
 "מאי",
 "יוני",
 "יולי",
 "אוגוסט",
 "ספטמבר",
 "אוקטובר",
 "נובמבר",
 "דצמבר"),
  // short month names
  "_SMN" : new Array
           ("ינא",
 "פבר",
 "מרץ",
 "אפר",
 "מאי",
 "יונ",
 "יול",
 "אוג",
 "ספט",
 "אוק",
 "נוב",
 "דצמ"),
   // tooltips
   "INFO" : "אודות השנתון",
   "ABOUT": "בחרן תאריך/שעה DHTML\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"הגירסא האחרונה זמינה ב: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"בחירת תאריך:\n" +
"- השתמש בכפתורים \xab, \xbb לבחירת שנה\n" +
"- השתמש בכפתורים " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " לבחירת חודש\n" +
"- החזק העכבר לחוץ מעל הכפתורים המוזכרים לעיל לבחירה מהירה יותר.",
   "ABOUT_TIME" : "\n\n" +
"בחירת זמן:\n" +
"- לחץ על כל אחד מחלקי הזמן כדי להוסיף\n" +
"- או shift בשילוב עם לחיצה כדי להחסיר\n" +
"- או לחץ וגרור לפעולה מהירה יותר.",

   "PREV_YEAR"    : "שנה קודמת - החזק לקבלת תפריט",
   "PREV_MONTH"   : "חודש קודם - החזק לקבלת תפריט",
   "GO_TODAY"     : "עבור להיום",
   "NEXT_MONTH"   : "חודש הבא - החזק לתפריט",
   "NEXT_YEAR"    : "שנה הבאה - החזק לתפריט",
   "SEL_DATE"     : "בחר תאריך",
   "DRAG_TO_MOVE" : "גרור להזזה",
   "PART_TODAY"   : " )היום(",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "הצג %s קודם",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "6",

   "CLOSE"        :  "סגור",
   "TODAY"        : "היום",
   "TIME_PART"    : "(שיפט-)לחץ וגרור כדי לשנות ערך",

   // date formats
   "DEF_DATE_FORMAT"  : "%Y-%m-%d",
   "TT_DATE_FORMAT"   : "%a, %b %e",

   "WK"           : "wk",
   "TIME"         : "שעה::",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});


