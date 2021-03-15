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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <a href="/delete?id=&phone=" class="btn btn-danger delete">Apagar</a>
        <button type="button" class="btn btn-primary">Editar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL - Cadastrar -->
<div class="modal" id="cadastrar" tabindex="-1">
  <div class="modal-dialog">
    <form name="formagendamento" class="form" id="form" action="/schedule" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cadastrar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-cadastrar">
    
            <div class="form-grup row">
              <label class="col-sm-2 col-form-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name"></input>
              </div>
              <label class="col-sm-2 col-form-label">Sobrenome</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="surname"></input>
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
                <input type="text"  name="hora" class="form-control campoData" id="hora"  readonly="true" required>  
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button class="btn btn-success" type="submit">Enviar</button>
        </div>
      </div>
    </form>
  </div>
</div>