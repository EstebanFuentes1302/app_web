const formModificarUsuario = document.getElementById('formModificarUsuario');
const formBuscarUsuario = document.getElementById('formBuscarUsuario');

const formBuscarUsuarioInputs = document.querySelectorAll('#formBuscarUsuario input');


const expresiones = {
    nombre: /^(([ \u00c0-\u00ffa-zA-Z'\-])+){3,}$/,
    form_nombre: /^((\w|[ \u0021-\u002f]|[\u00c0-\u00ff])+){2,}/,
    form_cantidad: /^\d+$/,
    celular: /9\d{2}[\s-]?\d{3}[\s-]?\d{3}/,
    correo: /^[\w-._]+@\w+\.[a-zA-Z]+$/,
    codigo_solicitante: /^\d+$/,
    codigo: /^\d+$/,
    usuario: /^\w+(\S?\w+?)+$/,
    password: /^(([\w!@#\.])+){4,}$/,
}

const camposBuscar = {
    codigo: false
}

const camposModificar = {
    nombre: true,
    apellido: true,
    dni: true,
    celular: true,
    usuario: true,
    password: true,
    cargo: true
}

const validarFormBuscarUsuario = (e) => {
    switch(e.target.name){
        case "txtCodigoBuscar":
            if(expresiones.codigo.test(e.target.value)){
                document.getElementById('txtCodigoBuscar').classList.remove('border-danger');
                document.getElementById('txtErrorCodigo').classList.add('d-none');
                camposBuscar['codigo']=true;
            }else{
                document.getElementById('txtCodigoBuscar').classList.add('border-danger');
                document.getElementById('txtErrorCodigo').classList.remove('d-none');
                camposBuscar['codigo']=false;
            }
            break;
    }
}

formBuscarUsuarioInputs.forEach((input)=>{
    input.addEventListener('keyup', validarFormBuscarUsuario);
    input.addEventListener('blur', validarFormBuscarUsuario);
})

const validarFormModificarUsuario = (e) => {
    switch(e.target.name){
        case "txtNombre":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtNombre').classList.remove('border-danger');
                document.getElementById('txtErrorNombre').classList.add('d-none');
                camposModificar['nombre']=true;
            }else{
                document.getElementById('txtNombre').classList.add('border-danger');
                document.getElementById('txtErrorNombre').classList.remove('d-none');
                camposModificar['nombre']=false;
            }
        break;
        case "txtApellido":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtApellido').classList.remove('border-danger');
                document.getElementById('txtErrorApellido').classList.add('d-none');
                camposModificar['apellido']=true;
            }else{
                document.getElementById('txtApellido').classList.add('border-danger');
                document.getElementById('txtErrorApellido').classList.remove('d-none');
                camposModificar['apellido']=false;
            }
        break;
        case "txtCelular":
            if(expresiones.celular.test(e.target.value)){
                document.getElementById('txtCelular').classList.remove('border-danger');
                document.getElementById('txtErrorCelular').classList.add('d-none');
                camposModificar['celular']=true;
            }else{
                document.getElementById('txtCelular').classList.add('border-danger');
                document.getElementById('txtErrorCelular').classList.remove('d-none');
                camposModificar['celular']=false;
            }
        break;
        case "txtUsuario":
            if(expresiones.usuario.test(e.target.value)){
                document.getElementById('txtUsuario').classList.remove('border-danger');
                document.getElementById('txtErrorUsuario').classList.add('d-none');
                camposModificar['usuario']=true;
            }else{
                document.getElementById('txtUsuario').classList.add('border-danger');
                document.getElementById('txtErrorUsuario').classList.remove('d-none');
                camposModificar['usuario']=false;
            }
        break;
        case "txtPassword":
            if(expresiones.usuario.test(e.target.value)){
                document.getElementById('txtPassword').classList.remove('border-danger');
                document.getElementById('txtErrorPassword').classList.add('d-none');
                camposModificar['password']=true;
            }else{
                document.getElementById('txtPassword').classList.add('border-danger');
                document.getElementById('txtErrorPassword').classList.remove('d-none');
                camposModificar['password']=false;
            }
        break;
        case "txtCargo":
            if(expresiones.codigo.test(e.target.value)){
                document.getElementById('txtCargo').classList.remove('border-danger');
                document.getElementById('txtErrorCargo').classList.add('d-none');
                camposModificar['cargo']=true;
            }else{
                document.getElementById('txtCargo').classList.add('border-danger');
                document.getElementById('txtErrorCargo').classList.remove('d-none');
                camposModificar['cargo']=false;
            }
        break;
    }
}

var codigo = null;
var estado = null;
var fechav = null;

function buscarUsuario(){
    codigo = $('#txtCodigoBuscar').val();
    //console.log(codigo);
    if(camposBuscar['codigo']){
        $.ajax({
            url: '../controlador/CtrlBuscarUsuario.php',
            type: 'POST',
            data: { codigo },
            success: function(response){
                console.log(response);
                if(JSON.parse(response) != 'dev' && JSON.parse(response) != 'null'){
                    Swal.fire({
                        title: 'Usuario Encontrado!',
                        text: 'El Usuario ha sido encontrado',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    })
                    let usuario = JSON.parse(response);
                    console.log(JSON.parse(response));
                    
                    let template = '';
                    template += `
                        <span class="h3">Usuario</span>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Código</span>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <input class="form-control" readonly style="background-color:lightgray;" type="text" name="txtCodigo" id="txtCodigo" value="${usuario.cod_trabajador}">
                                </div>   
                                
                            </div>
                        </div>

                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Nombre</span>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <input class="form-control" type="text" name="txtNombre" id="txtNombre" value="${usuario.nombre_trabajador}">
                                </div>
                                
                            </div>
                        </div>
                        
                        <p class="text-danger d-none" id="txtErrorNombre">El nombre del usuario debe contener al menos 2 caracteres</p>
                        <div class="mt-2">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Apellido</span>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <input class="form-control" type="text" name="txtApellido" id="txtApellido" value="${usuario.apellido_trabajador}">
                                </div>
                                
                            </div>
                        </div>
                        <span class="text-danger d-none" id="txtErrorApellido">El nombre del usuario debe contener al menos 2 caracteres</span>
                        
                        <div>
                            <div class="div-txt-form-row mt-2">
                                <span class="txtForm">DNI</span>
                            </div>
                            <div class="d-flex mb-1">
                                <div>
                                    <input class="form-control" type="text" name="txtDNI" id="txtDNI" readonly style="background-color:lightgray;" value="${usuario.dni_trabajador}">
                                </div>
                                
                            </div>
                        </div>
                        <span class="text-danger d-none" id="txtErrorDNI">El DNI debe contener 8 dígitos</span>

                        <div class="mt-2">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Celular</span>
                            </div>
                            <div class="d-flex mb-1">
                                <div>
                                    <input class="form-control" type="text" name="txtCelular" id="txtCelular" value="${usuario.celular_trabajador}">
                                </div>
                                
                            </div>
                        </div>
                        <span class="text-danger d-none" id="txtErrorCelular">El celular debe contener 9 dígitos y empezar por 9</span>

                        <div class="mt-2">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Usuario</span>
                            </div>
                            <div class="d-flex mb-1">
                                <div>
                                    <input class="form-control" type="text" name="txtUsuario" id="txtUsuario" autocomplete="off" value="${usuario.nombre_usuario}">
                                </div>
                            </div>
                        </div>
                        <span class="text-danger d-none" id="txtErrorUsuario">El usuario ingresado no es admitido</span>

                        <div class="mt-2">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Contraseña</span>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <input class="form-control" type="password" name="txtPassword" id="txtPassword" autocomplete="none" value="${usuario.contrasena}">
                                </div>
                                
                            </div>
                        </div>
                        <p class="text-danger d-none mt-1" id="txtErrorPassword">La contrasña ingresada no es admitida</p>

                        <div class="mt-2">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Código de Cargo</span>
                            </div>
                            <div class="d-flex mb-1">
                                <div>
                                    <input class="form-control" type="text" name="txtCargo" id="txtCargo" value="${usuario.cod_cargo}">
                                </div>
                            </div>
                            <span class="text-danger d-none" id="txtErrorCargo">El código de cargo debe ser un número</span>
                        </div>

                        <input class="mt-3 btn border btn-primary" type="submit" name="btnModificar" id="btnModificar" value="Modificar">
                    `;
                    document.getElementById('divModificarUsuario').innerHTML = template;
                    
                    const formModificarUsuarioInputs = document.querySelectorAll('#formModificarUsuario input');
                    formModificarUsuarioInputs.forEach((input)=>{
                        input.addEventListener('keyup',validarFormModificarUsuario);
                        input.addEventListener('blur',validarFormModificarUsuario);
                    })
                }else if(JSON.parse(response) == 'null'){
                    Swal.fire({
                    title: 'Error',
                    text: 'No se pudo encontrar Usuario',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }else if(JSON.parse(response) == 'dev'){
                    Swal.fire({
                    title: 'Error',
                    text: 'El pedido ya ha sido devuelto, no se puede modificar',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }
            },
            fail: function(response){
                Swal.fire({
                title: 'Error',
                text: 'Error al encontrar Usuario',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }
        })
    }
}

$('#formModificarUsuario').submit(function(e){
    e.preventDefault();
    let dataM = {
        codigo: codigo,
        nombre: $('#txtNombre').val(),
        apellido: $('#txtApellido').val(),
        celular: $('#txtCelular').val(),
        usuario: $('#txtUsuario').val(),
        password: $('#txtPassword').val(),
        cod_cargo: $('#txtCargo').val()
    } 
    //let estado = $('#sEstado').val();
    console.log($('#sEstado').val());
    console.log(estado)
    if(camposModificar['nombre'] && camposModificar['apellido'] && camposModificar['celular'] && camposModificar['usuario'] && camposModificar['password'] && camposModificar['cargo']){
        $.ajax({
            url: '../controlador/CtrlModificarUsuario.php',
            type: 'POST',
            data: dataM,
            success: function(response){
                console.log(response);
                if(JSON.parse(response) == 'true'){
                    Swal.fire({
                        title: 'Usuario Modificado!',
                        text: 'El pedido ha sido modificado correctamente',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                        })
                    document.getElementById('divModificarUsuario').innerHTML = '';
                    codigo = null;
                    estado = null;
                }else if(JSON.parse(response) == 'false'){
                    Swal.fire({
                    title: 'Error',
                    text: 'Error al modificar estado',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }
            },
            fail: function(res){
                Swal.fire({
                title: 'Error',
                text: 'Error al modificar estado',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }
        });    
    }else{
        Swal.fire({
            title: 'Usuario no modificado',
            text: 'No se han realizado modificaciones',
            icon: 'warning',
            background: '#121212',
            color: 'white'
            })
    }
    
});

function verUsuarios(){
    let action = 'popup';
    $.ajax({
        url: '../controlador/CtrlShowVerUsuarios.php',
        data: { action },
        type: 'POST',
        success: function (response){
            console.log(response)
            var VerUsuariosPopUp = window.open('', '', 'width=1200, height=900');
            VerUsuariosPopUp.document.write(response);
        }
    });
    
}