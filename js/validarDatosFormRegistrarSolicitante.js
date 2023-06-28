const formRegistrarSolicitante = document.getElementById('#formRegistrarSolicitante')
const formRegistrarSolicitanteInputs = document.querySelectorAll('#formRegistrarSolicitante input');

const expresiones = {
    nombre: /^(([ \u00c0-\u00ffa-zA-Z'\-])+){3,}$/,
    form_nombre: /^((\w|[ \u0021-\u002f]|[\u00c0-\u00ff])+){2,}/,
    form_cantidad: /^\d+$/,
    celular: /^(9\d{8}|9\d{1}\d{7}|9\d{2}\d{6})$/,
    correo: /^[\w-._]+@(\w+\.[a-zA-Z]+){1,2}$/,
    codigo_solicitante: /^[1-9]\d{7}$/,
    codigo: /^(?!1000)[1-9][0-9][0-9][0-9]$/,
    usuario: /^\w+(\S?\w+?)+$/,
    password: /^(([\w!@#\.])+){4,}$/,
    foto: /^.+\.(jpeg||png||jpg)$/,
    dni: /^\d{8}$/,
    direccion: /^[\w\s\d.,#-]+$/
}

const campos = {
    nombre: false,
    apellido: false,
    telefono: false,
    direccion: false,
    dni: false,
    escuela: false
}

const validarFormRegistrarSolicitante = (e) => {
    switch(e.target.name){
        case "txtNombreSolicitante":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtNombreSolicitante').classList.remove('border-danger');
                document.getElementById('txtErrorNombre').classList.add('d-none');
                campos['nombre']=true;
            }else{
                document.getElementById('txtNombreSolicitante').classList.add('border-danger');
                document.getElementById('txtErrorNombre').classList.remove('d-none');
                campos['nombre']=false;
            }
        break;
        case "txtApellidoSolicitante":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtApellidoSolicitante').classList.remove('border-danger');
                document.getElementById('txtErrorApellido').classList.add('d-none');
                campos['apellido']=true;
            }else{
                document.getElementById('txtApellidoSolicitante').classList.add('border-danger');
                document.getElementById('txtErrorApellido').classList.remove('d-none');
                campos['apellido']=false;
            }
        break;
        case "txtTelefono":
            if(expresiones.celular.test(e.target.value)){
                document.getElementById('txtTelefono').classList.remove('border-danger');
                document.getElementById('txtErrorTelefono').classList.add('d-none');
                campos['telefono']=true;
            }else{
                document.getElementById('txtTelefono').classList.add('border-danger');
                document.getElementById('txtErrorTelefono').classList.remove('d-none');
                campos['telefono']=false;
            }
        break;
        case "txtDireccion":
            if(expresiones.direccion.test(e.target.value)){
                document.getElementById('txtDireccion').classList.remove('border-danger');
                document.getElementById('txtErrorDireccion').classList.add('d-none');
                campos['direccion']=true;
            }else{
                document.getElementById('txtDireccion').classList.add('border-danger');
                document.getElementById('txtErrorDireccion').classList.remove('d-none');
                campos['direccion']=false;
            }
        break;
        case "txtDNI":
            if(expresiones.dni.test(e.target.value)){
                document.getElementById('txtDNI').classList.remove('border-danger');
                document.getElementById('txtErrorDNI').classList.add('d-none');
                campos['dni']=true;
            }else{
                document.getElementById('txtDNI').classList.add('border-danger');
                document.getElementById('txtErrorDNI').classList.remove('d-none');
                campos['dni']=false;
            }
        break;
        case "txtEscuela":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtEscuela').classList.remove('border-danger');
                document.getElementById('txtErrorEscuela').classList.add('d-none');
                campos['escuela']=true;
            }else{
                document.getElementById('txtEscuela').classList.add('border-danger');
                document.getElementById('txtErrorEscuela').classList.remove('d-none');
                campos['escuela']=false;
            }
        break;
    }
}

formRegistrarSolicitanteInputs.forEach((input)=>{
    input.addEventListener('keyup',validarFormRegistrarSolicitante);
    input.addEventListener('blur',validarFormRegistrarSolicitante);
})


$('#formRegistrarSolicitante').submit(function(e){
    e.preventDefault();

    var dataC = {
        nombre: $('#txtNombreSolicitante').val(),
        apellido: $('#txtApellidoSolicitante').val(),
        dni: $('#txtDNI').val(),
        direccion: $('#txtDireccion').val(),
        escuela: $('#txtEscuela').val(),
        telefono: $('#txtTelefono').val(),
        estado: $('#sEstadoCliente').val()
      };
    
    if(campos['direccion'] && campos['dni'] && campos['escuela'] && campos['nombre'] && campos['apellido'] && campos['telefono']){
        $.ajax({
            url: '../controlador/CtrlRegistrarSolicitante.php',
            type: 'POST',
            data: dataC,
            success: function (response){
                console.log(response);
                if(JSON.parse(response)=='true'){
                    Swal.fire({
                            title: 'Cliente Registrado!',
                            text: 'El cliente ha sido registrado correctamente',
                            icon: 'success',
                            background: '#121212',
                            color: 'white'
                        });
                    $('#formRegistrarSolicitante').trigger('reset');
                }else if(JSON.parse(response)=='false'){
                    Swal.fire({
                    title: 'Error',
                    text: 'No se pudo registrar Cliente',
                    icon: 'error',
                    background: '#121212',
                    color: 'white'
                    })
                }
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

    
})


