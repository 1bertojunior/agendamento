<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="/auth" method="POST">
                        <h3 class="text-center text-info">Login</h3>
                        <?php if($this->view->login) { ?>
                            <span class="text text-danger">E-mail ou senha invalido(s)<span>
                        <?php } ?>
                        <div class="form-group">
                            <label for="username" class="text-info">E-mail:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Senha:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="text-info"><span>Lembrar-me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-lg btn-block" value="Login">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="/register" class="text-info">Criar conta</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>