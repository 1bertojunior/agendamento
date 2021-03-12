
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

                    <div id="step1" class="step active">
                        <h2>Cidade</h2>
                        <h3>Escolha a  cidade sede</h3>
                        
                        <div>
                            <select name="city" id="city" class="custom-select">
                                <option value="1">City 1</option>
                                <option value="2">City 2</option>
                            </select>
                        </div>

                        <div class="btn">
                            <button class="next botoes" id="nextFirts" type="button">Next</button>
                        </div>

                    </div>
                    <div id="step2" class="step">
                        <h2>Data e serviço</h2>
                        <h3>Data</h3>
                        <input type="text" name="data" class="form-control campoData" id="datepicker-default" placeholder="Data"  readonly="true" onchange="getData(this)">
                        <h3>Serviço</h3>
                        <select name="city" id="city" class="custom-select">
                            <option value="1">Service 1</option>
                            <option value="2">Service 2</option>
                        </select>
                        <div class="btn">
                            <button class="prev botoes" id="prevSec" type="button">Prev</button>
                            <button class="next botoes" id="nextSec" type="button">Next</button>
                        </div>
                    </div>
                    <div id="step3" class="step">
                        <h2>Horário</h2>
                        <h3>Nome</h3>
                        <input type="text" class="form-control campoData" name="name" placeholder="Seu nome">
                        <h3>Nome</h3>
                        <input type="text" name="surname" class="form-control campoData" placeholder="Sobrenome">
                        <div class="btn">
                            <button class="prev botoes" id="prevThird" type="button">Prev</button>
                            <button class="send botoes" id="send" type="button">Enviar</button>
                        </div>
                    </div>


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

<script>

const nextFirts = document.querySelector('#nextFirts'); //next firts
const prevSec = document.querySelector('#prevSec'); //prev Sec 
const nextSec = document.querySelector('#nextSec'); //next Sec
const prevThird = document.querySelector('#prevThird'); //prev Third
var atual, prev, next;
var i = 1;

//firts
nextFirts.onclick = function() {
    atual =  (this.parentNode).parentNode; //pegando elemento pai
    next = atual.nextElementSibling; //pegando o proximo elemento

    atual.classList.remove("active"); // hide
    next.classList.add("active"); //show

    var progress = document.querySelector('#progress'); //progress
    progress = progress.children[i]; //progress
    progress.classList.add("active-progress") //progress
    i++;
}

//sec
prevSec.onclick = function() {
    atual =  (this.parentNode).parentNode; //pegando elemento pai
    prev = atual.previousElementSibling; //pegando o proximo elemento
    
    atual.classList.remove("active"); // hide
    prev.classList.add("active"); //show

    var progress = document.querySelector('#progress'); //progress
    progress = progress.children[i-1];
    progress.classList.remove("active-progress")
    i--;
}

nextSec.onclick = function() {
    atual =  (this.parentNode).parentNode; //pegando elemento pai
    next = atual.nextElementSibling; //pegando o proximo elemento
    
    atual.classList.remove("active"); // hide
    next.classList.add("active"); //show
    
    var progress = document.querySelector('#progress'); //progress
    progress = progress.children[i]; //progress
    progress.classList.add("active-progress") //progress
    i++    
}

//third
prevThird.onclick = function() {
    atual =  (this.parentNode).parentNode; //pegando elemento pai
    prev = atual.previousElementSibling; //pegando o proximo elemento

    atual.classList.remove("active"); // hide
    prev.classList.add("active"); //show

    var progress = document.querySelector('#progress'); //progress
    progress = progress.children[i-1];
    progress.classList.remove("active-progress")
    i--;
}

</script>



    <style type="text/css">
    #form .step{
    display: none;
}
#form .step.active{
    display: block;
}
#form .btn{
    margin-top: 15px;
}

/* H1 / H2*/
#form h2, #form h3{
    color:#C42D2D;
    width: 100%;
    float: left;
    text-align: left;
    margin-bottom: 1%;
}
#form h3{
    color: #333;
    font-size: 17px;
}

/* SELECT */
#form select{  
    background-color: white;
    -webkit-appearance: none;  /* Remove estilo padrão do Chrome */  
    -moz-appearance: none; /* Remove estilo padrão do FireFox */  
    appearance: none; /* Remove estilo padrão do FireFox*/  
    background: url(http://www.webcis.com.br/images/imagens-noticias/select/ico-seta-appearance.gif) no-repeat #eeeeee;  /* Imagem de fundo (Seta) */
    background-position: 99% center;  /*Posição da imagem do background*/  
    padding: 10px;
    border: 1px solid red;
    border-radius: 4px;
    box-sizing: border-box;
    width: 100%;
    margin-bottom: 10px;
}

/* INPUT */
#form input{
    padding: 10px;
    border: 1px solid red;
    border-radius: 4px;
    outline: none;
    box-sizing: border-box;
    width: 100%;
    font: 14px "Trebuchet MS";
    color: black;
}

/* BUTTON */
#form .btn button{
    width: 100%;
    padding: 10px;
    background-color: #C42D2D;
    border: 1px solid red;
    float: left;
    border-radius: 4px;
    outline: none;
    font: 14px "Trebuchet MS";
    color: white;
    box-sizing: border-box;
    margin-bottom: 10px;
}

#form .botoes{
    width: 100px;
    background: #C42D2D;
    color: white;
    text-transform: uppercase;
    padding: 12px 0;
    margin-right: 1%;
}
#form .botoes:hover{
    background: red;
    cursor: pointer;
}

/* PROGRESSS */
#progress{
    display: flex;
    flex-direction:row;
    align-items:flex-start;
}
#formulario #progress{
    width: 50%;
    margin-bottom: 30px;
    overflow: hidden;
    
    counter-reset: step;
}

#formulario #progress li{
    list-style: none;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 16px;
    float: left;
    
    position: relative;

    width: 33.33%;
}

#formulario #progress li:before{
    content: counter(step);
    counter-increment: step;
    width: 20px;
    display: block;
    line-height: 20px;
    background: white;
    color: #333;
    border-radius: 50%;
    -moz-border-radius: 10px ;
    -webkit-border-radius: 10px ;
    
    margin: 0 auto 10px auto;
}

#formulario #progress li:after{
    content: '';
    width: 100%;
    background: white;
    height: 2px;
    position: absolute;
    top: 9px;
    left: -50%;
    z-index: -1;
}

#formulario #progress li:first-child:after{
    content: none;
}

#formulario #progress li.active-progress:before, #formulario #progress li.active-progress:after{
    background: #f54545;
    color: white;
    text-shadow: 0 1px 0;
}
</style>