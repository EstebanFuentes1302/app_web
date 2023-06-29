// JavaScript Document

const formRetirarArticulo = document.getElementById('formRetirarArticulo');
const formBuscarArticulo = document.getElementById('formBuscarArticulo');

const formBuscarArticuloInputs = document.querySelectorAll('#formBuscarArticulo input');


const expresiones = {
    codigo: /^\d+$/,
    form_nombre: /^((\w|[ \u0021-\u002f]|[\u00c0-\u00ff])+){2,}/,
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

const validarformRetirarArticulo = (e) => {
    switch(e.target.name){
        case "txtIngresar":
            if(expresiones.form_cantidad.test(e.target.value)){
                document.getElementById('txtIngresar').classList.remove('border-danger');
                document.getElementById('txtErrorCantidad').classList.add('d-none');
                camposModificar['cantidad']=true;
            }else{
                document.getElementById('txtIngresar').classList.add('border-danger');
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
                        <div class="mt-2 border p-3">
                            <div class="d-flex">
                                <div class="col-6">
                                    <div>
                                        <span class="fw-bold">Código: </span>
                                        <span class="txtForm">${articulo.cod_producto}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <span class="fw-bold">Nombre: </span>
                                        <span class="txtForm">${articulo.nom_producto}</span>
                                    </div>
                                </div>
                            </div>
                           
                            <div>
                                <span class="fw-bold">Cantidad: </span>
                                <span class="txtForm">${articulo.cantidad_stock}</span>
                            </div>
                            <div>
                                <span class="fw-bold">Descripción: </span>
                                <span class="txtForm">${articulo.descripcion}</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div>
                                <input class="mt-3 mb-1 form-control" type="text" name="txtIngresar" id="txtIngresar" placeholder="Ingresar cantidad">
                                <span class="text-danger d-none" id="txtErrorCantidad" name="txtErrorCantidad">La cantidad ingresada es incorrecta</span>
                            </div>
                        </div>
                        
                        <input class="mt-2 btn border btn-primary" type="submit" name="btnModificar" id="btnModificar" value="Ingresar">
                    `;
                    document.getElementById('divForm').innerHTML = temp;
                    const formRetirarArticuloInputs = document.querySelectorAll('#formRetirarArticulo input');
                    //console.log(formRetirarArticuloInputs);
                    formRetirarArticuloInputs.forEach((input)=>{
                        input.addEventListener('keyup', validarformRetirarArticulo);
                        input.addEventListener('blur', validarformRetirarArticulo);
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

$('#formRetirarArticulo').submit(function(e){
    e.preventDefault();
    let cantidad = $('#txtIngresar').val();

    
    if(camposModificar['cantidad']){
        $.ajax({
            url: '../controlador/CtrlRetirarArticulo.php',
            type: 'POST',
            data: {codigo, cantidad},
            success: function(response){
                console.log(response);
                if(JSON.parse(response)=='true'){
                    Swal.fire({
                        title: 'Cantidad Retirada!',
                        text: 'El artículo ha sido modificado correctamente',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    })
                    document.getElementById('divForm').innerHTML = '';
                }else{
                    Swal.fire({
                    title: 'Error',
                    text: 'No se puede retirar esa cantidad',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }
                
            },
            fail: function(res){
                Swal.fire({
                title: 'Error',
                text: 'Error al ingresar cantidad',
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