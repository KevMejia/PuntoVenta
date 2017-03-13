</div>
<script src=<?php echo $url; ?>js/bootstrap.min.js></script>
<script src=<?php echo $url; ?>js/PuntoVenta.js></script>

<div class="modal fade" id="ModalRegistroUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;">Registrar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="userRegistra" aria-describedby="emailHelp" placeholder="Nombre de Usuario" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="passRegistra" placeholder="Contraseña" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="RegistrarUsuario();">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Registrar
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ModalSesionUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;">Iniciar Sesión</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="userSesion" aria-describedby="emailHelp" placeholder="Nombre de Usuario" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="passSesion" placeholder="Contraseña" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="IniciaSesion();">
                    <span class="glyphicon glyphicon-user"></span> Iniciar Sesión

                </button>
            </div>

        </div>
    </div>
</div>

</body>
</html>
