// $Id: calendar-pt.js 8274 2007-09-25 12:42:06Z nmaxim $
// ** I18N

// Calendar pt_BR language
// Author: Adalberto Machado, <betosm@terra.com.br>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "pt"], {
  // full day names
  "_DN"  : new Array
           ("Domingo",
 "Segunda",
 "Terca",
 "Quarta",
 "Quinta",
 "Sexta",
 "Sabado",
 "Domingo"),
  // short day names
  "_SDN" : new Array
           ("Dom",
 "Seg",
 "Ter",
 "Qua",
 "Qui",
 "Sex",
 "Sab",
 "Dom"),
  // First day of the week. "0" means display Sunday first, "1" means display
  // Monday first, etc.
  "_FD"  : 0,
  // full month names
  "_MN"  : new Array
            ("Janeiro",
 "Fevereiro",
 "Marco",
 "Abril",
 "Maio",
 "Junho",
 "Julho",
 "Agosto",
 "Setembro",
 "Outubro",
 "Novembro",
 "Dezembro"),
  // short month names
  "_SMN" : new Array
           ("Jan",
 "Fev",
 "Mar",
 "Abr",
 "Mai",
 "Jun",
 "Jul",
 "Ago",
 "Set",
 "Out",
 "Nov",
 "Dez"),

// tooltips
"INFO": "Sobre o calendario",

"ABOUT":
"DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ,-)
"Ultima versao visite: http://www.zapatec.com\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Selecao de data:\n" +
"- Use os botoes \xab, \xbb para selecionar o ano\n" +
"- Use os botoes " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " para selecionar o mes\n" +
"- Segure o botao do mouse em qualquer um desses botoes para selecao rapida.",
"ABOUT_TIME": "\n\n" +
"Selecao de hora:\n" +
"- Clique em qualquer parte da hora para incrementar\n" +
"- ou Shift-click para decrementar\n" +
"- ou clique e segure para selecao rapida.",

"PREV_YEAR": "Ant. ano (segure para menu)",
"PREV_MONTH": "Ant. mes (segure para menu)",
"GO_TODAY": "Hoje",
"NEXT_MONTH": "Prox. mes (segure para menu)",
"NEXT_YEAR": "Prox. ano (segure para menu)",
"SEL_DATE": "Selecione a data",
"DRAG_TO_MOVE": "Arraste para mover",
"PART_TODAY": " (hoje)",

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
"DAY_FIRST": "Mostre %s primeiro",

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
"WEEKEND": "0,6",

"CLOSE": "Fechar",
"TODAY": "Hoje",
"TIME_PART": "(Shift-)Click ou arraste para mudar valor",

// date formats
"DEF_DATE_FORMAT": "%d/%m/%Y",
"TT_DATE_FORMAT": "%a, %e %b",

"WK": "sm",
"TIME": "Hora:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
