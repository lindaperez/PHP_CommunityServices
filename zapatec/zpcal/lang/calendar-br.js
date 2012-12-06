// $Id: calendar-br.js 8274 2007-09-25 12:42:06Z nmaxim $
// ** I18N

// Calendar pt-BR language

Zapatec.Utils.createNestedHash(Zapatec, ["Langs", "Zapatec.Calendar", "br"], {
  // full day names
  "_DN"  : new Array
           ("Domingo",
 "Segunda",
 "Terça",
 "Quarta",
 "Quinta",
 "Sexta",
 "Sabádo",
 "Domingo"),
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
("Janeiro",
 "Fevereiro",
 "Março",
 "Abril",
 "Maio",
 "Junho",
 "Julho",
 "Agosto",
 "Setembro",
 "Outubro",
 "Novembro",
 "Dezembro");,
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
   "INFO" : "Sobre o calendário",
   "ABOUT": "DHTML Date/Time Selector\n" +
"(c) zapatec.com 2002-2007\n" + // don't translate this this ;-)
"For latest version visit: http://www.zapatec.com/\n" +
"This translation distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Translate to portuguese Brazil (pt-BR) by Fernando Dourado (fernando.dourado@ig.com.br)\n" +
"Tradução para o português Brasil (pt-BR) por Fernando Dourado (fernando.dourado@ig.com.br)" +
"\n\n" +
"Selecionar data:\n" +
"- Use as teclas \xab, \xbb para selecionar o ano\n" +
"- Use as teclas " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " para selecionar o mês\n" +
"- Clique e segure com o mouse em qualquer botão para selecionar rapidamente.",
   "ABOUT_TIME" : "\n\n" +
"Selecionar hora:\n" +
"- Clique em qualquer uma das partes da hora para aumentar\n" +
"- ou Shift-clique para diminuir\n" +
"- ou clique e arraste para selecionar rapidamente.",

   "PREV_YEAR"    : "Ano anterior (clique e segure para menu)",
   "PREV_MONTH"   : "Mês anterior (clique e segure para menu)",
   "GO_TODAY"     : "Ir para a data atual",
   "NEXT_MONTH"   : "Próximo mês (clique e segure para menu)",
   "NEXT_YEAR"    : "Próximo ano (clique e segure para menu)",
   "SEL_DATE"     : "Selecione uma data",
   "DRAG_TO_MOVE" : "Clique e segure para mover",
   "PART_TODAY"   : " (hoje)",

   // the following is to inform that "%s" is to be the first day of week
   // %s will be replaced with the day name.
   "DAY_FIRST"    : ""Exibir %s primeiro",

   // This may be locale-dependent.  It specifies the week-end days, as an array
   // of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
   // means Monday, etc.
   "WEEKEND"      : "0,6",

   "CLOSE"        : "Fechar",
   "TODAY"        : "Hoje",
   "TIME_PART"    : "(Shift-)Clique ou arraste para mudar o valor",

   // date formats
   "DEF_DATE_FORMAT"  : "%d/%m/%Y",
   "TT_DATE_FORMAT"   : "%d de %B de %Y",

   "WK"           : "sem",
   "TIME"         : "Hora:",
   "E_RANGE"      : "Outside the range",
   "_AMPM"        : {am : "am",
                     pm : "pm"}
});
