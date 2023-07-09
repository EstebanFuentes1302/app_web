const formRegistrarDevolucion = document.getElementById('formRegistrarDevolucion');
const formBuscarDevolucion = document.getElementById('formBuscarDevolucion');

const formBuscarDevolucionInputs = document.querySelectorAll('#formBuscarDevolucion input');

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

var codigo;
var codigo_articulo;
var cantidad;
var txtAreaE;

const camposBuscar = {
    codigo: false
}

const camposRegistrar = {
    date: false,
    txtarea: true
}

const validarFormBuscarDevolucion = (e) => {
    console.log(e.target.name);
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

formBuscarDevolucionInputs.forEach((input)=>{
    input.addEventListener('keyup', validarFormBuscarDevolucion);
    input.addEventListener('blur', validarFormBuscarDevolucion);
});

const validarFormRegistrarDevolucion = (e) => {
    //console.log(e.target.value);
    switch(e.target.name){
        case "fecha_devolucion":
            //console.log(Date.parse($('#date').val()));
            if(Date.parse($('#fecha_devolucion').val())){
                document.getElementById('fecha_devolucion').classList.remove('border-danger');
                document.getElementById('txtErrorFecha').classList.add('d-none');
                camposRegistrar['date']=true;
            }else{
                document.getElementById('fecha_devolucion').classList.add('border-danger');
                document.getElementById('txtErrorFecha').classList.remove('d-none');
                camposRegistrar['date']=false;
            }
            break;
        case "txtaDetalles":
            //console.log(e.target.value.length)
            if(e.target.value.length<=100){
                document.getElementById('txtaDetalles').classList.remove('border-danger');
                document.getElementById('txtaErrorDetalles').classList.add('d-none');
                camposRegistrar['txtarea']=true;
            }else{
                document.getElementById('txtaDetalles').classList.add('border-danger');
                document.getElementById('txtaErrorDetalles').classList.remove('d-none');
                camposRegistrar['txtarea']=false;
            }
            break;
    }
}

$('#formBuscarDevolucion').submit(function(e){
    e.preventDefault();
    codigo = $('#txtCodigoBuscar').val();
    
    //console.log(codigo);
    if(camposBuscar['codigo']){
        $.ajax({
            url: '../controlador/CtrlBuscarPedido.php',
            type: 'POST',
            data: { codigo },
            success: function(response){
                //console.log(JSON.parse(response));
                if(JSON.parse(response) != 'null' && JSON.parse(response) != 'dev'){
                    Swal.fire({
                        title: 'Pedido Encontrado!',
                        text: 'El pedido ha sido encontrado',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    })
                    //console.log(response);
                    let pedido = JSON.parse(response);
                    let template = '';
                    codigo_articulo = pedido.codigo_articulo;
                    cantidad = pedido.cantidad;
                    template = '';
                    template += `
                        <div class="mt-3 mb-2">
                            <span class="h3">Detalles del Pedido</span>
                        </div>
                        
                        <div class="p-3 border">
                            <div class="d-flex">
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Código de Pedido</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" readonly style="background-color:lightgray;" type="text" name="txtCodigo" id="txtCodigo" value="${pedido.cod_registro_pedido}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span>Código de Solicitante</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" style="background-color:lightgray;" readonly type="text" name="txtCodigoSolicitante" id="txtCodigoSolicitante" value="${pedido.cod_cliente}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Estado</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" style="background-color:lightgray;" readonly type="text" name="txtEstado" id="txtEstado" value="${pedido.estado_pedido}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Fecha de Inicio</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" style="background-color:lightgray;" readonly type="text" name="txtFecha" id="txtFecha" value="${pedido.fecha_inicio}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Fecha de Vencimiento</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" style="background-color:lightgray;" readonly type="text" name="txtFechaVencimiento" id="txtFechaVencimiento" value="${pedido.fecha_vencimiento}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Fecha de Devolución</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <input class="form-control" type="date" name="fecha_devolucion" id="fecha_devolucion">
                                        </div>
                                    </div>
                                    <p class="d-none text-danger" id="txtErrorFecha">La fecha está incompleta</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div>
                                            <span class="txtForm">Detalles</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div>
                                            <textarea class="form-control" name="txtaDetalles" id="txtaDetalles"></textarea>
                                        </div>
                                    </div>
                                    <p class="d-none text-danger" id="txtaErrorDetalles">Ha excedido el límite de caracteres</p>
                                </div>
                            </div>
                        </div>
                        <input class="btn border btn-primary mt-3" type="submit" name="btnDevolver" id="btnDevolver" value="Devolver Pedido">
                    `;
                    document.getElementById('divDevolverPedido').innerHTML = template;
                    const formRegistrarDevolucionInputs = document.querySelectorAll('#formRegistrarDevolucion input');
                    formRegistrarDevolucionInputs.forEach((input)=>{
                        input.addEventListener('keyup', validarFormRegistrarDevolucion);
                        input.addEventListener('blur', validarFormRegistrarDevolucion);
                    })
                }else if(JSON.parse(response) == 'null'){
                    Swal.fire({
                    title: 'Error',
                    text: 'No se pudo encontrar Pedido',
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
                text: 'Error al encontrar Pedido',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }
        })
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


$('#formRegistrarDevolucion').submit(function(e){
    e.preventDefault();
    
    const data = {
        codigo: codigo,
        fecha_devolucion: $('#fecha_devolucion').val(),
        detalles: $('#txtaDetalles').val()
    }
    
    if(camposRegistrar['date'] && $('#txtaDetalles').val().length<=100){
        $.post('../controlador/CtrlRegistrarDevolucion.php',data, function (response){
            console.log(response);
            if(JSON.parse(response) == 'true'){
                Swal.fire({
                        title: 'Pedido Devuelto!',
                        text: 'El pedido ha sido devuelto correctamente',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    });
                $('#formRegistrarPedido').trigger('reset');
                document.getElementById('divDevolverPedido').innerHTML = '';
            }else if(JSON.parse(response)=='false'){
                Swal.fire({
                title: 'Error',
                text: 'No se pudo devolver Pedido',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }else if(JSON.parse(response) == 'dev'){
                Swal.fire({
                title: 'Error',
                text: 'El Pedido ya ha sido devuelto',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
                $('#formRegistrarPedido').trigger('reset');
                document.getElementById('divDevolverPedido').innerHTML = '';
            }
        })    
    }else{
        Swal.fire({
                title: 'Error',
                text: 'Los datos ingresados no son correctos',
                icon: 'error',
                background: '#121212',
                color: 'white'
        })
    }
})

function verPedidos(){
    let action = 'popup';
    $.ajax({
        url: '../controlador/CtrlShowVerPedidos.php',
        data: { action },
        type: 'POST',
        success: function (response){
            var VerArticulosPopUp = window.open('', '', 'width=1200, height=900');
            VerArticulosPopUp.document.write(response);
        }
    });
    
}