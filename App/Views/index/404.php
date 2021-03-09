<div id="login">
    <h3 class="text-center text-white pt-5"></h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="/searchByIdAndPhone" method="POST">
                        <h3 class="text-center">Oops! ):</h3>
                        <div class="form-group">
                            <h4 class="text text-center text-danger"><?= $this->view->info['title'] ?></h4>
                            <p class="text text-center text-danger"><?= $this->view->info['body'] ?><p>
                        </div>
                       
                        <div class="form-group">
                            <a class="btn btn-info btn-lg btn-block" href='/searchagendamento' > <?= $this->view->info['btn'] ?> <span class="glyphicon glyphicon-map-marker"></span></a>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>