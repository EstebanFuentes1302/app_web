const formRegistrarDevolucion = document.getElementById('formRegistrarDevolucion');
const formBuscarDevolucion = document.getElementById('formBuscarDevolucion');

const formBuscarDevolucionInputs = document.querySelectorAll('#formBuscarDevolucion input');

const expresiones = {
    nombre: /^(([ \u00c0-\u00ffa-zA-Z'\-])+){3,}$/,
    form_nombre: /^((\w|[ \u0021-\u002f]|[\u00c0-\u00ff])+){2,}/,
    form_cantidad: /^\d+$/,
    celular: /9\d{2}[\s-]?\d{3}[\s-]?\d{3}/,
    correo: /^[\w-._]+@\w+\.[a-zA-Z]+$/,
    codigo_solicitante: /^[1-9]\d{7}$/,
    codigo: /^(?!1000)[1-9][0-9][0-9][0-9]$/,
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
    switch(e.target.name){
        case "txtCodigoBuscar":
            if(expresiones.codigo.test(e.target.value)){
                document.getElementById('txtCodigoBuscar').classList.remove('txtFieldFormIncorrecto');
                document.getElementById('txtErrorCodigo').classList.remove('txtErrorShow');
                camposBuscar['codigo']=true;
            }else{
                document.getElementById('txtCodigoBuscar').classList.add('txtFieldFormIncorrecto');
                document.getElementById('txtErrorCodigo').classList.add('txtErrorShow');
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
    //console.log(e.target.name);
    switch(e.target.name){
        case "fecha_devolucion":
            //console.log(Date.parse($('#date').val()));
            if(Date.parse($('#fecha_devolucion').val())){
                document.getElementById('fecha_devolucion').classList.remove('dateFormIncorrecto');
                document.getElementById('txtErrorFecha').classList.remove('txtErrorShow');
                camposRegistrar['date']=true;
            }else{
                document.getElementById('fecha_devolucion').classList.add('dateFormIncorrecto');
                document.getElementById('txtErrorFecha').classList.add('txtErrorShow');
                camposRegistrar['date']=false;
            }
            break;
        case "txtaDetalles":
            let n = $('#txtaDetalles').val(); 
            if(String.length(n)<=100){
                document.getElementById('txtaDetalles').classList.remove('dateFormIncorrecto');
                document.getElementById('txtaErrorDetalles').classList.remove('txtErrorShow');
                camposRegistrar['txtarea']=true;
            }else{
                document.getElementById('txtaDetalles').classList.add('dateFormIncorrecto');
                document.getElementById('txtaErrorDetalles').classList.add('txtErrorShow');
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
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Código de Pedido</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" readonly type="text" name="txtCodigo" id="txtCodigo" value="${pedido.codigo_pedido}">
                            </div>
                        </div>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Código de Solicitante</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" readonly type="text" name="txtCodigoSolicitante" id="txtCodigoSolicitante" value="${pedido.codigo_solicitante}">
                            </div>
                        </div>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Estado</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" readonly type="text" name="txtEstado" id="txtEstado" value="${pedido.estado}">
                            </div>
                        </div>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Fecha de Pedido</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" readonly type="text" name="txtFecha" id="txtFecha" value="${pedido.fecha_pedido}">
                            </div>
                        </div>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Fecha de Devolución</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="dateForm" type="date" name="fecha_devolucion" id="fecha_devolucion">
                            </div>
                        </div>
                        <p class="txtError" id="txtErrorFecha">La fecha está incompleta</p>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Detalles</span>
                            </div>
                            <div class="div-input-form-row">
                                <textarea class="txtAreaForm" name="txtaDetalles" id="txtaDetalles"></textarea>
                            </div>
                        </div>
                        <p class="txtError" id="txtaErrorDetalles">Ha excedido el límite de caracteres</p>
                        <input class="button-submit" type="submit" name="btnDevolver" id="btnDevolver" value="Devolver Pedido">
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