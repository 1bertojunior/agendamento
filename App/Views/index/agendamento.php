
<a href="/">Home</a>
<a href="/login">Login</a>
<a href="/register">Registrar</a>
<a href="/admin">Admin</a>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div id="box" class="col-md-12">
                <form name="formagendamento" class="form" action="/schedule" method="POST">
                    <h3 class="text-center">Agendamento</h3>
                        <?php if($this->view->erroCadastro) { ?>
                            <div class="alert alert-danger" role="alert">
                                Erro ao realizar o cadastro!
                            </div>
                            <small class="text-danger">*Verrifique se os campos estão preenchidos coretamete!</small>
                        <?php } ?> 
                        <div class="form-group" id="form-grupo name">
                            <label>Nome</label>
                            <div class="input-group nome">    
                                <input name="nome" class="form-control" type="text"  placeholder="Digite seu nome" required> 
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="form-grupo phone">
                            <label class="text">Telefone:</label><br>
                            <input Placeholder="(00) 00000-0000" type="text" name="phone" class="form-control" id="phone" name="phone"
                                onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"  required>
                            
                        </div>
                        <div class="form-group" id="form-grupo service">
                            <label>Serviço</label>
                            <div class="input-group data">
                                <select name="servico" id="service" class="form-control" required>
                                    <option value="1">Service 1 - 30m</option>
                                    <option value="2">Service 2 - 1h</option>
                                </select>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="form-grupo date">
                                <label>Data</label><!-- datapicker INPUT -->
                                <div class="input-group data">
                                    <input type="text"  name="data" class="form-control campoData" id="datepicker-default"  readonly="true" onchange="getData(this)" required>
                                    <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div><!-- // datapicker INPUT -->
                        </div>
                        <div class="form-group" id="form-grupo hour">
                            <label>Horário</label>
                            <div class="input-group data">
                                <select name="hora" class="form-control" id="hour" required>
                                    <option>Nenhum horário disponivel</option>
                                </select>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group data">
                            <input name="city" id="city" type="number" value="<?= $this->view->dados['city'];?>" required style="display: none;" required> 
                            </div>
                        </div> 

                        <div class="form-group">
                            <a class="btn btn-warning" href='city' id="pagina">Mudar cidade <span class="glyphicon glyphicon-map-marker"></span></a>
                            <a class="btn btn-primary" href='/searchagendamento' id="pagina">Consultar agendamento <span class="glyphicon glyphicon-map-marker"></span></a>
                            <a class="btn btn-danger" href='#' id="pagina">Excluir <span class="glyphicon glyphicon-map-marker"></span></a>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block" onclick="return valiForm()">Agendar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>