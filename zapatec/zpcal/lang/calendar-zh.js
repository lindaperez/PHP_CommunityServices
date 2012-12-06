// $Id: calendar-zh.js 8295 2007-09-26 08:42:04Z nmaxim $
// ** Translated by ATang ** I18N

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "zh"], {
  // full day names
  "_DN"  : new Array
           ("–«∆⁄»’",
 "–«∆⁄“>",
 "–«∆⁄∂˛",
 "–«∆⁄»˝",
 "–«∆⁄Àƒ",
 "–«∆⁄ŒÂ",
 "–«∆⁄¡˘",
 "–«∆⁄»’"),
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
            ("“>‘¬",
 "∂˛‘¬",
 "»˝‘¬",
 "Àƒ‘¬",
 "ŒÂ‘¬",
 "¡˘‘¬",
 "∆ﬂ‘¬",
 "∞À‘¬",
 "_≈‘¬",
 " R‘¬",
 " R“>‘¬",
 " R∂˛‘¬"),
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

   "TOGGLE" : "«–>>÷‹ø™ _˜ƒ“>ÃÏ",
   "PREV_YEAR"    : "…œ“>ƒÍ (∞_◊°_ˆ_À˜_)",
   "PREV_MONTH"   : "…œ“>‘¬ (∞_◊°_ˆ_À˜_)",
   "GO_TODAY"     : "˜__Ò»’",
   "NEXT_MONTH"   : "œ¬“>‘¬ (∞_◊°_ˆ_À˜_)",
   "NEXT_YEAR"    : "œ¬“>ƒÍ (∞_◊°_ˆ_À˜_)",
   "SEL_DATE"     : "—°‘Ò»’∆⁄",
   "DRAG_TO_MOVE" : "Õœ∂Ø",
   "PART_TODAY"   : " (_Ò»’)",
   "MON_FIRST" : " ◊œ»œ‘ _–«∆⁄“>",
   "SUN_FIRST" : " ◊œ»œ‘ _–«∆⁄»’",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : "Display %s first",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "πÿ+’",
   "TODAY"        : "_Ò»’",
   "TIME_PART"    : "(Shift-)Click or drag to change value",

   // date formats
   "DEF_DATE_FORMAT"  : "%Y-%m-%d",
   "TT_DATE_FORMAT"   : "%a, %b %e",

   "WK"           : "÷‹",
   "TIME"         : "Time:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
