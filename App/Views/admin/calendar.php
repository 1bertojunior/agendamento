<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    initCalendar()

    function initCalendar(city=1){
      var calendar = new FullCalendar.Calendar(calendarEl, {
      //initialDate: '2021-02-14',

        locale: 'pt-br',
        initialView: 'timeGridDay', //iniciar com o dia
        nowIndicator: true, //exibir um marcador indicando a hora atual.
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'city1 city2 dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },

        customButtons: {
          city1: {
            text: 'Belém-PI',
            click: function() {
              initCalendar(1);
            }
          },
          city2: {
            text: 'Padre Marcos',
            click: function() {
              initCalendar(2);
            }
          }
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

        //click in event open the modal
        eventClick: function(info) {
          addValueModal('id', info.event.id)
          // addValueModal('city', info.event.city)
          addValueModal('name', info.event.title)
          // addValueModal('phone', info.event.phone)
          // addValueModal('service', info.event.service)
          addValueModal('date', formatDate(info.event.start,1))
          addValueModal('hour', formatDate(info.event.start,2) +' às '+ formatDate(info.event.end,2));
          console.log(info.event)
          var myModal = new bootstrap.Modal(document.getElementById('visualizar'))
          myModal.show()    
        
        },

        //click in event
        selectTable: true,
        select: function(info){
          var myModal = new bootstrap.Modal(document.getElementById('cadastrar'))
          myModal.show() 
        }


        
      });

      calendar.render();

    }
    
    


  });

  function addValueModal(id, value){
    var div = document.getElementById(id);
    div.innerHTML = value
  }

  function formatDate(d, m){
    return m == 1 ? d.getDate() +'/'+ (d.getMonth())+1 +'/'+ d.getFullYear() : d.getHours()+':'+d.getMinutes();
  }

</script>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Calendário</h1>
    <form name="formagendamento" class="form" action="/calendar" method="GET">
      <button type="submit" name="city" value="1" class="btn btn-info">Belém do Piauí - PI </button>
      <button type="submit" name="city" value="2" class="btn btn-info">Padre Marcos - PI </button>
  </form>
  <!-- <div class="input-group data"> -->
  <input name="city" id="city" type="number" value="<?= $this->view->dados['city'];?>" required style="display: none;" required> 
</div>




<div id='calendar'></div>

<!-- MODAL - Visualizar -->
<div class="modal" id="visualizar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalhes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <dl class="row">
          <dt class="col-sm-3 text">ID</dt>
          <dd class="col-sm-9" id="id"></dd>
          <dt class="col-sm-3 text">Cidade</dt>
          <dd class="col-sm-9" id="city"></dd>
          <dt class="col-sm-3 text">Nome</dt>
          <dd class="col-sm-9" id="name"></dd>
          <dt class="col-sm-3 text">Telefone</dt>
          <dd class="col-sm-9" id="phone"></dd>
          <dt class="col-sm-3 text">Serviço</dt>
          <dd class="col-sm-9" id="service"></dd>
          <dt class="col-sm-3 text">Data</dt>
          <dd class="col-sm-9" id="date"></dd>
          <dt class="col-sm-3 text">Horario</dt>
          <dd class="col-sm-9" id="hour"></dd>
          <dt class="col-sm-3 text" id="created">Criando em</dt>
          <dd class="col-sm-9"></dd>
        </dl>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL - Cadastrar -->
<div class="modal" id="cadastrar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastrar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form>
          <div class="form-grup row">
            <label class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"></input>
            </div>
            <label class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-10">
              <input Placeholder="(00) 00000-0000" type="text" name="phone" class="form-control" id="phone" name="phone"
                                onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"  required>
            </div>  
            <label class="col-sm-2 col-form-label">Service</label>
            <div class="col-sm-10">
              <select name="servico" id="service" class="form-control" required>
                <option value="1">Service 1 - 30m</option>
                <option value="2">Service 2 - 1h</option>
              </select>
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
              </div>
            </div>  
            <label class="col-sm-2 col-form-label">Data</label>
            <div class="col-sm-10">
              <div class="input-group data">
                <input type="text"  name="data" class="form-control campoData" id="datepicker-default"  readonly="true" onchange="getData(this)" required>
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </div>
              </div><!-- // datapicker INPUT -->
            </div>  
            <label class="col-sm-2 col-form-label">Horario</label>
            <div class="col-sm-10">
              <select name="hora" class="form-control" id="hour" required>
                <option>Nenhum horário disponivel</option>
              </select>
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group data">
                <input name="city" id="city" type="number" value="<?= $this->view->dados['city'];?>" required style="display: none;" required> 
              </div>
            </div> 
            
          </div>        
        </form>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>