// JavaScript Document

const formModificarArticulo = document.getElementById('formModificarArticulo');
const formBuscarArticulo = document.getElementById('formBuscarArticulo');

const formBuscarArticuloInputs = document.querySelectorAll('#formBuscarArticulo input');


const expresiones = {
    codigo: /^\d+$/,
    form_nombre: /^[^'"]*$/,
    form_cantidad: /^\d+$/
}

const camposBuscar = {
    codigo: false
}

const camposModificar = {
    nombre: true,
    cantidad: true
}

const validadFormBuscarArticulo = (e) => {
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

const validarFormModificarArticulo = (e) => {
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
        case "txtCantidad":
            if(expresiones.form_cantidad.test(e.target.value)){
                document.getElementById('txtCantidad').classList.remove('border-danger');
                document.getElementById('txtErrorCantidad').classList.add('d-none');
                camposModificar['cantidad']=true;
            }else{
                document.getElementById('txtCantidad').classList.add('border-danger');
                document.getElementById('txtErrorCantidad').classList.remove('d-none');
                camposModificar['cantidad']=false;
            }
        break;
    }
}

var codigo;

formBuscarArticuloInputs.forEach((input)=>{
    input.addEventListener('keyup', validadFormBuscarArticulo);
    input.addEventListener('blur', validadFormBuscarArticulo);
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
                        <div class="mt-3 mb-2">
                            <span class="h3">Artículo</span>
                        </div>
                        <div>
                            <div class="d-flex">
                                <div>
                                    <div class="div-txt-form-row">
                                        <span class="txtForm">Código</span>
                                    </div>
                                    <div class="div-input-form-row">
                                        <input class="form-control" style="background-color:lightgray;" readonly type="text" name="txtCodigo" id="txtCodigo" value="${articulo.cod_producto}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <div class="div-txt-form-row">
                                        <span class="txtForm">Nombre</span>
                                    </div>
                                    <div class="div-input-form-row">
                                        <input class="form-control" type="text" name="txtNombre" id="txtNombre" value="${articulo.nom_producto}">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 ms-1">
                                <p class="text-danger d-none mb-0" id="txtErrorNombre">El nombre del artículo debe contener más de 2 dígitos y no permite (",')</p>
                            </div>
                            
                            <div class="d-flex">
                                <div>
                                    <div class="div-txt-form-row">
                                        <span class="txtForm">Cantidad</span>
                                    </div>
                                    <div class="div-input-form-row">
                                        <input class="form-control" type="text" name="txtCantidad" id="txtCantidad" value="${articulo.cantidad_stock}">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="mt-1 ms-1">
                                <p class="text-danger d-none mb-0" id="txtErrorCantidad">La cantidad debe ser un número entero</p>
                            </div>

                            <div class="d-flex">
                                <div>
                                    <div class="div-txt-form-row">
                                        <span class="txtForm">Descripción</span>
                                    </div>
                                    <div class="div-input-form-row">
                                        <input class="form-control" type="text" name="txtaDescripcion" id="txtaDescripcion" value="${articulo.descripcion}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input class="mt-3 btn border btn-primary" type="submit" name="btnModificar" id="btnModificar" value="Modificar">
                    `;
                    document.getElementById('divForm').innerHTML = temp;
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
                    document.getElementById('divForm').innerHTML = '';
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

$('#formModificarArticulo').submit(function(e){
    e.preventDefault();
    let nombre = $('#txtNombre').val();
    let cantidad = $('#txtCantidad').val();
    let descripcion = $('#txtaDescripcion').val();
    
    if(camposModificar['nombre'] && camposModificar['cantidad']){
        $.ajax({
            url: '../controlador/CtrlModificarArticulo.php',
            type: 'POST',
            data: {codigo, nombre, cantidad, descripcion},
            success: function(response){
                console.log(response);
                if(JSON.parse(response)=='true'){
                    Swal.fire({
                        title: 'Artículo Modificado!',
                        text: 'El artículo ha sido modificado correctamente',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    })
                    document.getElementById('divForm').innerHTML = '';
                }else{
                    Swal.fire({
                    title: 'Error',
                    text: 'Error al modificar Artículo',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }
                
            },
            fail: function(res){
                Swal.fire({
                title: 'Error',
                text: 'Error al modificar Artículo',
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