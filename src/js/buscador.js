document.addEventListener('DOMContentLoaded' , function(){
    iniciarApp();

    

});

function iniciarApp(){
    buscarPorFecha();

}

function buscarPorFecha(){
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', function(e){
        const fechaSeleccionada = e.target.value;  //lo que seleecionó el usuario
        window.location = `?fecha=${fechaSeleccionada}`; //redirecciona al usuario por fecha seleccionada por el admin

    });
}