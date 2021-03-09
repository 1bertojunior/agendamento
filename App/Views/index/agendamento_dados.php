<div id="login">
    <h3 class="text-center text-white pt-2">Login form</h3>
    <div class="container">
        <div id="row" class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12">
                    <?php if($this->view->info['alert']) { ?>
                        <div class="alert alert-success" role="alert">
                        Olá <?= $this->view->dados['name'] ?>, seu agendamento foi realizado com sucesso!
                        </div>
                    <?php } ?>
                    <div class="card" id="card-success">
                        <div class="card-body">
                            <h5 class="card-title">Dados da reserva</h5>
                            <!-- <h6 class="card-subtitle mb-2 text-muted">subtitle</h6> -->
                            <h5><small>N° da reserva:</small> <?= $this->view->dados['id'] ?> </h5>
                            <?php if($this->view->info['name']) { ?>
                                <h5><small>Nome:</small> <?= $this->view->dados['name'] ?> </h5>
                            <?php } ?>
                            <h5><small>Serviço:</small> <?= $this->view->dados['service'] == 1 ? 'Normal' : 'Degrade' ?> </h5>
                            <h5><small>Barbearia:</small> <?= $this->view->dados['city'] == 1 ? 'Belém do PI' : 'Padre Marcos'?> </h5>
                            <h5><small>Data da reserva:</small> <?=  date('d M Y', strtotime($this->view->dados['date'])) ?> </h5>
                            <h5><small>Horario da reserva:</small> <?= date('H:i', strtotime($this->view->dados['date'])) ?> </h5>
                            <h5><small>Preço:</small> A combinar</h5>
                            <?php if($this->view->info['text']) { ?>
                                <p class="card-text">Importante!
                                Clique no botão compartilhar para enviar os dados de confirmação para Israel.</p>
                            <?php } ?>
                        </div>
                    </div>

                    <div>
                        <?php if($this->view->info['delete']) { ?>
                            <a href="/delete?id=<?= $this->view->dados['id'] ?>&phone=<?= $this->view->dados['phone'] ?>" class="btn btn-danger btn-lg btn-block" >Apagar</a>
                        <?php } ?>
                        <a href="" class="btn btn-success btn-lg btn-block"  onclick="CriaPDF()">Compartilhar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function CriaPDF() {
        var minhaTabela = document.getElementById('card-success').innerHTML;
        // CRIA UM OBJETO WINDOW
        var win = window.open('', '', 'height=700,width=700');
        win.document.write('<html><head>');
        win.document.write('<title>Bilhete success agendamento</title>');//TITLE  DO PDF.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(minhaTabela); // O CONTEUDO DA TABELA DENTRO DA TAG BODY
        win.document.write('</body></html>');
        win.document.close(); //FECHA A JANELA
        win.print(); // IMPRIME O CONTEUDO
    }
</script>