
$(document).ready(function(){
  initComponent(); /*initialisation des composants*/
});
  
var dateHolidays = ['2020-11-02', '2020-11-15', '2020-12-25']; //feriados
let daysOfWeekDisabled = ["1","2"]; // dias da semana que estão off
  
/* Fonction d'initialisation des composants */
function initComponent(){
  
  $('#datepicker-default').datepicker({ 
    language: "pt-BR",
    format: "d MM yyyy",
    startDate: '+0d',
    // daysOfWeekDisabled: daysOfWeekDisabled,
    autoclose : true ,
    todayBtn: true,
    maxViewMode: 1,
    multidate: false,
    todayHighlight : true,
    beforeShowDay: function (d) {
                    let dmy = formatDate(d);
                    if(dateHolidays.indexOf(dmy) != -1) return false; return true;
    }          
  });
      
  // inicar data com hoje
  $('#datepicker-default').datepicker("setDate", dateToday(new Date()));
  
}
  
function dateToday(d){
  while( daysOfWeekDisabled.indexOf(d.getDay().toString()) != -1 || dateHolidays.indexOf(formatDate(d)) != -1){
    d = incrementDay(d)
  }
  return d
}
  
  function checkDisabledDays(d){
    return checkDisabledDays = daysOfWeekDisabled.indexOf(d.getDay().toString())
  }
  
  function incrementDay(d){
    return new Date( d.getTime() + (1 * 24 * 60 * 60 * 1000) )
  }
  
  function formatDate(d){
    return dmy = d.getFullYear() +'-'+ addZeroData(d.getMonth()+1)+'-'+ addZeroData(d.getDate());
  }
  
  // add zero(0) ao mês ou dia menores que 10
  function addZeroData(str) {return str < 10 ? '0'+str : str}
  
  function getDados(url){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status = 200){
                console.log(xhr.responseText);
            }
        }
        xhr.send();
    }
}
  
  
  
      // $('#datepicker-inline').datepicker({  
      //       language: "pt-BR",
      //       format: "d MM yyyy",
      //       startDate: '+0d',
      //       daysOfWeekDisabled: "1,2,5",
      //       todayBtn: "linked",
      //       maxViewMode: 1,
      //       autoclose : true,
      //       multidate: false,
      //       todayHighlight : true 
      // });
  
      // $('#text').change(function(){
      //     $('#datepicker-inline').datepicker('setDate', $(this).val());
      // });
      // $('#datepicker-inline').change(function(){
      //     $('#text').attr('value',$(this).val());
      // });
  
  
  
  
  
  
  
  
  