<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <title><?= $this->view->title ?> - Agendamento</title>
        <link rel="sortcut icon" href="img/calendario-icon.png" type="image/x-icon" />

    </head>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
    <script src="js/bootstrap-datepicker.js"></script> 
    <script src="locales/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>

    <script src="js/ajax-custom.js"></script> 
    <script src="js/logica-custom.js"></script> 
    <script src="js/main.js"></script> 

    <style rel="stylesheet" type="text/css">
		/* CORPO */
            body{
                font-family: "Trebuchet MS", 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: #C42D2D;

            }

            #formulario{
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            #form{
                width: 100%;
                background: white;
                padding: 10px 10px;

                box-shadow: 0 0 15px 1px rgba(0,0, 0.2);
                padding: 20px 30px;
                margin: 0 10%;
            }

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
                /* padding: 10px; */
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
                margin-bottom:10px;
            }

            /* BUTTON */
            #form button{
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
                text-align: center;
                border-radius: 50%;
                -moz-border-radius: 10px ;
                -webkit-border-radius: 10px ;
                
                margin: 0 auto 10px 10px;
                /* background: black; */
            }
            #formulario #progress li:after{
                content: '';
                width: 100%;
                background: white;
                height: 2px;
                position: absolute;
                top: 9px;
                right: 50%;
                margin-right:10px;
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

</head>
<body>

    <?= $this->content() ?>

    <!-- JS - Personalizados -->
    <script src="js/datepicker-personalizado.js"></script> 
    <script src="js/validate-form.js"></script> 


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



</body>
</html>