// $Id: calendar-ru_win_.js 8201 2007-09-21 08:28:40Z nmaxim $
// ** I18N

// Calendar RU language
// Translation: Sly Golovanov, http://golovanov.net, <sly@golovanov.net>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.


Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "ru_win_"], {
  // full day names
  "_DN"  : new Array
      ("воскресенье","понедельник", "вторник", "среда", "четверг", "пятница", "суббота", "воскресенье"),
  // short day names
  "_SDN" : new Array
      ("вск", "пон", "втр", "срд", "чет", "пят", "суб", "вск"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
       ("январь",
       "февраль",
       "март",
       "апрель",
       "май",
       "июнь",
       "июль",
       "август",
       "сентябрь",
       "октябрь",
       "ноябрь",
       "декабрь"),
  // short month names
  "_SMN" : new Array
      ("янв",
       "фев",
       "мар",
       "апр",
       "май",
       "июн",
       "июл",
       "авг",
       "сен",
       "окт",
       "ноя",
       "дек"),
   // tooltips
   "INFO" : "О календаре...",
   "ABOUT": "DHTML Date/Time Selector\n" +
      "(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
      "For latest version visit: http://www.zapatec.com\n" +
      "This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
      "\n\n" +
      "Как выбрать дату:\n" +
      "- При помощи кнопок \xab, \xbb можно выбрать год\n" +
      "- При помощи кнопок " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " можно выбрать месяц\n" +
      "- Подержите эти кнопки нажатыми, чтобы появилось меню быстрого выбора.",
   "ABOUT_TIME" : "\n\n" +
          "Как выбрать время:\n" +
          "- При клике на часах или минутах они увеличиваются\n" +
          "- при клике с нажатой клавишей Shift они уменьшаются\n" +
          "- если нажать и двигать мышкой влево/вправо, они будут меняться быстрее.",

   "PREV_YEAR"    : "На год назад (удерживать для меню)",
   "PREV_MONTH"   : "На месяц назад (удерживать для меню)",
   "GO_TODAY"     : "Сегодня",
   "NEXT_MONTH"   : "На месяц вперед (удерживать для меню)",
   "NEXT_YEAR"    : "На год вперед (удерживать для меню)",
   "SEL_DATE"     : "Выберите дату",
   "DRAG_TO_MOVE" : "Перетаскивайте мышкой",
   "PART_TODAY"   : " (сегодня)",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Первый день недели будет %s",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "Закрыть",
   "TODAY"        : "Сегодня",
   "TIME_PART"    : "(Shift-)клик или нажать и двигать",

   // date formats
   "DEF_DATE_FORMAT"  : "%Y-%m-%d",
   "TT_DATE_FORMAT"   : "%e %b, %a",

   "WK"           : "нед",
   "TIME"         : "Время:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
