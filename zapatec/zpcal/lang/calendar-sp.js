// $Id: calendar-sp.js 8297 2007-09-26 09:58:04Z nmaxim $
// ** I18N

// Calendar SP language
// Author: Rafael Velasco <rvu_at_idecnet_dot_com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "sp"], {
  // full day names
  "_DN"  : new Array
           ("Domingo",
 "Lunes",
 "Martes",
 "Miercoles",
 "Jueves",
 "Viernes",
 "Sabado",
 "Domingo"),
  // short day names
  "_SDN" : new Array
           ("Dom",
 "Lun",
 "Mar",
 "Mie",
 "Jue",
 "Vie",
 "Sab",
 "Dom"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("Enero",
 "Febrero",
 "Marzo",
 "Abril",
 "Mayo",
 "Junio",
 "Julio",
 "Agosto",
 "Septiembre",
 "Octubre",
 "Noviembre",
 "Diciembre"),
  // short month names
  "_SMN" : new Array
           ("Ene",
 "Feb",
 "Mar",
 "Abr",
 "May",
 "Jun",
 "Jul",
 "Ago",
 "Sep",
 "Oct",
 "Nov",
 "Dic"),

// tooltips
"INFO": "Información del Calendario",

"ABOUT":
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
"Nuevas versiones en: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Selección de Fechas:\n" +
"- Use  \xab, \xbb para seleccionar el año\n" +
"- Use " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " para seleccionar el mes\n" +
"- Mantenga presionado el botón del ratón en cualquiera de las opciones superiores para un acceso rapido .",
"ABOUT_TIME": "\n\n" +
"Selección del Reloj:\n" +
"- Seleccione la hora para cambiar el reloj\n" +
"- o presione  Shift-click para disminuirlo\n" +
"- o presione click y arrastre del ratón para una selección rapida.",

"PREV_YEAR": "Año anterior (Presione para menu)",
"PREV_MONTH": "Mes Anterior (Presione para menu)",
"GO_TODAY": "Ir a Hoy",
"NEXT_MONTH": "Mes Siguiente (Presione para menu)",
"NEXT_YEAR": "Año Siguiente (Presione para menu)",
"SEL_DATE": "Seleccione fecha",
"DRAG_TO_MOVE": "Arrastre y mueva",
"PART_TODAY": " (Hoy)",

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
"DAY_FIRST": "Mostrar %s primero",

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
"WEEKEND": "0,6",

"CLOSE": "Cerrar",
"TODAY": "Hoy",
"TIME_PART": "(Shift-)Click o arrastra para cambar el valor",

// date formats
"DEF_DATE_FORMAT": "%dd-%mm-%yy",
"TT_DATE_FORMAT": "%A, %e de %B de %Y",

"WK": "Sm",
"TIME": "Hora:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});