/*
 * $Id: wizard.js 16942 2009-04-09 08:45:56Z vasyl $
 * The Zapatec DHTML Calendar
 *
 * Copyright (c) 2004-2009 by Zapatec, Inc.
 * http://www.zapatec.com
 * 1700 MLK Way, Berkeley, California,
 * 94709, U.S.A.
 * All rights reserved.
 *
 *
 * The Calendar Wizard. Collects preferences from the
 * user, creates a calendar, and generates the code.
 */

var wiz_path = Zapatec.getPath();
var utils = Zapatec.Utils;
var format_activeField = null;
var a_tabs = [];
var flat_calendar;
var wizard_address = document.URL;
var factory_formats = [ "%A, %B %d, %Y",
	"%a, %b %d, %Y",
	"%B %Y",
	"Day %j of year %Y (week %W)",
	"%Y/%m/%d",
	"%Y/%m/%d %I:%M %P",
	"%d-%m-%Y %H:%M"
];
function initWizard() {
	var i = 0, el;
	while (el = document.getElementById("tooltip-" + ++i))
		utils.addTooltip(el, "tooltip-" + i + "-text");
	initTabs();
	setSize('');
	format_activeField = document.getElementById("f_prop_ifFormat");

	//  var tables = document.getElementsByTagName("table"), i = 0, t;
	//  while (t = tables[i++]) {
	//    if (/form/i.test(t.className)) {
	//      var trs = t.getElementsByTagName("tr");
	//      for (var j = trs.length; --j >= 0;)
	//        addHoverEvents(trs[j]);
	//    }
	//  }

	//  var slashLoc = wizard_address.lastIndexOf('/');
	//  var dotLoc = wizard_address.lastIndexOf('.');
	//  if (dotLoc > slashLoc) {
	//    wizard_address = wizard_address.substr(0, slashLoc);
	//  }

	wizard_address = wizard_address.replace(/\/wizard\/.*/, '/');
	wizard_address = wizard_address.replace(/^https?:\/\/[^\/]+/, '');

	document.getElementById('f_path').value = wizard_address;

	/*flat_calendar = new Zapatec.Calendar(1, new Date(),
	 function(cal) { window.status = cal.date.print(cal.dateFormat); },
	 function(cal) {});
	 flat_calendar.noGrab = true;
	 flat_calendar.create();
	 flat_calendar.showAtElement(document.getElementById("calendar-anchor").firstChild, "Tl");
	 flat_calendar.onFDOW = onFDOW;
	 flat_calendar.onFDOW();*/

	flat_calendar = new Zapatec.Calendar({
		button			: document.getElementById("calendar-anchor").firstChild,
		firstDay		 : 1,
		date			  : new Date(),
		align			 : "Tl",
		onFDOW			: onFDOW,
		noGrab			: true,
		onSelect		 : function() {
			window.status = Zapatec.Date.print(this.config.date, this.dateFormat);
		},
		theme			 : 'winter',
		showAfterCreation : true,
		showEffectSpeed: 10,
		hideEffectSpeed: 10
	});


	initFactoryFormats();
}
;

function initFactoryFormats() {
	var factory = ["f_prop_ifFormat-factory", "f_prop_daFormat-factory"];
	var date = new Date();
	for (var i = factory.length; --i >= 0;) {
		var id = factory[i];
		var sel = document.getElementById(id);
		while (sel.options[1])
			sel.remove(1);
		for (var j = 0; j < factory_formats.length; ++j) {
			var format = factory_formats[j];
			var o = document.createElement("option");
			o.innerHTML = Zapatec.Date.print(date, format);
			o.value = format;
			sel.appendChild(o);
		}
	}
}
;

function addHoverEvents(el) {
	el.onmouseover = HE_onMouseOver;
	el.onmouseout = HE_onMouseOut;
}
;

function HE_onMouseOver(ev) {
	ev || (ev = window.event);
	if (!utils.isRelated(this, ev))
		utils.addClass(this, "hover");
}
;

function HE_onMouseOut(ev) {
	ev || (ev = window.event);
	if (!utils(this, ev))
		utils.removeClass(this, "hover");
}
;

function onFDOW(fdow) {
	if (typeof fdow == "undefined")
		fdow = this.firstDayOfWeek;
	var sel = document.getElementById("f_prop_firstDayOfWeek");
	utils.selectOption(sel, fdow);
}
;

function initTabs() {
	var bar = document.getElementById("tab-bar");
	var tabs = document.getElementById("tabs");
	tabs.style.display = 'block';
	var tmp;
	var current = null;
	for (var i = tabs.firstChild; i; i = i.nextSibling) {
		if (i.nodeType != 1)
			continue;
		a_tabs[a_tabs.length] = (tmp = utils.createElement("a", bar));
		//tmp.id = tmp.href = "#pane-" + a_tabs.length;
		tmp.href = "#";
		tmp.innerHTML = "<u>" + (a_tabs.length) + "</u>. <span class='bullet'>»</span>";
		tmp.accessKey = "" + (a_tabs.length);
		tmp.theSpan = i.firstChild;
		tmp.theSpan.action = tmp.theSpan.onclick;
		tmp.theSpan.onclick = "";
		tmp.appendChild(i.firstChild);
		if (!/hide/.test(i.className))
			(current = tmp).className = "active";
		tmp.onclick = changeTab;
		tmp.__msh_tab = i;

		// check if it has advanced stuff
		var cl = tmp.theSpan.className;
		if (/([^\s]+-advanced-)(.*)/.test(cl)) {
			tmp.hasAdvanced = true;
			tmp.advanced_id_prefix = RegExp.$1;
			tmp.advanced_id_suffix = RegExp.$2.split(/-/);
			tmp.advanced = false;
		} else
			tmp.hasAdvanced = false;
	}
	if (current)
		current.onclick();
}
;

function changeTab() {
	var i = 0, tab;
	while (tab = a_tabs[i++]) {
		utils.removeClass(tab, "active");
		if (tab === this)
			tab.__msh_tab.style.display = "block";
		else
			tab.__msh_tab.style.display = "none";
	}
	utils.addClass(this, "active");
	document.getElementById("b_prev").disabled = !this.previousSibling;
	document.getElementById("b_next").disabled = !this.nextSibling;
	if (typeof this.theSpan.action == "function")
		this.theSpan.action();
	else if (typeof this.theSpan.action == "string")
		eval(this.theSpan.action);
	updateAdvanced(this);
	this.blur();
	return false;
}
;

function getCurrentTab() {
	var tab = null;
	for (var i = a_tabs.length; --i >= 0;) {
		tab = a_tabs[i];
		if (/active/.test(tab.className))
			break;
	}
	return tab;
}
;

function nextTab() {
	var tab = getCurrentTab();
	if (tab && tab.nextSibling)
		tab.nextSibling.onclick();
}
;

function prevTab() {
	var tab = getCurrentTab();
	if (tab && tab.previousSibling)
		tab.previousSibling.onclick();
}
;

function setActiveTheme(sel) {
	flat_calendar.config.theme = sel.value;
	flat_calendar.refresh();
}
;

function setSize(val) {
	if (flat_calendar) {
		flat_calendar.config.themeSize = val;
		flat_calendar.refresh();
	}
}
;

function selectChange(sel) {
	switch (sel.id) {
		case "f_theme":
			setActiveTheme(sel);
			break;
		case "f_language":
			flat_calendar.config.lang = sel.value;
			flat_calendar.refresh();
			break;

		case "f_effectsShow":
			flat_calendar.config.showEffect = sel.value;
			flat_calendar.refresh();
			break;

		case "f_effectsHide":
			flat_calendar.config.hideEffect = sel.value;
			flat_calendar.refresh();
			break;
	}
}
;

function propChange(el) {
	switch (el.id) {
		case "f_prop_showsTime":
			flat_calendar.config.showsTime = el.checked;
			document.getElementById("timeprops1").style.visibility = el.checked ? "visible" : "hidden";
			document.getElementById("timeprops2").style.visibility = el.checked ? "visible" : "hidden";
			break;

		case "f_prop_timeFormat":
			flat_calendar.config.time24 = el.value == "24";
			break;

		case "f_prop_firstDayOfWeek":
			flat_calendar.setFirstDayOfWeek(parseInt(el.value, 10));
			return;	// no need to refresh

		case "f_prop_weekNumbers":
			flat_calendar.config.weekNumbers = el.checked;
			break;

		case "f_prop_showOthers":
			flat_calendar.config.showsOtherMonths = el.checked;
			break;

		case "f_prop_yearStep":
			flat_calendar.config.step = parseInt(el.value, 10);
			return;	// no need to refresh

		case "f_prop_timeInterval":
			flat_calendar.config.timeInterval = parseInt(el.value, 10) || null;
			break;

		//multiple months related variables
		case "f_prop_numberMonths":
			flat_calendar.config.numberMonths = parseInt(el.value, 10);
		//check that controlmonth is not bigger than numberMonths
			if (flat_calendar.config.controlMonth > flat_calendar.config.numberMonths) {
				//If it is, set it to last month
				flat_calendar.config.controlMonth = flat_calendar.config.numberMonths;
				document.getElementById("f_prop_controlMonth").value = flat_calendar.config.controlMonth;
			}
			var monthsInRow = parseInt(document.getElementById("f_prop_monthsInRow").value, 10);
			if (isNaN(monthsInRow)) {//It's blank
				flat_calendar.config.monthsInRow = flat_calendar.config.numberMonths;
			}
			if (flat_calendar.config.monthsInRow > flat_calendar.config.numberMonths) {
				flat_calendar.config.monthsInRow = flat_calendar.config.numberMonths;
				document.getElementById("f_prop_monthsInRow").value = flat_calendar.config.monthsInRow;
			}
			break;

		case "f_prop_controlMonth":
			flat_calendar.config.controlMonth = parseInt(el.value, 10);
		//check that controlmonth is not bigger than numberMonths
			if (flat_calendar.config.controlMonth > flat_calendar.config.numberMonths) {
				//If it is, set it to last month
				alert("Control month can't be larger than number of months");
				flat_calendar.config.controlMonth = flat_calendar.config.numberMonths;
				document.getElementById("f_prop_controlMonth").value = flat_calendar.config.controlMonth;
			}
			break;

		case "f_prop_monthsInRow":
			var monthsInRow = parseInt(el.value, 10);
			if (isNaN(monthsInRow)) {//It's blank
				monthsInRow = flat_calendar.config.numberMonths;
			}
			flat_calendar.config.monthsInRow = monthsInRow;
			if (flat_calendar.config.monthsInRow > flat_calendar.config.numberMonths) {
				alert("Months In a Row can't be larger than number of months");
				flat_calendar.config.monthsInRow = flat_calendar.config.numberMonths;
				document.getElementById("f_prop_monthsInRow").value = flat_calendar.config.monthsInRow;
			}
			break;

		case "f_prop_vertical":
			flat_calendar.config.vertical = el.checked;
			break;

		case "f_prop_effectsShowSpeed":
			flat_calendar.config.showEffectSpeed = el.value;
			break;

		case "f_prop_effectsHideSpeed":
			flat_calendar.config.hideEffectSpeed = el.value;
			break;

	}
	flat_calendar.refresh();
}
;

function format_setActiveField(input) {
	format_activeField = input;
}
;

function tokenClicked(link, token) {
	var v = format_activeField.value;
	if (/\b$/.test(v))
		v += " ";
	v += token;
	format_activeField.value = v;
	link.blur();
	format_activeField.focus();
	format_updateTests();
	return false;
}
;

function clear_field(el) {
	if (typeof el == "string")
		el = document.getElementById(el);
	el.value = '';
	el.focus();
}
;

function radioTabChange(r) {
	var tabs_id = "tab-" + r.name;
	var id = r.name + "-" + r.value;
	var tabs = document.getElementById(tabs_id);
	for (var i = tabs.firstChild; i; i = i.nextSibling) {
		if (i.nodeType != 1)
			continue;
		i.style.display = i.id == id ? "block" : "none";
	}
}
;

function testAlign(btn) {
	var cal = new Zapatec.Calendar({
		firstDay		 : 1,
		date			  : new Date(),
		onClose		  : function() {
			this.destroy();
		},
		onSelect		 : function() {
			this.destroy();
		},
		align			 : document.getElementById("f_prop_valign").value + document.getElementById("f_prop_halign").value,
		button			: btn
	});
}
;

function makeConfigObj() {
	window.calendarConfig = {
		lang				  : document.getElementById("f_language").value,
		theme				 : document.getElementById("f_theme").value,
		themeSize			: document.getElementById("f_size").value,
		showEffect		  : document.getElementById("f_effectsShow").value,
		showEffectSpeed	: document.getElementById("f_prop_effectsShowSpeed").value,
		hideEffect		  : document.getElementById("f_effectsHide").value,
		hideEffectSpeed	: document.getElementById("f_prop_effectsHideSpeed").value,

		// generic
		firstDay			 : document.getElementById("f_prop_firstDayOfWeek").value,
		weekNumbers		 : document.getElementById("f_prop_weekNumbers").checked,
		showOthers		  : document.getElementById("f_prop_showOthers").checked,
		showsTime			: document.getElementById("f_prop_showsTime").checked,
		timeFormat		  : document.getElementById("f_prop_timeFormat").value,
		step				  : document.getElementById("f_prop_yearStep").value,
		electric			 : document.getElementById("f_prop_electric").checked,
		range				 : ( document.getElementById("f_prop_rangeLeft").value + '.' +
									 document.getElementById("f_prop_rangeLeft_Month").value + ', ' +
									 document.getElementById("f_prop_rangeRight").value + '.' +
									 document.getElementById("f_prop_rangeRight_Month").value ),
		ifFormat			 : document.getElementById("f_prop_ifFormat").value,
		daFormat			 : document.getElementById("f_prop_daFormat").value,
		singleClick		 : !document.getElementById("f_prop_dblclick").checked,
		timeInterval		 : document.getElementById("f_prop_timeInterval").value,

		// popup calendars
		inputField		  : document.getElementById("f_prop_inputField").value,
		displayArea		 : document.getElementById("f_prop_displayArea").value,
		button				: document.getElementById("f_prop_button").value,
		align				 : ( document.getElementById("f_prop_valign").value +
									 document.getElementById("f_prop_halign").value ),

		// Multiple months
		numberMonths				 : document.getElementById("f_prop_numberMonths").value,
		controlMonth				 : document.getElementById("f_prop_controlMonth").value,
		monthsInRow				 : document.getElementById("f_prop_monthsInRow").value,
		vertical				 : document.getElementById("f_prop_vertical").checked,

		// flat calendars
		flat				  : document.getElementById("f_prop_flat").value,
		flatCallback		: document.getElementById("f_prop_flatCallback").value

	};
	return window.calendarConfig;
}

function makeCode(test) {
	var c = makeConfigObj();
	var html = "<html>\n";
	var path = test ? wizard_address : document.getElementById('f_path').value;
	path = path.replace(/\/*$/, '/');

	function comment(txt) {
		html += "<!-- " + txt + " -->\n";
	}
	;

	html += "  <head>\n\n";
	comment("UTF-8 is the recommended encoding for your pages");
	html += '    <meta http-equiv="content-type" content="text/xml; charset=utf-8" />\n';
	html += '    <title>Zapatec DHTML Calendar</title>\n\n';

	comment("Loading Calendar JavaScript files");
	html += '    <script type="text/javascript" src="' + path + '../utils/zapatec.js"></script>\n';
	html += '    <script type="text/javascript" src="' + path + '../utils/zpdate.js"></script>\n';
	html += '    <script type="text/javascript" src="' + path + 'src/calendar.js"></script>\n';

	comment("Loading language definition file");
	html += '    <script type="text/javascript" src="' + path + 'lang/calendar-' + c.lang + '.js"></script>\n\n';

	html += '  </head>\n';
	html += '  <body>\n\n';

	html += '<!-- CUT THIS LINE --><h1>Test your calendar</h1>\n';
	html += '<!-- CUT THIS LINE --><blockquote>\n';

	function beginScript() {
		html += '    <script type="text/javascript">//<![CDATA[\n';
	}
	;

	function endScript() {
		html += '    //]]></script>\n';
		html += '<noscript>\n';
		html += '<br/>\n';
		html += 'This page uses a <a href="http://www.zapatec.com/website/main/products/prod1/"> Javascript Calendar </a>, but\n';
		html += 'your browser does not support Javascript. \n';
		html += '<br/>\n';
		html += 'Either enable Javascript in your Browser or upgrade to a newer version.\n';
		html += '</noscript>\n';
	}
	;

	function beginCommonCalendarSetup() {
		beginScript();
		html += '/* CUT THIS LINE */ window.onload = function() {\n';
		html += 'var cal  = new  Zapatec.Calendar({\n';
		if (c.firstDay != 0) {
			html += '        firstDay          : ' + c.firstDay + ',\n';
		}
		if (c.lang != 0) {
			html += '        lang             : "' + c.lang + '",\n';
		}
		if (c.theme != 0) {
			html += '        theme             : "' + c.theme + '",\n';
		}
		if (c.themeSize != 0) {
			html += '        themeSize         : "' + c.themeSize + '",\n';
		}
		if (c.showEffect != 0) {
			html += '        showEffect        : "' + c.showEffect + '",\n';
		}
		if (c.showEffectSpeed != 0) {
			html += '        showEffectSpeed   : ' + c.showEffectSpeed + ',\n';
		}
		if (c.hideEffect != 0) {
			html += '        hideEffect        : "' + c.hideEffect + '",\n';
		}
		if (c.hideEffectSpeed != 0) {
			html += '        hideEffectSpeed   : ' + c.hideEffectSpeed + ',\n';
		}
		if (c.weekNumbers != true) {
			html += '        weekNumbers       : ' + c.weekNumbers + ',\n';
		}
		if (c.showOthers != false) {
			html += '        showOthers        : ' + c.showOthers + ',\n';
		}
		if (c.showsTime != false) {
			html += '        showsTime         : ' + c.showsTime + ',\n';
		}
		if (c.timeFormat != "24") {
			html += '        timeFormat        : "' + c.timeFormat + '",\n';
		}
		if (c.step != 2) {
			html += '        step              : ' + c.step + ',\n';
		}
		if (c.range != "1900.01, 2999.12") {
			html += '        range             : [' + c.range + '],\n';
		}
		//multiple months
		if (c.numberMonths > 1) {
			html += '        numberMonths          : ' + c.numberMonths + ',\n';
			if (c.controlMonth > 1) {
				html += '        controlMonth          : ' + c.controlMonth + ',\n';
			}
			if (c.monthsInRow != "") {
				html += '        monthsInRow          : ' + c.monthsInRow + ',\n';
			}
			if (c.vertical != false) {
				html += '        vertical          : ' + c.vertical + ',\n';
			}
		}
		if (c.align != "Br") {
			html += '        align             : "' + c.align + '"\n';
		}


	}
	;

	function endCommonCalendarSetup() {
		html += '      });\n';
		html += '/* CUT THIS LINE */ };\n';
		endScript();
		html += '<br><a href="http://www.zapatec.com/website/main/products/prod1/">Zapatec Javascript Calendar</a><br>\n';
	}
	;

	if (document.getElementById("r_popup").checked) {
		// generating a popup calendar
		if (!c.inputField && !c.displayArea && !c.button) {
			comment("ERROR: none of the input field, display area or trigger button\n" +
					  "properties are defined. Please go back to step 1 (вЂњTypeвЂќ)\n" +
					  "and define at least one of them.");
		} else {
			if (c.inputField)
				html += '    <input type="' + (c.displayArea ? "hidden" : "text") + '"' +
						  ' id="' + c.inputField + '" name="' + c.inputField + '" />\n';
			if (c.displayArea)
				if (c.button)
					html += '    <div style="border: 1px solid #000; padding: 2px 5px;" id="' +
							  c.displayArea + '">Select date</div>\n';
				else
					html += '    <a href="#" id="' + c.displayArea + '">Select date</a>\n';
			if (c.button)
				html += '    <button id="' + c.button + '">...</button>\n';
			beginCommonCalendarSetup();
			if (c.electric != true) {
				html += '        electric          : ' + c.electric + ',\n';
			}
			if (c.singleClick != true) {
				html += '        singleClick       : ' + c.singleClick + ',\n';
			}
			if (c.inputField)
				html += '        inputField        : "' + c.inputField + '",\n';
			if (c.displayArea)
				html += '        displayArea       : "' + c.displayArea + '",\n';
			if (c.button)
				html += '        button            : "' + c.button + '",\n';
			if (c.ifFormat)
				html += '        ifFormat          : "' + c.ifFormat + '",\n';
			if (c.daFormat)
				html += '        daFormat          : "' + c.daFormat + '",\n';
			if (c.timeInterval !== "") {
				html += '        timeInterval          : ' + c.timeInterval + ',\n';
			}

			// trim any trailing comma with optional white space
			// fixes error with empty object contents if just a trailing comma
			html = html.replace(/,(\s?)+$/, "\n");

			endCommonCalendarSetup();
		}
	} else {
		// generating a flat calendar
		if (!c.flat || !c.flatCallback) {
			comment("ERROR: you did not specify the container ID and/or\n" +
					  "the flat callback function name.  Please go back to\n" +
					  "step 1 (вЂњTypeвЂќ) and make sure they are defined.");
		} else {
			comment("The following empty element is the container for the calendar.\n" +
					  "It has the ID that you defined at step 1 (в__Typeв__).\n" +
					  "When вЂњCalendar.setupвЂќ is called below, the calendar will be generated\n" +
					  "in this element.  Feel free to position it the way you want\n" +
					  "using CSS.  You will normally want this to be a floating element\n" +
					  "which is why we generated one having the style в__float: rightв__.");

			html += "\n";
			html += '<div style="float: right; margin: 0 0 1em 1em" id="' + c.flat + '"></div>\n\n';

			comment("The following JavaScript code defines a function that will\n" +
					  "get called each time the user modifies the date inside the calendar.\n" +
					  "To make sure that a date was actually clicked, we check the\n" +
					  "cal.dateClicked variable.  If a date wasn't clicked this will be\n" +
					  "вЂњfalseвЂќ and it usually means that the date was modified using the\n" +
					  "month or year navigation buttons, or that only the time got modified.");
			html += "\n";
			// generating the flat callback function
			beginScript();
			html += '      function ' + c.flatCallback + '(cal) {\n';
			html += '        if (cal.dateClicked) {\n';
			html += '          var url = "http://www.mydomain.com/" + Zapatec.Date.print(cal.config.date, "%Y/%m/%d/");\n';
			html += '          alert("Jumping to: ў__" + url + "ў__ (not really).");\n';
			html += '          // uncomment the following line to actually jump:\n';
			html += '          // window.location = url;\n';
			html += '        }\n';
			html += '      };\n';
			endScript();

			html += "\n";

			beginCommonCalendarSetup();
			html += '        flat              : "' + c.flat + '",\n';
			html += '        flatCallback      : ' + c.flatCallback + '\n';
			endCommonCalendarSetup();
		}
	}

	html += '<!-- CUT THIS LINE --></blockquote>\n';

	html += '<!-- CUT THIS LINE --><blockquote>If you are not happy with the result, go back to the ' +
			  'wizard and configure more options.  Otherwise, go back to the wizard, copy the code ' +
			  'displayed in the ў__Generateў__ tab and insert it into your own application.</blockquote>\n';

	html += '<!-- CUT THIS LINE --><p>' +
			  '<a href="javascript:window.close()">close this window</a></p>\n';

	html += '\n  </body>\n';
	html += '</html>\n';

	return html;
}
;

function onGenerate() {
	var ta = document.getElementById("code");
	var html = makeCode(false);

	ta.value = code_removeCuts(html);

	setTimeout(function() {
		ta.focus();
		if (!ta.__msh_positioned) {
			ta.style.height = ta.parentNode.parentNode.parentNode.offsetHeight - 200 + "px";
			ta.__msh_positioned = true;
		}
	}, 100);
}
;

function selectCode() {
	var ta = document.getElementById("code");
	ta.focus();
	ta.select();
}
;

function code_removeCuts(text) {
	return text.replace(/(\/\*|<!--)\s*CUT.THIS.LINE\s*(\*\/|-->).*\n/ig, '');
}
;

function testCode() {
	var
		HM = 300,
		WM = 400,
		h = screen.height - HM,
		w = screen.width - WM;
	makeConfigObj();
	var win = window.open(wiz_path + "test.html", "TESTCAL",
		"width=" + w + ",height=" + h + ",left=" + Math.round(WM / 2) + ",top=" + Math.round(HM / 2) + ",toolbar=no," +
		"menubar=no,directories=no,channelmode=no,resizable=yes,scrollbars=yes");
	win.focus();
}
;

function updateAdvanced(tab) {
	var ab = document.getElementById("b_advanced");
	ab.style.visibility = tab.hasAdvanced ? "visible" : "hidden";
	if (tab.hasAdvanced)
		ab.innerHTML = tab.advanced ? "Hide advanced options" : "Show advanced options";
}
;

function advanced() {
	var tab = getCurrentTab();
	if (tab.hasAdvanced) {
		tab.advanced = ! tab.advanced;
		var id = tab.advanced_id_prefix;
		var a = tab.advanced_id_suffix;
		var vis = tab.advanced ? "visible" : "hidden";
		for (var i = a.length; --i >= 0;)
			document.getElementById(id + a[i]).style.visibility = vis;
		updateAdvanced(tab);
	} else
		alert("No advanced stuff in this tab");
}
;

function format_updateTests() {
	var date = new Date();
	var f1 = document.getElementById("f_prop_ifFormat");
	var t1 = document.getElementById(f1.id + "-test");
	var f2 = document.getElementById("f_prop_daFormat");
	var t2 = document.getElementById(f2.id + "-test");

	if (!f1.value)
		t1.innerHTML = "[empty format]";
	else
		t1.innerHTML = Zapatec.Date.print(date, f1.value);

	if (!f2.value)
		t2.innerHTML = "[empty format]";
	else
		t2.innerHTML = Zapatec.Date.print(date, f2.value);
}
;

function format_keyPress(field) {
	var factory = document.getElementById(field.id + "-factory");
	if (factory)
		utils.selectOption(factory, "");
	setTimeout(function() {
		format_updateTests();
	}, 10);
}
;

function factoryFormat(sel) {
	if (sel.value) {
		var id = sel.id.replace(/-factory$/, '');
		var field = document.getElementById(id);
		field.value = sel.value;
		format_updateTests();
	}
}
;

function setWizardPath(newAddress) {
	wizard_address = newAddress;
	document.getElementById('f_path').value = newAddress;
}
