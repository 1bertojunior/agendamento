<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="/searchByIdAndPhone" method="POST">
                        <h3 class="text-center">Consultar agendamento</h3>
                        <div class="form-group">
                            <label for="username" class="text">N° da reserva:</label><br>
                            <input type="number" name="id" id="id" class="form-control"  required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="text">Telefone:</label><br>
                            <input required Placeholder="(00) 00000-0000" type="text" name="phone" class="form-control" id="phone" name="phone"
                                onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                            
                        </div>
                       
                        <div class="form-group">
                            <button class="btn btn-info btn-lg btn-block">Buscar</button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
