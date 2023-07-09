const formEliminarUsuario = document.getElementById('formEliminarUsuario');
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

const validarFormEliminarUsuario = (e) => {
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
                    <div class="mt-3">
                        <span class="h3">Usuario</span>
                    </div>
                    
                        <div class="mt-2 border p-3">
                            <div class="d-flex">
                                <div class="col-6">
                                    <div>
                                        <span class="fw-bold">Código: </span>
                                        <span class="txtForm">${usuario.cod_trabajador}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <span class="fw-bold">Nombre: </span>
                                        <span class="txtForm">${usuario.nombre_trabajador}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="col-6">
                                    <span class="fw-bold">Apellido: </span>
                                    <span class="txtForm">${usuario.apellido_trabajador}</span>
                                </div>
                                <div class="col-6">
                                    <span class="fw-bold">DNI: </span>
                                    <span class="txtForm">${usuario.dni_trabajador}</span>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="col-6">
                                    <span class="fw-bold">Celular: </span>
                                    <span class="txtForm">${usuario.celular_trabajador}</span>
                                </div>
                                <div class="col-6">
                                    <span class="fw-bold">Usuario: </span>
                                    <span class="txtForm">${usuario.nombre_usuario}</span>
                                </div>
                            </div>

                            <div>
                                <span class="fw-bold">Usuario: </span>
                                <span class="txtForm">${usuario.nombre_usuario}</span>
                            </div>
                            <div>
                                <span class="fw-bold">Contraseña: </span>
                        
                                <span class="txtForm" type="password">${"•".repeat(usuario.contrasena.length)}</span>
                            </div>
                            <div>
                                <span class="fw-bold">Código de Cargo: </span>
                                <span class="txtForm">${usuario.cod_cargo}</span>
                            </div>
                
                        </div>

                        <input class="mt-3 btn border btn-danger" type="submit" name="btnEliminar" id="btnEliminar" value="Eliminar">
                    `;
                    document.getElementById('divEliminarUsuario').innerHTML = template;
                    
                    const formEliminarUsuarioInputs = document.querySelectorAll('#formEliminarUsuario input');
                    formEliminarUsuarioInputs.forEach((input)=>{
                        input.addEventListener('keyup',validarFormEliminarUsuario);
                        input.addEventListener('blur',validarFormEliminarUsuario);
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

$('#formEliminarUsuario').submit(function(e){
    e.preventDefault();
    let dataM = {
        codigo: codigo,
    } 
    //let estado = $('#sEstado').val();
    console.log($('#sEstado').val());
    console.log(estado)
    if(camposModificar['nombre'] && camposModificar['apellido'] && camposModificar['celular'] && camposModificar['usuario'] && camposModificar['password'] && camposModificar['cargo']){
        $.ajax({
            url: '../controlador/CtrlEliminarUsuario.php',
            type: 'POST',
            data: dataM,
            success: function(response){
                console.log(response);
                if(JSON.parse(response) == 'true'){
                    Swal.fire({
                        title: 'Usuario Eliminado!',
                        text: 'El usuario ha sido eliminado correctamente',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                        })
                    document.getElementById('divEliminarUsuario').innerHTML = '';
                    codigo = null;
                    estado = null;
                }else if(JSON.parse(response) == 'false'){
                    Swal.fire({
                    title: 'Error',
                    text: 'Error al eliminar Usuario',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }
            },
            fail: function(res){
                Swal.fire({
                title: 'Error',
                text: 'Error al eliminar Usuario',
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