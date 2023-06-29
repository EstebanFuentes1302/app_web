// JavaScript Document

const formEliminarArticulo = document.getElementById('formEliminarArticulo');
const formBuscarArticulo = document.getElementById('formBuscarArticulo');

const formBuscarArticuloInputs = document.querySelectorAll('#formBuscarArticulo input');


const expresiones = {
    nombre: /^(([ \u00c0-\u00ffa-zA-Z'\-])+){3,}$/,
    form_nombre: /^((\w|[ \u0021-\u002f]|[\u00c0-\u00ff])+){2,}/,
    form_cantidad: /^\d+$/,
    celular: /9\d{2}[\s-]?\d{3}[\s-]?\d{3}/,
    correo: /^[\w-._]+@\w+\.[a-zA-Z]+$/,
    codigo_solicitante: /^2\d{7}$/,
    codigo: /^\d+$/,
    usuario: /^\w+(\S?\w+?)+$/,
    password: /^(([\w!@#\.])+){4,}$/
}

const camposBuscar = {
    codigo: false
}

const validarFormBuscarArticulo = (e) => {
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

var codigo;

formBuscarArticuloInputs.forEach((input)=>{
    input.addEventListener('keyup',validarFormBuscarArticulo);
    input.addEventListener('blur',validarFormBuscarArticulo);
})

$('#formBuscarArticulo').submit(function(e){
    e.preventDefault();
    codigo = $('#txtCodigoBuscar').val();
    //console.log(codigo);
    if(camposBuscar['codigo']){
        
        $.ajax({
            url: '../controlador/CtrlBuscarArticulo.php',
            type: 'POST',
            data: { codigo },
            success: function(response){
                //console.log(response);
                if(JSON.parse(response) != 'null'){
                    Swal.fire({
                        title: 'Artículo Encontrado!',
                        text: 'El artículo ha sido encontrado',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    })
                    //console.log(response);
                    let articulo = JSON.parse(response);
                    let temp = '';
                    temp = `
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Código</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" readonly type="text" style="background-color:lightgray;" name="txtCodigo" id="txtCodigo" value="${articulo.cod_producto}">
                            </div>
                        </div>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Nombre</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" readonly type="text" style="background-color:lightgray;" name="txtNombre" id="txtNombre" value="${articulo.nom_producto}">
                            </div>
                        </div>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Cantidad</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" type="text" style="background-color:lightgray;" readonly name="txtCantidad" id="txtCantidad" value="${articulo.cantidad_stock}">
                            </div>
                        </div>
                        <div class="div-form-row">
                            <div class="div-txt-form-row">
                                <span class="txtForm">Detalles</span>
                            </div>
                            <div class="div-input-form-row">
                                <input class="txtFieldFormReadonly" type="text" style="background-color:lightgray;" readonly name="txtDescripcion" id="txtDescripcion" value="${articulo.descripcion}">
                            </div>
                        </div>

                        <input class="mt-3 btn border btn-primary" type="submit" name="btnEliminar" id="btnEliminar" value="Eliminar">
                    `;
                    document.getElementById('divEliminarArticulo').innerHTML = temp;
                    const formModificarArticuloInputs = document.querySelectorAll('#formModificarArticulo input');
                    //console.log(formModificarArticuloInputs);
                    formModificarArticuloInputs.forEach((input)=>{
                        input.addEventListener('keyup', validarFormModificarArticulo);
                        input.addEventListener('blur', validarFormModificarArticulo);
                    })
                }else{
                    Swal.fire({
                    title: 'Error',
                    text: 'No se pudo encontrar Artículo',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                    /*$('#tbodyArticulo').html('');
                    $('#tbodyArticulo2').html('');
                    $('#tbodyArticulo3').html('');*/
                    document.getElementById('divEliminarArticulo').innerHTML = '';
                }
                
            },
            fail: function(response){
                Swal.fire({
                title: 'Error',
                text: 'Error al encontrar Artículo',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }
            
        })
    }else{
        //document.getElementById('tblModificarArticulo').style.display = 'none';
        Swal.fire({
                title: 'Error',
                text: 'Los datos ingresados no son correctos',
                icon: 'error',
                background: '#121212',
                color: 'white'
        })
    }
});

$('#formEliminarArticulo').submit(function(e){
    e.preventDefault();
    //console.log(codigo);
    $.ajax({
        url: '../controlador/CtrlEliminarArticulo.php',
        type: 'POST',
        data: {codigo},
        success: function(response){
            console.log(response);
            if(JSON.parse(response)=='true'){
                Swal.fire({
                    title: 'Artículo Eliminado!',
                    text: 'El artículo ha sido eliminado correctamente',
                    icon: 'success',
                    background: '#121212',
                    color: 'white'
                })
                document.getElementById('divEliminarArticulo').innerHTML = '';
            }else if(JSON.parse(response) == 'false'){
                Swal.fire({
                title: 'Error',
                text: 'Error al eliminar Artículo',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
            }else if(JSON.parse(response) == 'used'){
                Swal.fire({
                title: 'Error',
                text: 'No se puede eliminar el artículo porque ya tiene registros en el sistema',
                icon: 'error',
                background: '#121212',
                color: 'white'
                })
                document.getElementById('divEliminarArticulo').innerHTML = '';
            }
        },
        fail: function(res){
            Swal.fire({
            title: 'Error',
            text: 'Error al eliminar Artículo',
            icon: 'error',
            background: '#121212',
            color: 'white'
            })
        }
    });

    
});

function verArticulos(){
    let action = 'popup';
    $.ajax({
        url: '../controlador/CtrlShowVerArticulos.php',
        data: { action },
        type: 'POST',
        success: function (response){
            console.log(response);
            var VerArticulosPopUp = window.open('', '', 'width=700, height=900');
            VerArticulosPopUp.document.write(response);
        }
    });
    
}