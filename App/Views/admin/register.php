<div id="login">
    <h3 class="text-center text-white pt-5">Criar sua conta</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="\registrar" method="POST">

                        <h3 class="text-center text-info">Criar sua conta</h3>
                        <?php if($this->view->erroCadastro) { ?>
                            <div class="alert alert-danger" role="alert">
                                Erro ao realizar o cadastro!
                            </div>
                            <small class="text-danger">*Verrifique se os campos estão prenchdos coretamete!</small>
                        <?php } ?> 
                        <div class="form-group">
                            <label for="username" class="text-info">Nome</label><br>
                            <input type="text" name="nome" id="nome" class="form-control" value="<?=  $this->view->usuario['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">Sobrenome</label><br>
                            <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="<?=  $this->view->usuario['surname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">E-mail</label><br>
                            <input type="email" name="email" id="email" class="form-control" value="<?=  $this->view->usuario['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Senha</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info btn-lg btn-block" value="Criar conta">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="/login" class="text-info">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>