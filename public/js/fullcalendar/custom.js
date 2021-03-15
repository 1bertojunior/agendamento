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