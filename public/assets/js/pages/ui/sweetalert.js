$(function () {
    // Cambiando selector en lugar de buscar solo las etiquetas <a> buscara el elemento que tenga el atributo data-type
    // Ahora se puede usar el sweetalert con cualquier elemento sea <button> o <a>
    $('.js-sweetalert [data-type]').on('click', function (e) {
        e.preventDefault(); // Impidiendo que se redireccione directamente por el href de la etiqueta <a>

        var type = $(this).data('type');
        /* My variables */
        /* var text 
                contiene el texto que se desplegara en el sweetalert, debera contar con una descripcion de lo que se hara. Ejm. Se eliminara..., se actualizara, etc
            var obj
                Contiene el elemento que se va hacer referencia, ademas de un texto descriptivo. Ejm. Tipo de lente "Objeto", Usuario "Objeto", Marca "Objeto"
        */

        var text = $(this).data('text'),
            obj = $(this).data('obj'),
            /**
             * Se indica que la URL a enviar en el formulario se va llenar con el 
             * valor en el atributo data-dir si es una etiqueta <button> o con href si es una etiqueta <a>
             */
            linkURL = getUrl($(this)),
            csrf_token = $('meta[name="csrf-token"]').attr('content');
        
        // alert($(this).get(0).tagName + $(this).data('dir'));
        if (type === 'confirm') {
            showConfirmMessage(text, obj, linkURL, csrf_token);
        }
        else if (type === 'reactivar') {
            showReactivateMessage(obj, linkURL, csrf_token);
        }
    });
});

/**
 * Metodo que retorna la URL donde enviar los datos en el formulario
 * @param object element 
 */
function getUrl(element) {
    // Element.get(0).tagName -> retorna el tipo de etiqueta del elemento, en mayusculas
    // Si el elemento que llama al sweetalert es un boton entonces se pasa el valor en el atributo data-dir, sino el valor en el atributo href
    return element.get(0).tagName == 'BUTTON' ? element.data('dir') : element.attr('href');
}

//These codes takes from http://t4t5.github.io/sweetalert/
/**
 * Metodo para llamar sweetalert de confirmacion para eliminar
 * @param string text 
 * @param string obj 
 * @param string linkURL 
 * @param string csrf_token 
 */

function showConfirmMessage(text, obj, linkURL, csrf_token) {
    swal({
        title: '¿Estas seguro?',
        text: text,
        icon:'warning',
        buttons:{
            cancel:'Cancelar',
            confirm:{
                text:"Aceptar",
                // value:true,
                className:"btn-warning",
                },
        },
        dangerMode: true,
        // content:true,
      })
      .then((willDelete) => {
        if (willDelete) {
            swal(obj +" Dado de baja", {
                icon: "error",
                button:true,
            }).then(()=>{
                makeForm(linkURL, csrf_token, 'DELETE').submit();
            });
        } else {
            showCancelMessage();
        }
    });
}

/**
 * Metodo para mostrar mensaje para reactivar un elemento con sweetalert
 * @param {*} obj 
 * @param {*} linkURL 
 * @param {*} csrf_token 
 */
function showReactivateMessage(obj, linkURL, csrf_token) {
    swal({
        'title':"¿Estas seguro?",
        'text':'Se reactivara el ' + obj,
        'icon':"warning",
        'buttons':{
            'cancel':'Cancelar',
            'confirm':{
                'text':'Aceptar',
                'className':'btn-warning'
            }              
        },
        'dangerMode':false
    }).then((reactivar) => {
        if(reactivar)
        {
            swal({
                'text':obj +' Actualizado',
                'icon':'success',
                'timer':2000,
                'button':false
            }).then(()=>{
                makeForm(linkURL, csrf_token, 'PUT').submit();
            });
        }
        else{
            showCancelMessage();
        }
    });
}

/**
 * Metodo para mostrar mensaje de cancelacion con sweetalert
 */
function showCancelMessage(){
    swal({
        'text':'¡Acción Cancelada!', 
        'icon':'error'
    });
}

/**
 * Metodo para crear y agregar un formulario reutilizable
 * @param {*} URL 
 * @param {*} csrf_token 
 * @param {*} methodType 
 */
function makeForm(URL, csrf_token, methodType){
    var form = $('<form>', {
        'method':'POST',
        'action':URL
    });
    var hiddenToken = $('<input>', {
        'type':'hidden',
        'name':'_token',
        'value':csrf_token
    });
    var hiddenInput = $('<input>', {
        'type':'hidden',
        'name':'_method',
        'value':methodType
    });

    return form.append(hiddenToken).append(hiddenInput).appendTo('body');
}
