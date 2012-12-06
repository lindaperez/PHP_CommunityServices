// $Id: calendar-big5.js 8295 2007-09-26 08:42:04Z nmaxim $
// ** I18N

// Calendar big5-utf8 language
// Author: Gary Fu, <gary@garyfu.idv.tw>
// Encoding: utf8
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "big5"], {
// full day names
"_DN" : new Array
("星期日",
 "星期一",
 "星期二",
 "星期三",
 "星期四",
 "星期五",
 "星期六",
 "星期日"),

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
("日",
 "一",
 "二",
 "三",
 "四",
 "五",
 "六",
 "日"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
// full month names
"_MN" : new Array
("一月",
 "二月",
 "三月",
 "四月",
 "五月",
 "六月",
 "七月",
 "八月",
 "九月",
 "十月",
 "十一月",
 "十二月"),

// short month names
"_SMN" : new Array
("一月",
 "二月",
 "三月",
 "四月",
 "五月",
 "六月",
 "七月",
 "八月",
 "九月",
 "十月",
 "十一月",
 "十二月"),

// tooltips
"INFO": "關於",

"ABOUT":
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
"For latest version visit: http://www.zapatec.com/\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"日期選擇方法:\n" +
"- 使用 \xab, \xbb 按鈕可選擇年份\n" +
"- 使用 " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " 按鈕可選擇月份\n" +
"- 按住上面的按鈕可以加快選取",
"ABOUT_TIME": "\n\n" +
"時間選擇方法:\n" +
"- 點擊任何的時間部份可增加其值\n" +
"- 同時按Shift鍵再點擊可減少其值\n" +
"- 點擊並拖曳可加快改變的值",

"PREV_YEAR": "上一年 (按住選單)",
"PREV_MONTH": "下一年 (按住選單)",
"GO_TODAY": "到今日",
"NEXT_MONTH": "上一月 (按住選單)",
"NEXT_YEAR": "下一月 (按住選單)",
"SEL_DATE": "選擇日期",
"DRAG_TO_MOVE": "拖曳",
"PART_TODAY": " (今日)",

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
"DAY_FIRST": "將 %s 顯示在前",

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
"WEEKEND": "0,6",

"CLOSE": "關閉",
"TODAY": "今日",
"TIME_PART": "點擊or拖曳可改變時間(同時按Shift為減)",

// date formats
"DEF_DATE_FORMAT": "%Y-%m-%d",
"TT_DATE_FORMAT": "%a, %b %e",

"WK": "週",
"TIME": "Time:",

   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
