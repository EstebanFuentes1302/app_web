const formRegistrarUsuario = document.getElementById('#formRegistrarUsuario')
const formRegistrarUsuarioInputs = document.querySelectorAll('#formRegistrarUsuario input');

const expresiones = {
    nombre: /^(([ \u00c0-\u00ffa-zA-Z'\-])+){3,}$/,
    form_nombre: /^((\w|[ \u0021-\u002f]|[\u00c0-\u00ff])+){2,}/,
    form_cantidad: /^\d+$/,
    celular: /9\d{2}[\s-]?\d{3}[\s-]?\d{3}/,
    correo: /^[\w-._]+@\w+\.[a-zA-Z]+$/,
    codigo_solicitante: /^[1-9]\d{7}$/,
    codigo: /^\d+$/,
    usuario: /^\w+(\S?\w+?)+$/,
    password: /^(([\w!@#\.])+){4,}$/,
    dni: /^\d{8}$/,
}

const campos = {
    nombre: false,
    apellido: false,
    dni: false,
    celular: false,
    usuario: false,
    password: false,
    cargo: false
}

const validarFormRegistrarUsuario = (e) => {
    switch(e.target.name){
        case "txtNombre":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtNombre').classList.remove('border-danger');
                document.getElementById('txtErrorNombre').classList.add('d-none');
                campos['nombre']=true;
            }else{
                document.getElementById('txtNombre').classList.add('border-danger');
                document.getElementById('txtErrorNombre').classList.remove('d-none');
                campos['nombre']=false;
            }
        break;
        case "txtApellido":
            if(expresiones.form_nombre.test(e.target.value)){
                document.getElementById('txtApellido').classList.remove('border-danger');
                document.getElementById('txtErrorApellido').classList.add('d-none');
                campos['apellido']=true;
            }else{
                document.getElementById('txtApellido').classList.add('border-danger');
                document.getElementById('txtErrorApellido').classList.remove('d-none');
                campos['apellido']=false;
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
        case "txtCelular":
            if(expresiones.celular.test(e.target.value)){
                document.getElementById('txtCelular').classList.remove('border-danger');
                document.getElementById('txtErrorCelular').classList.add('d-none');
                campos['celular']=true;
            }else{
                document.getElementById('txtCelular').classList.add('border-danger');
                document.getElementById('txtErrorCelular').classList.remove('d-none');
                campos['celular']=false;
            }
        break;
        case "txtUsuario":
            if(expresiones.usuario.test(e.target.value)){
                document.getElementById('txtUsuario').classList.remove('border-danger');
                document.getElementById('txtErrorUsuario').classList.add('d-none');
                campos['usuario']=true;
            }else{
                document.getElementById('txtUsuario').classList.add('border-danger');
                document.getElementById('txtErrorUsuario').classList.remove('d-none');
                campos['usuario']=false;
            }
        break;
        case "txtPassword":
            if(expresiones.usuario.test(e.target.value)){
                document.getElementById('txtPassword').classList.remove('border-danger');
                document.getElementById('txtErrorPassword').classList.add('d-none');
                campos['password']=true;
            }else{
                document.getElementById('txtPassword').classList.add('border-danger');
                document.getElementById('txtErrorPassword').classList.remove('d-none');
                campos['password']=false;
            }
        break;
        case "txtCargo":
            if(expresiones.codigo.test(e.target.value)){
                document.getElementById('txtCargo').classList.remove('border-danger');
                document.getElementById('txtErrorCargo').classList.add('d-none');
                campos['cargo']=true;
            }else{
                document.getElementById('txtCargo').classList.add('border-danger');
                document.getElementById('txtErrorCargo').classList.remove('d-none');
                campos['cargo']=false;
            }
        break;
    }
}

formRegistrarUsuarioInputs.forEach((input)=>{
    input.addEventListener('keyup',validarFormRegistrarUsuario);
    input.addEventListener('blur',validarFormRegistrarUsuario);
})

$('#formRegistrarUsuario').submit(function(e){
    e.preventDefault();
    let date = $('#date').val();
    //console.log(date);
    const data = {
        nombre: $('#txtNombre').val(),
        apellido: $('#txtApellido').val(),
        dni: $('#txtDNI').val(),
        celular: $('#txtCelular').val(),
        usuario: $('#txtUsuario').val(),
        password: $('#txtPassword').val(),
        cargo: $('#txtCargo').val()
    }
    if(campos['nombre'] && campos['apellido'] && campos['dni'] && campos['celular'] && campos['usuario'] && campos['password'] && campos['cargo']){
        $.post('../controlador/CtrlRegistrarUsuario.php', data, function (response){
            console.log(response);
            if(JSON.parse(response)=='true'){
                Swal.fire({
                        title: 'Usuario Registrado!',
                        text: 'El usuario ha sido registrado correctamente',
                        icon: 'success',
                        background: '#121212',
                        color: 'white'
                    });
                $('#formRegistrarUsuario').trigger('reset');
            }else if(JSON.parse(response)=='false'){
                Swal.fire({
                title: 'Error',
                text: 'No se pudo agregar usuario',
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


