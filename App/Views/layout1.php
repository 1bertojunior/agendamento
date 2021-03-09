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

    <!-- Datepicker -->
    <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" /> -->
    <!-- <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script> -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
        
    <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
    <script src="js/bootstrap-datepicker.js"></script> 
    <script src="locales/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>

    <script src="js/ajax-custom.js"></script> 
    <script src="js/logica-custom.js"></script> 
    <script src="js/main.js"></script> 
    

    <body>
        <?= $this->content() ?>



        <!-- JS - Personalizados -->
        <script src="js/datepicker-personalizado.js"></script> 
        <script src="js/validate-form.js"></script> 
        

    </body>


</html>