

$(document).ready(function(){
  // initComponent(); /*initialisation des composants*/
});
  
/* Fonction d'initialisation des composants */
function initDatePicker(){

  var dateHolidays = ajax('holidays'); //["2021-03-24", '2020-11-02', '2020-11-15', '2020-12-25']; //feriados
  let daysOfWeekDisabled = ajax('daysoff'); // dias da semana off

  $('#datepicker-default').datepicker({ 
    language: "pt-BR",
    format: "d MM yyyy",
    startDate: '+0d',
    daysOfWeekDisabled: daysOfWeekDisabled,//daysOfWeekDisabled,
    autoclose : true ,
    todayBtn: true,
    maxViewMode: 1,
    multidate: false,
    todayHighlight : true
    // ,
    // beforeShowDay: function (d) {
    //                 let dmy = formatDate(d);
    //                 if(dateHolidays.indexOf(dmy) != -1) return false; return true;
    // }          
  });

  // inicar data com hoje
  $('#datepicker-default').datepicker("setDate", new Date());
}
  
  


function ajax(url){ 
  var xhr = new XMLHttpRequest();
  var result;

  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      result = xhr.response;
    }
  }

  xhr.open('GET', url +"?city="+ city.value, false);
  xhr.send();
  // console.log(result)
  return result;

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
addZeroData = (attr) => attr < 10 ? '0'+attr : attr
  
  
  
  
  
  