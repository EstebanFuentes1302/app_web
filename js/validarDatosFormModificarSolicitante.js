// JavaScript Document

const formModificarSolicitante = document.getElementById('formModificarSolicitante');
const formBuscarSolicitante = document.getElementById('formBuscarSolicitante');

const formBuscarSolicitanteInputs = document.querySelectorAll('#formBuscarSolicitante input');


const expresiones = {
    nombre: /^(([ \u00c0-\u00ffa-zA-Z'\-])+){3,}$/,
    form_nombre: /^((\w|[ \u0021-\u002f]|[\u00c0-\u00ff])+){2,}/,
    form_cantidad: /^\d+$/,
    celular: /9\d{2}[\s-]?\d{3}[\s-]?\d{3}/,
    correo: /^[\w-._]+@\w+\.[a-zA-Z]+$/,
    codigo_solicitante: /^\d+$/,
    codigo: /^(?!1000)[1-9][0-9][0-9][0-9]$/,
    usuario: /^\w+(\S?\w+?)+$/,
    password: /^(([\w!@#\.])+){4,}$/,
    dni: /^\d{8}$/,
    direccion: /^[\w\s\d.,#-]+$/
}

const camposBuscar = {
    codigo: false
}

const camposModificar = {
    nombre: true,
    apellido: true,
    direccion: true,
    escuela: true,
    dni: true,
    telefono: true
}

const validarFormBuscarSolicitante = (e) => {
    
    switch(e.target.name){
        case "txtCodigoBuscar":
            if(expresiones.codigo_solicitante.test(e.target.value)){
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

const validarFormModificarCliente = (e) => {
    console.log(e.target.name);
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
        case "txtDireccion":
            if(expresiones.direccion.test(e.target.value)){
                document.getElementById('txtDireccion').classList.remove('border-danger');
                document.getElementById('txtErrorDireccion').classList.add('d-none');
                camposModificar['direccion']=true;
            }else{
                document.getElementById('txtDireccion').classList.add('border-danger');
                document.getElementById('txtErrorDireccion').classList.remove('d-none');
                camposModificar['direccion']=false;
            }
        break;
        case "txtEscuela":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtEscuela').classList.remove('border-danger');
                document.getElementById('txtErrorEscuela').classList.add('d-none');
                camposModificar['escuela']=true;
            }else{
                document.getElementById('txtEscuela').classList.add('border-danger');
                document.getElementById('txtErrorEscuela').classList.remove('d-none');
                camposModificar['escuela']=false;
            }
        break;
        case "txtTelefono":
            if(expresiones.celular.test(e.target.value)){
                document.getElementById('txtTelefono').classList.remove('border-danger');
                document.getElementById('txtErrorTelefono').classList.add('d-none');
                camposModificar['telefono']=true;
            }else{
                document.getElementById('txtTelefono').classList.add('border-danger');
                document.getElementById('txtErrorTelefono').classList.remove('d-none');
                camposModificar['telefono']=false;
            }
        break;
    }
}

var codigo;

formBuscarSolicitanteInputs.forEach((input)=>{
    input.addEventListener('keyup', validarFormBuscarSolicitante);
    input.addEventListener('blur', validarFormBuscarSolicitante);
})


$('#formBuscarSolicitante').submit(function(e){
    e.preventDefault();
    codigo = $('#txtCodigoBuscar').val();
    //console.log(codigo);
    if(camposBuscar['codigo']){
        $.ajax({
            url: '../controlador/CtrlBuscarCliente.php',
            type: 'POST',
            data: { codigo },
            success: function(response){
                //console.log(response);
                if(JSON.parse(response) != 'null'){
                    Swal.fire({
                        title: 'Cliente Encontrado!',
                        text: 'El solicitante se encuentra registrado',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    })
                    
                    //console.log(response);
                    let solicitante = JSON.parse(response);
                    let template = '';
                    template+= `
                        <div class="mt-3 mb-2">
                            <span class="h3">Cliente</span>
                        </div>
                        
                        <div class="p-3 border">
                            <div class="d-flex">
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span class="fs-6">Código</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" readonly style="background-color:lightgray;" type="text" name="txtCodigo" id="txtCodigo" value="${solicitante.cod_cliente}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Nombre</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" type="text" name="txtNombre" id="txtNombre" value="${solicitante.nom_cliente}">
                                        </div>
                                    </div>
                                    <p class="text-danger d-none" id="txtErrorNombre">El nombre debe tener 2 dígitos como mínimo</p>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span>Apellido</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" type="text" name="txtApellido" id="txtApellido" value="${solicitante.ape_cliente}">
                                        </div>
                                    </div>
                                    <p class="text-danger d-none" id="txtErrorApellido">El apellido debe tener 2 dígitos como mínimo</p>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span>DNI</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" readonly style="background-color:lightgray;" type="text" name="txtDNI" id="txtDNI" value="${solicitante.dni}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span>Direccion</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" type="text" name="txtDireccion" id="txtDireccion" value="${solicitante.direccion}">
                                        </div>
                                    </div>
                                    <p class="text-danger d-none" id="txtErrorDireccion">La dirección es incorrecta</p>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span>Escuela Profesional</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" type="text" name="txtEscuela" id="txtEscuela" value="${solicitante.escuela_profesional}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Teléfono</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" type="text" name="txtTelefono" id="txtTelefono" value="${solicitante.celular}">
                                        </div>
                                    </div>
                                    <p class="text-danger d-none" id="txtErrorTelefono">El número de celular debe tener 9 dígitos y empezar por 9</p>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <p class="m-0">Estado</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <select id="sEstadoCliente" class="form-select">
                                                <option value="Activo">Activo</option>
                                                <option value="Suspendido">Suspendido</option>
                                                <option value="Deudor">Deudor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="btn border btn-primary mt-3" type="submit" name="btnModificar" id="btnModificar" value="Modificar">
                    `;

                    
                    //console.log(formModificarArticuloInputs);
                   document.getElementById('divModificarSolicitante').innerHTML = template;
                   const formModificarSolicitanteInputs = document.querySelectorAll('#formModificarSolicitante input');

                    formModificarSolicitanteInputs.forEach((input)=>{
                        input.addEventListener('keyup', validarFormModificarCliente);
                        input.addEventListener('blur', validarFormModificarCliente);
                    })
                }else{
                    Swal.fire({
                    title: 'Error',
                    text: 'No se pudo encontrar al Solicitante',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                    document.getElementById('divModificarSolicitante').innerHTML = '';
                }
                
            },
            fail: function(response){
                Swal.fire({
                title: 'Error',
                text: 'Error al buscar Solicitante',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }
            
        })
    }else{
        document.getElementById('divModificarSolicitante').style.display = 'none';
        Swal.fire({
                title: 'Error',
                text: 'Los datos ingresados no son correctos',
                icon: 'error',
                background: '#121212',
                color: 'white'
        })
    }
});

$('#formModificarSolicitante').submit(function(e){
    e.preventDefault();
    let dataM = {
        codigo: codigo,
        nombre: $('#txtNombre').val(),
        apellido: $('#txtApellido').val(),
        dni: $('#txtDNI').val(),
        direccion: $('#txtDireccion').val(),
        escuela: $('#txtEscuela').val(),
        celular: $('#txtTelefono').val(),
        estado: $('#sEstadoCliente').val()
    }

    console.log(camposModificar);
    if(camposModificar['nombre'] && camposModificar['apellido'] && camposModificar['direccion'] && camposModificar['escuela'] && camposModificar['telefono']){
        $.ajax({
            url: '../controlador/CtrlModificarCliente.php',
            type: 'POST',
            data: dataM,
            success: function(response){
                //console.log(response);
                if(JSON.parse(response) == 'true'){
                    Swal.fire({
                        title: 'Cliente Modificado!',
                        text: 'El cliente ha sido modificado correctamente',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    })
                   document.getElementById('divModificarSolicitante').innerHTML = '';
                }else if(JSON.parse(response) == 'false'){
                    Swal.fire({
                    title: 'Error',
                    text: 'Error al modificar Cliente',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }
                
            },
            fail: function(res){
                Swal.fire({
                title: 'Error',
                text: 'Error al modificar Cliente',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }
        });
    }else{
        Swal.fire({
                title: 'Error',
                text: 'Los datos ingresados no son correctos',
                icon: 'error',
                background: '#121212',
                color: 'white'
        })
    }
    
});

function verSolicitantes(){
    let action = 'popup';
    $.ajax({
        url: '../controlador/CtrlShowVerSolicitantes.php',
        data: { action },
        type: 'POST',
        success: function (response){
            console.log(response);
            var VerArticulosPopUp = window.open('', '', 'width=800, height=900');
            VerArticulosPopUp.document.write(response);
        }
    });
}