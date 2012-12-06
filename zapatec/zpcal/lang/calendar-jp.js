// $Id: calendar-jp.js 8295 2007-09-26 08:42:04Z nmaxim $
// ** I18N


Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "jp"], {
  // full day names
  "_DN"  : new Array
           ("日",
 "月",
 "火",
 "水",
 "木",
 "金",
 "土",
 "日"),
  // short day names
  "_SDN" : new Array
           ("San",
            "Mon",
            "Tue",
            "Wed",
            "Thu",
            "Fri",
            "Sat",
            "Sun"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("1月",
 "2月",
 "3月",
 "4月",
 "5月",
 "6月",
 "7月",
 "8月",
 "9月",
 "10月",
 "11月",
 "12月"),
  // short month names
  "_SMN" : new Array
           ("Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec"),
   // tooltips
   "INFO" : "About the calendar",
   "ABOUT": "DHTML Date/Time Selector\n" +
            "(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
            "For latest version visit: http://www.zapatec.com/\n" +
            "\n\n" +
            "Date selection:\n" +
            "- Use the \xab, \xbb buttons to select year\n" +
            "- Use the " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " buttons to select month\n" +
            "- Hold mouse button on any of the above buttons for faster selection.",
   "ABOUT_TIME" : "\n\n" +
                  "Time selection:\n" +
                  "- Click on any of the time parts to increase it\n" +
                  "- or Shift-click to decrease it\n" +
                  "- or click and drag for faster selection.",

   "TOGGLE" : "週の最初の曜日を切り替え",
   "PREV_YEAR"    : "前年",
   "PREV_MONTH"   : "前月",
   "GO_TODAY"     : "今日",
   "NEXT_MONTH"   : "翌月",
   "NEXT_YEAR"    : "翌年",
   "SEL_DATE"     : "日付選択",
   "DRAG_TO_MOVE" : "ウィンドウの移動",
   "PART_TODAY"   : " (今日)",
   "MON_FIRST" : "月曜日を先頭に",
   "SUN_FIRST" : "日曜日を先頭に",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Display %s first",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "閉じる",
   "TODAY"        : "今日",
   "TIME_PART"    : "(Shift-)Click or drag to change value",

   // date formats
   "DEF_DATE_FORMAT"  : "y-mm-dd",
   "TT_DATE_FORMAT"   : "%m月 %d日 (%a)",

   "WK"           : "週",
   "TIME"         : "Time:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
