// $Id: calendar-eu.js 10294 2008-03-04 13:24:39Z mike $
// ** I18N

// Calendar SP language
// Author: Rafael Velasco <rvu_at_idecnet_dot_com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Zapatec.Calendar._DN = new Array
("Igandea",
 "Astelehena",
 "Asteartea",
 "Asteazkena",
 "Osteguna",
 "Ostirala",
 "Larunbata",
 "Igandea");

Zapatec.Calendar._SDN = new Array
("Iga",
 "As1",
 "As2",
 "As3",
 "Os1",
 "Os2",
 "Lar",
 "Iga");

// full month names
Zapatec.Calendar._MN = new Array
("Urtarrila",
 "Otsaila",
 "Martxoa",
 "Apirila",
 "Maiatza",
 "Ekaina",
 "Uztaila",
 "Abuztua",
 "Iraila",
 "Urria",
 "Azaroa",
 "Abendua");

// short month names
Zapatec.Calendar._SMN = new Array
("Urt",
 "Ots",
 "Mar",
 "Apr",
 "Mai",
 "Eka",
 "Uzt",
 "Abu",
 "Ira",
 "Urr",
 "aza",
 "Abe");

// tooltips
Zapatec.Calendar._TT_sp = Zapatec.Calendar._TT = {};
Zapatec.Calendar._TT["INFO"] = "Egutegiaren Informazioa";

Zapatec.Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"Bertsio berriak: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Daten Aukeraketa:\n" +
"- Erabili  \xab, \xbb urtea aukeratzeko\n" +
"- Erabili " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " hilabetea aukeratzeko\n" +
"- Sarbide azkarrerako goiko edozein opziotan mantendu saguaren botoia sakatuta.";
Zapatec.Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Erlojuaren aukeraketa:\n" +
"- Aukeratu ordua erlojua aldatzeko\n" +
"- edo sakatu Shift-click txikiagotxeko\n" +
"- edo sakatu click eta arrastratu sagua aukeraketa azkarrerako.";

Zapatec.Calendar._TT["PREV_YEAR"] = "Aurreko Urtea (Sakatu menurako)";
Zapatec.Calendar._TT["PREV_MONTH"] = "Aurreko Hilabetea (Sakatu menurako)";
Zapatec.Calendar._TT["GO_TODAY"] = "Gaurrera jo";
Zapatec.Calendar._TT["NEXT_MONTH"] = "Hurrengo Hilabetea (Sakatu menurako)";
Zapatec.Calendar._TT["NEXT_YEAR"] = "Hurrengo Urtea (Sakatu menurako)";
Zapatec.Calendar._TT["SEL_DATE"] = "Aukeratu Data";
Zapatec.Calendar._TT["DRAG_TO_MOVE"] = "Arrastratu eta Mugitu";
Zapatec.Calendar._TT["PART_TODAY"] = " (Gaur)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Zapatec.Calendar._TT["DAY_FIRST"] = "Erakutsi %s lehenik";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Zapatec.Calendar._TT["WEEKEND"] = "0,6";

Zapatec.Calendar._TT["CLOSE"] = "Itxi";
Zapatec.Calendar._TT["TODAY"] = "Gaur";
Zapatec.Calendar._TT["TIME_PART"] = "(Shift-)Click edo arrastratu balioa aldatxeko";

// date formats
Zapatec.Calendar._TT["DEF_DATE_FORMAT"] = "%dd-%mm-%yy";
Zapatec.Calendar._TT["TT_DATE_FORMAT"] = "%A, %e de %B de %Y";

Zapatec.Calendar._TT["WK"] = "Ast";
Zapatec.Calendar._TT["TIME"] = "Ordua:";

/* Preserve data */
	if(Zapatec.Calendar._DN) Zapatec.Calendar._TT._DN = Zapatec.Calendar._DN;
	if(Zapatec.Calendar._SDN) Zapatec.Calendar._TT._SDN = Zapatec.Calendar._SDN;
	if(Zapatec.Calendar._SDN_len) Zapatec.Calendar._TT._SDN_len = Zapatec.Calendar._SDN_len;
	if(Zapatec.Calendar._MN) Zapatec.Calendar._TT._MN = Zapatec.Calendar._MN;
	if(Zapatec.Calendar._SMN) Zapatec.Calendar._TT._SMN = Zapatec.Calendar._SMN;
	if(Zapatec.Calendar._SMN_len) Zapatec.Calendar._TT._SMN_len = Zapatec.Calendar._SMN_len;
	Zapatec.Calendar._DN = Zapatec.Calendar._SDN = Zapatec.Calendar._SDN_len = Zapatec.Calendar._MN = Zapatec.Calendar._SMN = Zapatec.Calendar._SMN_len = null
