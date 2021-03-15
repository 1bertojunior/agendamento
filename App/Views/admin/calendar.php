<script>

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
          console.log(info.start)
          
          var myModal = new bootstrap.Modal(document.getElementById('cadastrar'))
          myModal.show() 
        }
        
      });

      calendar.render();

    }
    
  });

  function addValueModal(id, value, o=false){
    var div = document.querySelector(id);  //document.getElementById(id);
    o ? div.value = value :  div.innerHTML = value;
  }

  function formatarData3(d){
    return d.getDate() +" "+ meses[d.getMonth()] +" "+ d.getFullYear();
  }

  function formatDate(d, m){
    return m == 1 ? d.getDate() +'/'+ (d.getMonth())+1 +'/'+ d.getFullYear() : d.getHours()+':'+d.getMinutes();
  }

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
      <div class="modal-body" id="modal-vizualizar">
        <dl class="row">
          <dt class="col-sm-3 text">N° reserva</dt>
          <dd class="col-sm-9" id="idDados"></dd>
          <dt class="col-sm-3 text">Cidade</dt>
          <dd class="col-sm-9" id="cityDados"></dd>
          <dt class="col-sm-3 text">Nome</dt>
          <dd class="col-sm-9" id="nameDados"></dd>
          <dt class="col-sm-3 text">Sobrenome</dt>
          <dd class="col-sm-9" id="surnameDados"></dd>
          <dt class="col-sm-3 text">Telefone</dt>
          <dd class="col-sm-9" id="phoneDados"></dd>
          <dt class="col-sm-3 text">Serviço</dt>
          <dd class="col-sm-9" id="serviceDados"></dd>
          <dt class="col-sm-3 text">Data</dt>
          <dd class="col-sm-9" id="dateDados"></dd>
          <dt class="col-sm-3 text">Horario</dt>
          <dd class="col-sm-9" id="hourDados"></dd>
          <dt class="col-sm-3 text">Criando em</dt>
          <dd class="col-sm-9" id="createdDados"></dd>
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
      <div class="modal-body" id="modal-cadastrar">
        
        <form>
          <div class="form-grup row">
            <label class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name"></input>
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