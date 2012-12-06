/*
 * Given two dates (in seconds) find out if date1 is bigger, date2 is bigger or
 * they're the same, taking only the dates, not the time into account.
 * In other words, different times on the same date returns equal.
 * returns -1 for date1 bigger, 1 for date2 is bigger 0 for equal
*/

function compareDatesOnly(date1, date2) {
    var year1 = date1.getYear();
    var year2 = date2.getYear();
    var month1 = date1.getMonth();
    var month2 = date2.getMonth();
    var day1 = date1.getDate();
    var day2 = date2.getDate();

    if (year1 > year2) {
        return -1;
    }
    if (year2 > year1) {
        return 1;
    }

    //years are equal
    if (month1 > month2) {
        return -1;
    }
    if (month2 > month1) {
        return 1;
    }

    //years and months are equal
    if (day1 > day2) {
        return -1;
    }
    if (day2 > day1) {
        return 1;
    }

    //days are equal
    return 0;

}

function timeOutOfRange(date) {
    
    if ((date.getDay() == 0) || (date.getDay() == 6)) { //No Sunday and Saturday
        return true;
    }

    //disable days prior to today
    var today = new Date();
    var compareToday = compareDatesOnly(date, today);
    if (compareToday > 0) {
        return(true);
    }

    //all other days are enabled
    return false;
}

var cal  = new  Zapatec.Calendar({
    firstDay          : 1,
    lang              : "sp",
    theme             : "fancyblue",
    showEffectSpeed   : 10,
    hideEffectSpeed   : 10,
    weekNumbers       : false,
    electric          : false,
    inputField        : "calendar",
    button            : "icon3",
    ifFormat          : "%d/%m/%Y",
    daFormat          : "%Y/%m/%d",
    dateStatusFunc    : timeOutOfRange
});	
		
 