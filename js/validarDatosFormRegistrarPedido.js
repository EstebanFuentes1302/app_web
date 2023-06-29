const formRegistrarPedido = document.getElementById('formRegistrarPedido');
const formRegistrarPedidoInputs = document.querySelectorAll('#formRegistrarPedido input');

var codigo_articulo;
var codigo_solicitante;

var Articulos = [];

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

const campos = {
    cod_articulo: false,
    codigo_solicitante: false,
    cantidad: false,
    date: false,
    dateVencimiento: false
}

const validarFormRegistrarPedido = (e) => {

    console.log(e.target.name);
    switch(e.target.name){
        case "txtCodigoArticulo":
            if(expresiones.codigo.test(e.target.value)){
                document.getElementById('txtCodigoArticulo').classList.remove('border-danger');
                document.getElementById('txtErrorCodigoArticulo').classList.add('d-none');
                campos['cod_articulo']=true;
            }else{
                document.getElementById('txtCodigoArticulo').classList.add('border-danger');
                document.getElementById('txtErrorCodigoArticulo').classList.remove('d-none');
                campos['cod_articulo']=false;
            }
            break;
        case "txtCantidadArticulo":
            if(expresiones.form_cantidad.test(e.target.value)){
                document.getElementById('txtCantidadArticulo').classList.remove('border-danger');
                document.getElementById('txtErrorCantidad').classList.add('d-none');
                campos['cantidad']=true;
            }else{
                document.getElementById('txtCantidadArticulo').classList.add('border-danger');
                document.getElementById('txtErrorCantidad').classList.remove('d-none');
                campos['cantidad']=false;
            }
            break;
        case "txtCodigoSolicitante":
            if(expresiones.codigo_solicitante.test(e.target.value)){
                document.getElementById('txtCodigoSolicitante').classList.remove('border-danger');
                document.getElementById('txtErrorCodigoSolicitante').classList.add('d-none');
                campos['codigo_solicitante']=true;
            }else{
                document.getElementById('txtCodigoSolicitante').classList.add('border-danger');
                document.getElementById('txtErrorCodigoSolicitante').classList.remove('d-none');
                campos['codigo_solicitante']=false;
            }
            break;
        case "date":
            //console.log(Date.parse($('#date').val()));
            if(Date.parse($('#date').val())){
                document.getElementById('date').classList.remove('border-danger');
                document.getElementById('txtErrorFecha').classList.add('d-none');
                campos['date']=true;
            }else{
                document.getElementById('date').classList.add('border-danger');
                document.getElementById('txtErrorFecha').classList.remove('d-none');
                campos['date']=false;
            }
            break;
            case "dateVencimiento":
                //console.log(Date.parse($('#date').val()));
                if(Date.parse($('#date').val())){
                    document.getElementById('dateVencimiento').classList.remove('border-danger');
                    document.getElementById('txtErrorFechaVencimiento').classList.add('d-none');
                    campos['dateVencimiento']=true;
                }else{
                    document.getElementById('dateVencimiento').classList.add('border-danger');
                    document.getElementById('txtErrorFechaVencimiento').classList.remove('d-none');
                    campos['dateVencimiento']=false;
                }
                break;
    }
}

formRegistrarPedidoInputs.forEach((input)=>{
    input.addEventListener('keyup', validarFormRegistrarPedido);
    input.addEventListener('blur', validarFormRegistrarPedido);
});

$('#formRegistrarPedido').submit(function(e){
    e.preventDefault();
    const data = {
        cod_solicitante: codigo_solicitante,
        articulos: JSON.stringify(Articulos),
        date: $('#date').val(),
        dateVencimiento: $('#dateVencimiento').val()
    }
    if(codigo_solicitante != '' && codigo_articulo != '' && campos['date'] && campos['dateVencimiento']){
        console.log("here")
        $.post('../controlador/CtrlRegistrarPedido.php', data, function (response){
            console.log(response);
            if(JSON.parse(response)=='true'){
                Swal.fire({
                    title: 'Pedido Registrado!',
                    text: 'El pedido ha sido registrado correctamente',
                    icon: 'success',
                    background: '#121212',
                    color: 'white'
                });
                document.getElementById('tblArticulos').style.display = 'none';
                document.getElementById('tblSolicitante').style.display = 'none';
                $('#formRegistrarPedido').trigger('reset');
                codigo_articulo = null;
                codigo_solicitante = null;
            }else if(JSON.parse(response)=='false'){
                Swal.fire({
                title: 'Error',
                text: 'No se pudo realizar Pedido',
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
})

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

function buscarArticulo(){
    let codigo = $('#txtCodigoArticulo').val();
    let cantidad = $('#txtCantidadArticulo').val();
    let rep = false;
    let verifcantidad = false;
    if(campos['cod_articulo'] && campos['cantidad']){
        for(let elem of Articulos){
            if(codigo == elem.codigo_articulo){
                rep = true;
            }
        }
        $.ajax({
            url: '../controlador/CtrlBuscarArticulo.php',
            type: 'POST',
            data: { codigo },
            success: function(response){
                console.log(response);
                if(JSON.parse(response) != 'null'){
                    $.ajax({
                        url: '../controlador/CtrlVerificarCantidadArticulo.php',
                        type: 'POST',
                        async: false,
                        data: {
                            codigo: codigo,
                            cantidad: cantidad
                        },
                        success: function(response){
                            if(JSON.parse(response) == 'true'){
                                verifcantidad = true;
                            }else if(JSON.parse(response) == 'false'){
                                verifcantidad = false;
                            }
                        },
                        fail: function(){
                            Swal.fire({
                            title: 'Error',
                            text: 'Error al verificar Stock',
                            icon: 'error',
                            background: '#121212',
                            color: 'white'
                            })
                        }
                    });
                    if(rep == false){
                        if(verifcantidad == true){
                            document.getElementById('tblArticulos').classList.remove("d-none");
                            let articulo = JSON.parse(response);
                            let Articulo = {
                                cod_producto: articulo.cod_producto,
                                nom_producto: articulo.nom_producto,
                                cantidad: cantidad,
                                descripcion: articulo.descripcion
                            }
                            Articulos.push(Articulo);
                            //console.log(JSON.stringify(Articulos));
                            let temp = '';
                            temp = `
                                <tr>
                                  <td class="txtRow">${articulo.cod_producto}</td>
                                  <td class="txtRow">${articulo.nom_producto}</td>
                                  <td class="txtRow">${cantidad}</td>
                                  <td class="txtRow">${articulo.descripcion}</td>
                                </tr>
                            `;
                            var tableRef = document.getElementById('tblArticulos').getElementsByTagName('tbody')[0];
                            var newRow = tableRef.insertRow(tableRef.rows.length);
                            newRow.innerHTML = temp;
                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: 'La cantidad ingresada supera al stock del producto',
                                icon: 'error',
                                background: '#121212',
                                color: 'white'
                            })
                        }
                    //console.log(response); 
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: 'El articulo ya ha sido agregado',
                            icon: 'error',
                            background: '#121212',
                            color: 'white'
                        })
                    }    
                }else if(JSON.parse(response) == 'null'){
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo encontrar Artículo',
                        icon: 'error',
                        background: '#121212',
                        color: 'white'
                    })
                }
                
            },
            fail: function(){
                Swal.fire({
                title: 'Error',
                text: 'Error al encontrar Artículo',
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
    
    
}

function verSolicitantes(){
    let action = 'popup';
    $.ajax({
        url: '../controlador/CtrlShowVerClientes.php',
        data: { action },
        type: 'POST',
        success: function (response){
            var VerArticulosPopUp = window.open('', '', 'width=900, height=900');
            VerArticulosPopUp.document.write(response);
        }
    });
}

function buscarSolicitante(){
    codigo = $('#txtCodigoSolicitante').val();
    if(campos['codigo_solicitante']){
        $.ajax({
            url: '../controlador/CtrlBuscarCliente.php',
            type: 'POST',
            data: { codigo },
            success: function(response){
                console.log(response);
                if(JSON.parse(response) != 'null'){
                    //document.getElementById('tblSolicitante').classList.remove('d-none');
                    let cliente = JSON.parse(response);
                    codigo_solicitante = cliente.cod_cliente;
                    let template = '';
                    template+= `
                        <tr>
                          <td class="txtRow">${cliente.cod_cliente}</td>
                          <td class="txtRow">${cliente.nom_cliente}</td>
                          <td class="txtRow">${cliente.ape_cliente}</td>
                          <td class="txtRow">${cliente.dni}</td>
                          <td class="txtRow">${cliente.escuela_profesional}</td>
                        </tr>
                    `;
                    var tableRef = document.getElementById('tblSolicitante').getElementsByTagName('tbody')[0];

                    var newRow = tableRef.insertRow(tableRef.rows.length);
                    newRow.innerHTML = template;
                }else{
                    Swal.fire({
                    title: 'Error',
                    text: 'No se pudo encontrar al Solicitante',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
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
       document.getElementById('divSolicitante').innerHTML = '';
        Swal.fire({
                title: 'Error',
                text: 'Los datos ingresados no son correctos',
                icon: 'error',
                background: '#121212',
                color: 'white'
        })
    }
};