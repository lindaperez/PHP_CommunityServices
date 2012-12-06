// $Id: calendar-ua.js 8297 2007-09-26 09:58:04Z nmaxim $
﻿// ** I18N

// Calendar UA language
// Translation: Vasyl Zuzyak, <stk.zuzyak.vv@gmail.com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "ua"], {
  // full day names
  "_DN"  : new Array
           ("неділя",
 "понеділок",
 "вівторок",
 "середа",
 "четверг",
 "п'ятниця",
 "субота",
 "неділя"),
  // short day names
  "_SDN" : new Array
           ("нд",
 "пн",
 "вт",
 "ср",
 "чт",
 "пт",
 "сб",
 "нд"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
("Січень",
 "Лютий",
 "Березень",
 "Квітень",
 "Травень",
 "Червень",
 "Липень",
 "Серпень",
 "Вересень",
 "Жовтень",
 "Листопад",
 "Грудень"),
  // short month names
  "_SMN" : new Array
           ("січ",
 "лют",
 "бер",
 "кві",
 "тра",
 "чер",
 "лип",
 "сер",
 "вер",
 "жов",
 "лис",
 "грд"),
   // tooltips
   "INFO" : "Про календар...",
   "ABOUT": "DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"For latest version visit: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Як вибрати дату:\n" +
"- За допомогою кнопок \xab, \xbb можна вибрати рік\n" +
"- За допомогою кнопок " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " можна вибрати місяць\n" +
"- Утримуйте натиснутими ці кнопки, щоб з'явилося меню швидкого вибору.",
   "ABOUT_TIME" : "\n\n" +
"Як вибрати час:\n" +
"- При клацанні на годинах чи хвилинах вони збільшуються\n" +
"- при клацанні зі натиснутою клавішою Shift вони зменшуються\n" +
"- якщо нажати і рухати мишкою вліво або вправо, вони будуть змінюватися швидше.",

   "PREV_YEAR"    : "На рік назад (утримувати для меню)",
   "PREV_MONTH"   : "На місяць назад (утримувати для меню)",
   "GO_TODAY"     : "Сьогодні",
   "NEXT_MONTH"   : "На місяць вперед (утримувати для меню)",
   "NEXT_YEAR"    : "На рік вперед (утримувати для меню)",
   "SEL_DATE"     : "Виберіть дату",
   "DRAG_TO_MOVE" : "Перетягуйте мишкою",
   "PART_TODAY"   : " (сьогодні)",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Першим днем тижня буде %s",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "Закрити",
   "TODAY"        : "Сьогодні",
   "TIME_PART"    : "(Shift-)натискання або натиснути і перемістити",

   // date formats
   "DEF_DATE_FORMAT"  : "%Y-%m-%d",
   "TT_DATE_FORMAT"   : "%e %b, %a",

   "WK"           : "тжд",
   "TIME"         : "Час:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});



