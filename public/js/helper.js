/**
 * Evento para cerrar modal 
 */
window.addEventListener('closeModal', event => {
    $('#modal-'+event.detail.modal).modal('hide');
});

/**
 * Evento para abrir modal
 */
window.addEventListener('openModal', event => {
    $('#modal-'+event.detail.modal).modal('show');
});

/**
 * Evento para Notificar 
 */
window.addEventListener('msj', event => {
    /*
    'alert-success'
    'alert-danger'
    'alert-warning'
    */
    MsgDetallado(event.detail.tipo, event.detail.msj);
});

/**
 * 
 * 
 */
function abrirSala(url){

    //console.log('log abrirSala(): '+urlmeet);

    //var win = window.open(url, '_blank');
    var win = window.location.href = url;
    if (win) {
        //Browser has allowed it to be opened
        win.focus();
    } else {
        //Browser has blocked it
        alert('Please allow popups for this website');
    }

}

/**
 * Evento para Notificar que el usuario se Actualizo con exito
 */
window.addEventListener('UserUpdate', event => {
    MsgDetallado('alert-success', 'Usuario Actualizado con exito...');
});

/**
 * Evento para Notificar que el Registro se  Actualizo con exito
 */
 window.addEventListener('update', event => {
    MsgDetallado('alert-success', 'Registro Actualizado con exito...');
});

/**
 * Evento para Notificar que el Registro se creo con exito
 */
 window.addEventListener('success', event => {
    MsgDetallado('alert-success', 'Registro Creado con exito...');
});

/**
 * Evento para Notificar que el Registro se creo con exito
 */
 window.addEventListener('success-msj', event => {
    MsgDetallado('alert-success', event.detail.msj);
});

/**
 * Evento para Notificar que el Registro se creo con exito
 */
 window.addEventListener('ticket-success', event => {
    MsgDetallado('alert-success', 'Ticket Asignado a soporte con exito...');
});

/**
 * Evento para Notificar que el Registro se Elimino con exito
 */
 window.addEventListener('Delete', event => {
    MsgDetallado('alert-success', 'Registro Eliminado con exito...');
});

/**
 * Evento para validar la eliminar Registro
 */
 window.addEventListener('eliminar', event => {

    $('#toast-container').remove();
  
    var mensaje="¿Desea eliminar el registro?";
    var tipo="error";
    
    toastr[tipo]("<br /><button type='button' id='okBtn' class='btn mr-1 btn-primary'>Si</button><button type='button' id='cancelBtn' class='btn ml-1 '>No</button>",mensaje,
   {
       closeButton: false,
       allowHtml: true,
       tapToDismiss :  false,
       timeOut: 0,
       onShown: function (toast) {
           $("#okBtn").click(function(){
               window.livewire.emit('say-delete',event.detail.id);
               $('#cancelBtn').click();
           });
           $("#cancelBtn").click(function(){
               toastr.remove();
           });
        }
   });
    
});

/**
 * Funcion para lanzar un mensaje toast detallado
 */
function MsgDetallado(tipo, Msg, idContent = "MsgForm"){
    console.log('msg_detallado');
    if(tipo == 'alert-success'){
        tipo='success';
    }else if(tipo == 'alert-danger'){
        tipo='error';
    }else if(tipo == 'alert-warning'){
        tipo='warning';
    }
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr[tipo]('<div>'+Msg+'</div>');
}

/**
 * Funcion para lanzar un mensaje toast simple
 */
function Msg(texto){
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "2000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
    toastr['warning']('<div>'+texto+'</div>');
}

/**
 * Funcion para lanzar un mensaje toast de error
 */
function MsgError(texto){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "2000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr['error']('<div>'+texto+'</div>');
}

/**
 * Funcion para lanzar un mensaje toast de confirmacion de eliminado
 */
function MsgEliminar(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "2000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr['success']('<div> Registro eliminado con éxito </div>');
}

/**
 * Funcion para capturar formdata
 */
function formData(id){
    console.log(id);
    return new FormData($('#'+id)[0]);
}

/**
 * Funcion para capturar token
 */
function token(){
    return $('input[name="_token"]').val();
}

/**
 * Funcion para limpiar Form
 */
function cleanForm(idformulario) {
    $('#'+idformulario)[0].reset();
}
