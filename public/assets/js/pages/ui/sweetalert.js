$(function () {
    // Cambiando selector en lugar de buscar solo las etiquetas <a> buscara el elemento que tenga el atributo data-type
    // Ahora se puede usar el sweetalert con cualquier elemento sea <button> o <a>
    $('.js-sweetalert [data-type]').on('click', function (e) {
        e.preventDefault(); // Impidiendo que se redireccione directamente por el href de la etiqueta <a>

        var type = $(this).data('type');
        /* My variables */
        var title = $(this).data('title'),
            text = $(this).data('text'),
            objDelete = $(this).data('obj'),
            /**
             * Se indica que la URL a enviar en el formulario se va llenar con el 
             * valor en el atributo data-dir si es una etiqueta <button> o con href si es una etiqueta <a>
             */
            linkURL = getUrl($(this)),
            csrf_token = $('meta[name="csrf-token"]').attr('content');
        
        // alert($(this).get(0).tagName + $(this).data('dir'));
        if (type === 'basic') {
            showBasicMessage();
        }
        else if (type === 'with-title') {
            showWithTitleMessage();
        }
        else if (type === 'success') {
            showSuccessMessage();
        }
        else if (type === 'confirm') {
            showConfirmMessage(title, text, objDelete, linkURL, csrf_token);
        }
        else if (type === 'html-message') {
            showHtmlMessage();
        }
        else if (type === 'autoclose-timer') {
            showAutoCloseTimerMessage();
        }
        else if (type === 'we-set-buttons') {
            showWeSet3Buttons();
        }
        else if (type === 'AJAX-requests') {
            showAJAXrequests();
        }
        else if (type === 'DOM-content') {
            showDOMContent();
        }
    });
});

/**
 * Metodo que retorna la URL donde enviar los datos en el formulario para eliminar
 * @param object element 
 */
function getUrl(element) {
    // Si el elemento que llama al sweetalert es un boton entonces se pasa el valor en el atributo data-dir, sino el valor en el atributo href
    return element.get(0).tagName == 'BUTTON' ? element.data('dir') : element.attr('href');
}

//These codes takes from http://t4t5.github.io/sweetalert/

function showBasicMessage() {
    swal("Hello world!");
}
function showWithTitleMessage() {
    swal("Here's a message!", "It's pretty, isn't it?");
}
function showSuccessMessage() {
    swal("Good job!", "You clicked the button!", "success");    
}

function showConfirmMessage(title, text, objDelete, linkURL, csrf_token) {
    swal({
        title: title,
        text: text,
        icon:'warning',
        buttons:{
            cancel:'Cancelar',
            confirm:{
                text:"Dar de Baja",
                // value:true,
                className:"btn-warning",
                },
        },
        dangerMode: true,
        // content:true,
      })
      .then((willDelete) => {
        if (willDelete) {
            var form = $('<form>',{
                'method':'POST',
                'action':linkURL
            });
            var hiddenInput = $('<input>',{
                'type':'hidden',
                'name':'_method',
                'value':'DELETE'
            });
            var hiddenToken = $('<input>',{
                'type':'hidden',
                'name':'_token',
                'value':csrf_token
            });

            swal(objDelete +" Dado de baja", {
                icon: "error",
                button:true,
            }).then(()=>{
                form.append(hiddenInput).append(hiddenToken).appendTo('body').submit();
            });

        } else {
            swal("","Acción cancelada!","error");
        }
    });
}

function showHtmlMessage() {
    swal({
        title: "HTML <small>Title</small>!",
        text: "A custom <span style=\"color: #CC0000\">html<span> message.",
        html: true
    });
}
function showAutoCloseTimerMessage() {
    swal({
        title: "Auto close alert!",
        text: "I will close in 2 seconds.",
        timer: 2000,
        showConfirmButton: false
    });
}
function showWeSet3Buttons() {
    swal("A wild Pikachu appeared! What do you want to do?", {
        buttons: {
        cancel: "Run away!",
        catch: {
            text: "Throw Pokéball!",
            value: "catch",
        },
        defeat: true,
        },
    })
    .then((value) => {
        switch (value) {
    
        case "defeat":
            swal("Pikachu fainted! You gained 500 XP!");
            break;
    
        case "catch":
            swal("Gotcha!", "Pikachu was caught!", "success");
            break;
    
        default:
            swal("Got away safely!");
        }
    });
}
function showAJAXrequests() {
    swal({
        text: 'Search for a movie. e.g. "La La Land".',
        content: "input",
        button: {
        text: "Search!",
        closeModal: false,
        },
    })
    .then(name => {
        if (!name) throw null;
    
        return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
    })
    .then(results => {
        return results.json();
    })
    .then(json => {
        const movie = json.results[0];
    
        if (!movie) {
        return swal("No movie was found!");
        }
    
        const name = movie.trackName;
        const imageURL = movie.artworkUrl100;
    
        swal({
        title: "Top result:",
        text: name,
        icon: imageURL,
        });
    })
    .catch(err => {
        if (err) {
        swal("Oh noes!", "The AJAX request failed!", "error");
        } else {
        swal.stopLoading();
        swal.close();
        }
    });
}
function showDOMContent() {
    swal("Write something here:", {
        content: "input",
    })
    .then((value) => {
        swal(`You typed: ${value}`);
    });
}
