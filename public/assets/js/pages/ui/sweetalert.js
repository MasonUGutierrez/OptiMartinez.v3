$(function () {
    $('.js-sweetalert a').on('click', function (e) {
        e.preventDefault(); // Impidiendo que se redireccione directamente por el href de la etiqueta <a>

        var type = $(this).data('type');
        /* My variables */
        var title = $(this).data('title'),
            text = $(this).data('text'),
            objDelete = $(this).data('obj'),
            linkURL = $(this).attr('href'),
            csrf_token = $('meta[name="csrf-token"]').attr('content');

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

function sleep(milliseconds) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < milliseconds);
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
                icon: "info",
                buttons:false,
            });
            form.append(hiddenInput).append(hiddenToken).appendTo('body').submit();

        } else {
            swal("Acción cancelada!");
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
