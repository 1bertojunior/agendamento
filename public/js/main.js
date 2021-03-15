function getTheme(){
    const prefersColorScheme = window.matchMedia('(prefers-color-scheme: dark)');
    
    if( prefersColorScheme.matches ) {
        alert('Dark') // O tema é o dark
    } else {
        alert('!Dark') // O tema é o light
    }
}

var meses = [
    "Janeiro",
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
    "Dezembro"
];

function addZero(n){
    if (n <= 9) return "0" + n;
    return n; 
}

// ## FORMATAR
function formateHours(d){
    return addZero(d.getHours()) +":"+ addZero(d.getMinutes()) +":"+ addZero(d.getSeconds());
}

function formatarData(data) {
    data = data.split(" ")
    data.reverse()
    data[1] = meses.indexOf(data[1], [i = 0])+1
    data = data.join('-')
    data = new Date(data)
    // //addzero
    data = data.getFullYear() +"-"+ addZero((data.getMonth()+1)) +"-"+ addZero(data.getDate().toString())
    
    return data
}

function formatarData3(d){
    return d.getDate() +" "+ meses[d.getMonth()] +" "+ d.getFullYear();
}

function formatDate(d, m){
    return m == 1 ? d.getDate() +'/'+ (d.getMonth())+1 +'/'+ d.getFullYear() : d.getHours()+':'+d.getMinutes();
}


// ## FORMATAR

//## GET
// pegar data
function getDateSelected(){
    let date = document.querySelector("#datepicker-default");
    date = formatarData(date.value)
    return date;
}

// get city
function getCitySelected(){
    var city = document.getElementById('city');
    city = city.options[city.selectedIndex].value;
    return city;
}


// ## GET


// ## AJAX
function ajaxSchedules(id){
    let ajax = new XMLHttpRequest();
    //conexão estabelecida com o servidor = state = 1
    ajax.open('GET', '/admin/getdatabyid?id='+id);

    //progresso da requisição
    ajax.onreadystatechange = () => {
      // requisição finalizada
      if(ajax.readyState == 4 && ajax.status == 200){
        var scheduling = JSON.parse(ajax.responseText) //arr horarios convertido em JSON
        if(scheduling != "undefined "){
          addValueModal('#modal-vizualizar #idDados',scheduling['id'])
          addValueModal('#modal-vizualizar #cityDados',scheduling['city'])
          addValueModal('#modal-vizualizar #nameDados',scheduling['name'])
          addValueModal('#modal-vizualizar #surnameDados',scheduling['surname'])
          addValueModal('#modal-vizualizar #phoneDados',scheduling['phone'])
          addValueModal('#modal-vizualizar #serviceDados',scheduling['service'])
          addValueModal('#modal-vizualizar #dateDados',scheduling['start'])
          addValueModal('#modal-vizualizar #hourDados',scheduling['end'])
          addValueModal('#modal-vizualizar #createdDados',scheduling['created'])
        }
        
      }
      
      if(ajax.readyState == 4 && ajax.status == 404) console.log('STRF_status: 404') //error

    }

    ajax.send()
}



//## MANIPULAR HTML 
function addValueModal(id, value, o=false){
    var div = document.querySelector(id);  //document.getElementById(id);
    o ? div.value = value :  div.innerHTML = value;
}

// ## FULLCALENDAR
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar'); //getCitySelected();
    const city = document.getElementById('city');
    var dados;
    
    initCalendar(city.value)

    function initCalendar(city=1){
      var calendar = new FullCalendar.Calendar(calendarEl, {
      //initialDate: '2021-02-14',
        locale: 'pt-br',
        initialView: 'timeGridDay', //iniciar com o dia
        nowIndicator: true, //exibir um marcador indicando a hora atual.
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },

        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        dayMaxEvents: false, // allow "more" link when too many events
        allDaySlot: false, // disable All Day Event #desabilitar evento durante todo o dia
        slotDuration: '00:30',
        slotMinTime: "08:00:00",
        slotMaxTime: "21:00:00",
        // stickyFooterScrollbar: true,

        businessHours: {
          // days of week. an array of zero-based day of week integers (0=Sunday)
          daysOfWeek: [ 1, 2, 3, 4, 5, 6, 7], // Monday - Thursday

          startTime: '08:00', // a start time (10am in this example)
          endTime: '20:00', // an end time (6pm in this example)
        },  
        
        events: '/listEvents?city='+city,
        extraParams: function() {
          return {
              cachebuster: new Date().valueOf()
          };
        },

        //click in event exists and open the modal
        eventClick: function(info) {
          ajaxSchedules(info.event.id)

          var myModal = new bootstrap.Modal(document.getElementById('visualizar'))
          myModal.show()    
        
        },

        //click in event
        selectTable: true,
        select: function(info){
          addValueModal('#modal-cadastrar #datepicker-default', formatarData3(info.start), true);
          addValueModal('#modal-cadastrar #hora',  formateHours(info.start), true)          
          var myModal = new bootstrap.Modal(document.getElementById('cadastrar'))
          myModal.show() 
        }
        
      });

      calendar.render();

    }
    
  });