<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <section id="formulario">

                <ul id="progress">
                    <li class="active-progress">City</li>
                    <li>Date</li>
                    <li>Info</li>
                </ul>
                
                <form name="formagendamento" class="form" id="form" action="/schedule" method="POST">
                    <?php if($this->view->erroCadastro ) { ?>  <!-- $this->view->erroCadastro -->
                                <div class="alert alert-danger" role="alert" style="margin:0;">
                                    Erro ao realizar o cadastro!
                                </div>
                                <small class="text-danger">*Verrifique se os campos estão preenchidos coretamete!</small>
                    <?php } ?> 
                    
                    <div id="step1" class="step active">
                        <h2>Cidade</h2>
                        <h3>Escolha a  cidade sede</h3>
                        <select name="city" id="city" class="custom-select">
                                <option value="1">Belém do Piauí - PI </option>
                            <option value="2">Padre Marcos - PI</option>
                        </select>
                        <div>
                            <button class="next botoes" id="nextFirts" type="button">Next</button>
                        </div>
                    </div>
                    <div id="step2" class="step">
                        <h2>Serviço, data e horário</h2>
                        <h3>Serviço</h3>
                        <select name="servico" id="service" class="custom-select">
                            <option value="1">Service 1 - 30m</option>
                            <option value="2">Service 2 - 1h</option>
                        </select>
                        <h3>Data</h3>
                        <input type="text"  name="data" class="form-control campoData" id="datepicker-default"  readonly="true" onchange="requestHorario()" required>
                        <h3>Horário</h3>
                        <div class="input-group data">
                                <select name="hora" class="form-control" id="hour" required>
                                    <option value="">Nenhum horário disponivel</option>
                                </select>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </div>
                        </div>
                        <div>
                           <button class="prev botoes" id="prevSec" type="button">Prev</button>
                            <button class="next botoes" id="nextSec" type="button">Next</button>
                        </div>
                    </div>
                    <div id="step3" class="step">
                        <h2>Horário</h2>
                        <h3>Nome</h3>
                        <input type="text" name="name" placeholder="Seu nome">
                        <h3>Sobrenome</h3>
                        <input type="text" name="surname" placeholder="Sobrenome">
                        <h3>Telefone</h3>
                        <input Placeholder="(00) 00000-0000" type="text" name="phone" class="form-control" id="phone" name="phone"
                                onkeypress="mask(this, mphone);" onblur="mask(this, mphone);"  required>
                        <div>
                            <button class="prev botoes" id="prevThird" type="button">Prev</button>
                            <button class="send botoes" id="send" type="submit">Enviar</button>
                             <!-- class="btn btn-success btn-lg btn-block" onclick="return valiForm()" -->
                        </div>
                    </div>
                        
                </form>
                <div class="form-group">
                    <a class="btn btn-primary" href='/searchagendamento' id="pagina">Consultar agendamento <span class="glyphicon glyphicon-map-marker"></span></a>
                    <a class="btn btn-danger" href='#' id="pagina">Excluir agendamento<span class="glyphicon glyphicon-map-marker"></span></a>
                </div>
            </section>
            
        </div>
    </div>
</div>

<!-- 
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
                                <label>Data</label>
                                <div class="input-group data">
                                    <input type="text"  name="data" class="form-control campoData" id="datepicker-default"  readonly="true" onchange="getData(this)" required>
                                    <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
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
    </div> -->