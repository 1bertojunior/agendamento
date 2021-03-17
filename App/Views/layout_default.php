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


    <!-- CSS CUSTOM -->
    <link rel="stylesheet" href="css/form-cad.css" />

</head>
<body>

    <?= $this->content() ?>

    <!-- JS CUSTOM -->
    <script src="js/main.js"></script>   
    <script src="js/datepicker-personalizado.js"></script> 
    <script src="js/ajax-custom.js"></script> 
    <script src="js/form-cad.js"></script> 

</body>
</html>