const URL_STORE = "/historias-clinicas";
const URL_UPDATE = "/historias-clinicas/"+$('#historiasid').val();
const _method = $('#method').val();

$(function(){
    if(_method != 'PUT'){
        data();
    }
    setAnanmesisFields();

    setEvents();
});

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ajaxComplete(function(){
    // $('[data-toggle="tooltip"]').tooltip(); 

    $('.darBaja').on('click', function(event){
        event.preventDefault();
        // console.log('Probando Swal');
        swal({
            title:'¿Estás seguro?',
            text:$(this).data('text'),
            icon:'warning',
            buttons:{
                cancel:'Cancelar',
                confirm:{
                    text:'Aceptar',
                    className:'btn-warning'
                }
            },
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                swal($(this).data('obj') + " dada de baja",{
                    icon:"success",
                    button:"Aceptar"
                }).then(()=>{
                    fnDelete($(this));
                });
            }  
            else{
                cancelSwal();
            }
        });
    });
});

// funcion para establecer los eventos en los inputs despues del steps.destroy
const setEvents = function(){
    /* Eventos model AddPaciente*/
    // Limpiando los errores de todas las ventanas steps si se cierra el modal
    $('#AddPaciente').on('hide.bs.modal', function(){
        var form = $('#hclinica_form');
        form.find($('.current')).removeClass('error');

        form.validate().resetForm(); // Reseteando los errores
        setAnanmesisFields(); // Seteando los valores en los campos de Ananmesis

        /*
          Validacion para deschequear el input que indica 
          si tiene cedula o no
        */               
        var initial = $('#checkCedula').is(':checked');
        if (initial && isEmpty($('#edad').val())){
            $('#cedula').prop('disabled', false);
            $('#cedObl').show();
            $('#checkCedula').prop('checked', false)
                             .prop('disabled', false);                 
        } 
    });

    $('#AddPaciente').on('shown.bs.modal', function(){
        if($('#checkContainer').is(':hidden') && isEmpty($('#cedula').val())){
            $('#checkContainer').show(); 
        }
    });

    /* Eventos para el campo fecha_nacimiento */

    var fechaNacimiento = $('#fecha_nacimiento'); 
            
    // Evento change en el input fechaNacimiento para setear el valor al input edad
    fechaNacimiento.on('change', function(e){
        console.log(e.target.valueAsNumber);
        $('#edad').val(parseInt(calculateAge(e.target.valueAsNumber)));
    });

    // Evento blur(perder focus) en el input de fechaN.. para automaticamente 
    // chequear que no tiene cedula por tener una edad no permitida
    fechaNacimiento.on('blur', function(e){
        console.log(!isEmpty($('#edad').val()));
        
        // Number() convierte una "" a 0, parseInt() la convierte en NaN
        if(parseInt($('#edad').val()) < 16){
            $('#checkCedula').prop('checked', true)
                                .prop('disabled', true);
            $('#cedula').prop('disabled', true);
            $('#cedObl').hide();
        }
        else{
            $('#checkCedula').prop('checked', false)
                                .prop('disabled', false);
            $('#cedula').prop('disabled', false);
            $('#cedObl').show();
        }
    });

    // Asignando valor en la propiedad fecha maxima por jquery
    fechaNacimiento.attr('max', function(){
        var fechaHoy = new Date();
        var dd = fechaHoy.getDate();
        var mm = fechaHoy.getMonth() + 1; // +1 porque se tiene en cuenta que Enero es 0

        if(dd < 10) dd = "0" + dd;
        if(mm < 10) mm = "0" + mm;

        return fechaHoy.getFullYear() + '-' + mm + '-' + dd; 
        /* Forma en que tenia antes, se resumia toda la operacion en el return, pero se ve mejor de la forma de arriba*/
        // return fechaHoy.getFullYear() + '-' + (((fechaHoy.getMonth() + 1) < 10) ? '0'+(fechaHoy.getMonth()+1) : (fechaHoy.getMonth()+1)) + '-' + ((fechaHoy.getDate() < 10) ? '0' + fechaHoy.getDate() : fechaHoy.getDate()); 
    });

    /* Eventos para la cedula */
    if($('#cedula').val())
        $('#checkContainer').hide();

    // Evento keyup para ocultar el check de cedula si empieza a escribir una cedula
    $('#cedula').on('keyup', function(){
        if(isEmpty($(this).val())){
            $('#checkContainer').show();
        }
        else{
            $('#checkContainer').hide();
        }
    });

    // Evento click sobre el checkbox que indica si es menor de edad
    $('#checkCedula').on('click', function(){
        var input = $('#cedula'); 
        var labelRequired = $('#cedObl');
        // var pattCedula= /^\d{3}[-]{0,1}([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-1]{1})([0]{1}[1-9]{1}|[1]{1}[0-2]{1})\d{2}[-]?\d{4}[a-z]{1}$/i;

        if($(this).is(":checked")){                    
            labelRequired.hide(); // document.querySelector("#cedObl").style.display = "none";
            input.prop('disabled', true);
            console.log(typeof input.val());
            // if(!isEmpty(input.val()) && !(pattCedula.test(input.val())))
                input.val("");

            // Quitando los errores lanzados por form.validate();
            input.removeClass("error");
            $("#cedula + label.error").remove();
        }
        else{                    
            labelRequired.show(); // document.querySelector("#cedObl").style.display = "inline";
            input.prop('disabled', false);
        }
    });

    $('#prueba').on('click', function(event){
        if($.trim($('#cedula').val()).length > 0)
            $.ajax("/historias-clinicas/getCedula/"+$('#cedula').val(),{
                type:'POST',
                success:function(datas, status, jqXHR){
                    console.log(datas);
                    if(datas=="true"){
                        $('#mostrar').text("Ya existe un registro con la cedula ingresada");
                    }
                }
            });
    })
}

/**
 * Funcion para habilitar o deshabilitar los campos en el formulario
 *
 * @param boolean state - el valor true para habilitar, false para deshabilitar 
 */
const enableFields = function (state){
    $('#nombres').prop('disabled', (state)?false:true);
    $('#apellidos').prop('disabled', (state)?false:true);
    $('#fecha_nacimiento').prop('disabled', (state)?false:true);
    $('#maleRadio').prop('disabled', (state)?false:true);
    $('#femaleRadio').prop('disabled', (state)?false:true);
    $('#cedula').prop('disabled', (state)?false:true);
    $('#checkCedula').prop('disabled', (state)?false:true);
    $('#telefono').prop('disabled', (state)?false:true);
    $('#direccion').prop('disabled', (state)?false:true);
    $('#h_ocular').prop('disabled', (state)?false:true);
    $('#h_medica').prop('disabled', (state)?false:true);
    $('#medicaciones').prop('disabled', (state)?false:true);
    $('#alergias').prop('disabled', (state)?false:true);
}

const initStepTab = function (){
    console.log("hola has ejecutado initStepTab");
    var form = $('#editHClinica').show();

    form.steps({
        // Apariencia
        headerTag: 'h3',
        bodyTag: 'fieldset',
        cssClass: 'tabcontrol',

        // Plantilla
        titleTemplate: '#title#',

        // Comportamiento
        enableAllSteps: true,
        enablePagination: false,
        enableFinishButton: false,

        // Transicion
        transitionEffect: 'slideLeft',            
    });
}

/**
 * Funcion para las librerias validate() y steps()
 * 
 * @param {string} type 
 */
const initValidateStep = function (type){
    var form = $((type=='PUT')?'#editHClinica':'#hclinica_form').show();

    validateRules(form);
    
    form.steps({
        /*Apariencia*/
        headerTag: 'h3',
        bodyTag: 'fieldset',
        transitionEffect: 'slideLeft',
        cssClass: 'wizard',

        /*Etiquetas*/
        labels:{
            cancel: 'Cancelar',
            current: 'Posicion Actual:',
            finish: 'Registrar',
            previous: 'Anterior',
            next: 'Siguiente',
            loading: 'Cargando ...'
        },

        /*Eventos*/
        onStepChanging: function(event, currentIndex, newIndex){
            // Permitir que se mueva la pestaña anterior aunque el formulario no sea valido
            if (currentIndex > newIndex)
            {
                return true;
            }

            // En caso que el usuario regrese a la pagina siguiente donde el formulario daba error, se limpian las notificaciones de error
            if (currentIndex < newIndex)
            {
                // Limpiando los errores en el formulario
                form.find('.body:eq(' + newIndex + ') label.error').remove();
                form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
            }
            form.validate();
            return form.valid();
        },
        onFinishing: function(event, currentIndex){
            form.validate();
            return form.valid();
        },
        onFinished: function(event, currentIndex){
            fnStore(type);
            swal({
                title: "Bien Hecho",
                text: "Historia clinica " +((type=="POST")?"registrada":"actualizada"),
                icon:'success',
            }).then(()=>{
                form.steps('reset');
                if(type == "POST"){ 
                    $("#AddPaciente").modal('toggle');                    
                    fnClearFields();
                }
                else{
                    form.removeClass('wizard');
                    form.steps('destroy');
                    
                    $('[data-id=medidasTitle]').appendTo('#editHClinica');
                    $('[data-id=medidasContainer]').appendTo('#editHClinica');
                    $('#containerBtnCancelar').hide();
                    $('#containerBtnEditar').show();
                    
                    enableFields(false);
                    // $('#stepsCard').load(location.href+" #stepsCard");
                    getHistoriaEditForm();
                    initStepTab();
                }
                
            });
        },
    });             
}  

const validateRules = function(elemetForm){
    elemetForm.validate({
        rules: {
            nombres:{
                minlength: 3,
                required: true,
            },
            apellidos:{
                required: true,
                minlength: 4,
            },
            fecha_nacimiento:{
                required: true,
                date: true,
            },
            edad:{
                required:{
                    depends: function(element){
                        return isEmpty($('#fecha_nacimiento').val());
                    }
                },
                number: true,
            },
            sexo:{
                required: true,
                minlength: 1
            },
            cedula:{
                minlength:14,
                maxlength:16,
                validIdCard: true,
                required:{
                    depends: function(element){
                        // var isChecked = $('#checkCedula').is(':checked');
                        // return !isChecked;
                        // Si esta checkeado entonces no es requerido el campo cedula
                        return $('#checkCedula').is(':checked') ? false : true;
                    }
                }
            },
            telefono:{
                minlength: 8,
                maxlength: 15,
                validPhone: true,
                required:true,
            },
            direccion:{
                minlength: 4, // minimo de 4 caracteres por el nombre mas pequeño de departamento  
            },
            h_ocular:{
                minlength:3,
            },
            h_medica:{
                minlength:3,
            },
            medicaciones:{
                minlength:3,
            },
            alergias:{
                minlength:3,
            }
        }
    });

    // Creando regla propia de validacion
    jQuery.validator.addMethod('validPhone', function(value, element){
        var pattern = /^(([\+]{1}(505){1}){0,1}|([(]{1}(505){1}[)]{1}){0,1})(\s|[-])?[^0-1]{1}[0-9]{3}(\s|[-])?\d{4}$/;
        
        return this.optional(element) || pattern.test(value);
    }, "Por favor, ingrese un número telefónico válido"); 
    
    jQuery.validator.addMethod('validIdCard', function(value, element){
        let pattern = /^\d{3}[-]{0,1}([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-1]{1})([0]{1}[1-9]{1}|[1]{1}[0-2]{1})\d{2}[-]?\d{4}[a-z]{1}$/i;

        return this.optional(element) || pattern.test(value);
    }, "Por favor, ingrese un número de cedula válida");
    
   /*  jQuery.validator.addMethod('uniqueCard', function(value, element){
        var flag;
        $.ajax("/historias-clinicas/getCedula/"+$('#cedula').val(),{
            type:'POST',
            success:function(datas, status, jqXHR){
                console.log(datas);
                if(datas=="true")
                    flag = false;
                else
                    flag = true;
            }
        });
        return element.optional() || flag;
    }, "Ya existe un registro con la cedula ingresada"); */

}

const stateAlert = function(state){
    if(parseInt(state))
        $('#alertContainer').hide();
    else   
        $('#alertContainer').show();
}

/**
 * Funcion para rellenar el formulario con la info nueva de la historia cuando esta se actualiza
 */
const getHistoriaEditForm = function(){
    $.ajax({
        url:'/historias-clinicas/gethistoria/'+$('#historiasid').val(),
        type:'GET',
        dataType:'json',
        success:function(datas, status, jqXHR){
            console.log(datas.hclinica);
            console.log(datas.paciente);

            
            // Campos Datos Personales
            $('#nombres').val(datas.paciente.nombres);
            $('#apellidos').val(datas.paciente.apellidos);
            $('#fecha_nacimiento').val(datas.paciente.fecha_nacimiento);
            $('#edad').val(datas.paciente.edad);
            switch(datas.paciente.sexo){
                case 'masculino':
                    $('#maleRadio').prop('checked', true);
                    break;
                case 'femenino':
                    $('#femaleRadio').prop('checked', true);
                    break;
            }
            $('#cedula').val(datas.paciente.cedula);
            $('#telefono').val(datas.paciente.telefono);
            $('#direccion').val(datas.paciente.direccion);
            // Campos Ananmesis
            $('#h_ocular').val(datas.hclinica.h_ocular);
            $('#h_medica').val(datas.hclinica.h_medica);
            $('#medicaciones').val(datas.hclinica.medicaciones);
            $('#alergias').val(datas.hclinica.alergias);

            // Seteando el estado del alert completo
            stateAlert(datas.hclinica.completo);
        },
        error: function(jqXHR, statusText, errorThrown){
            console.log('Error: '+errorThrown);
            console.log('Status: '+statusText);
            console.log('Jquery XMLHTTPRequest object: ');
            console.log(jqXHR);
        }
    });
}

// Funcion para setear los valores en los inputs del apartado Ananmesis
const setAnanmesisFields = function (){
    //Evento blur(perder focus) en los campos de Ananmesis         
    $('#h_ocular, #h_medica, #medicaciones, #alergias').on('blur', function(){
        if(isEmpty($(this).val())) $(this).val("N/A");
    });
    //Evento focus en los campos de Ananmesis para que borre el valor si esta en N/A
    $('#h_ocular, #h_medica, #medicaciones, #alergias').on('focus', function(){
        if($.trim($(this).val()) == "N/A") $(this).val("");
    });

    validEmptyAnanmesisFields($("#h_ocular"));
    validEmptyAnanmesisFields($("#h_medica"));
    validEmptyAnanmesisFields($("#medicaciones"));
    validEmptyAnanmesisFields($("#alergias"));
}

const validEmptyAnanmesisFields = function(element){
    if(isEmpty(element.val()) || element.val() == "NULL"){
        //Seteando el valor por defecto N/A en los campos seleccionados por IDs
        element.val("N/A");
    }
}

// Funcion para determinar si una str es vacia
const isEmpty = function (str){
    // Validar si es una cadena vacia y sin espacios en blanco
    return ($.trim(str).length === 0) ? true : false;
};

// Funcion para determinar la edad basado en una fecha de nacimiento
const calculateAge = function (fechaNac){
    let fechaHoy = new Date();
    let fechaN = new Date(parseInt(fechaNac));

    /*Sumando un dia al dia de nacimiento porque el input date envia un dia anterior*/
    fechaN.setDate(fechaN.getDate() + 1);

    // Obteniendo la diferencia de tiempo en milisegundos entre las 2 fechas
    let difMs = fechaHoy.getTime() - fechaN.getTime();

    // Como lo tenia antes pero daba error
    /* let añosTranscurrido = difMs / 1000 / 60 / 60 / 24 / 365; */

    // Se crea una nueva instancia del objeto Date a partir de los milisegundos obtenidos
    let fechaDif = new Date(difMs); 

    // Aun no entiendo porque se debe restar 1970 al año UTC de la fecha obtenida de la diferencia de tiempo entre las fechas
    // Pero da bien el resultado de la diferencia de años
    return Math.abs(fechaDif.getUTCFullYear() - 1970);
};

const cancelSwal = function (){
    swal({
        text:'¡Acción Cancelada!',
        icon: 'error',
        button: 'Aceptar'
    });
};

const fnDelete = function (element){
    $.ajax(element.attr('href'),{
        type:'DELETE',
        success:function(datas, status, jqXhr){
            console.log('Message: ' + datas);
            data();
        },
        error:function(jqXhr, textStatus, errorThrown){
            console.log('status: ' + textStatus);
            console.log('error: ' + errorThrown);
            console.log('jQuery XMLHTTPRequest object: \n');
            console.log(jqXhr);
        }
    });
};

const fnClearFields = function (){
    $('#nombres').val("");
    $('#apellidos').val("");
    $('#fecha_nacimiento').val("");
    $('#edad').val("");
    $('#maleRadio').prop('checked', true);
    $('#cedula').val("");
    $('#telefono').val("");
    $('#direccion').val("");
    $('#h_ocular').val("");
    $('#h_medica').val("");
    $('#medicaciones').val("");
    $('#alergias').val("");
};

/**
 * Funcion para guardar un registro
 * 
 * @param {string} type - para indicar si va guardar o actualizar un registro
 */
const fnStore = function (type){
    var sendData = {       
        nombres:$('#nombres').val(),
        apellidos:$('#apellidos').val(),
        fecha_nacimiento:$('#fecha_nacimiento').val(),
        edad:parseInt($('#edad').val()),
        sexo:$('[name="sexo"]:checked').val(),
        cedula:$('#cedula').val(),
        telefono:$('#telefono').val(),
        direccion:$('#direccion').val(),
        flagWho:$('#flagWho').val(),
    };
    var fieldsAnanmesia = {
        h_ocular:$('#h_ocular').val(),
        h_medica:$('#h_medica').val(),
        medicaciones:$('#medicaciones').val(),
        alergias:$('#alergias').val(),
    }

    /* Si quien guarda un usuario optometrista entonces se agregan al senData los campos de ananmesis */
    if($('#flagWho').val() == "optometrista"){
        Object.assign(sendData, fieldsAnanmesia);
    }
    
    // console.log(typeof sendData.edad);
    // console.log(sendData);

    $.ajax({
        type: (type=="POST") ? 'POST' : 'PUT',
        dataType: 'json',
        data: sendData,
        // url: `{{action('OpticaControllers\HClinicaController@store')}}`,
        url: (type=="POST") ? URL_STORE : URL_UPDATE,
        success: function(datas){
            if(type == "POST"){
                console.log(datas.nombres + ' Registrado!!');
                fnClearFields(); 
                // $('.dataTable-hc').DataTable().ajax.reload();
                data();
            }
            else{
                console.log(datas.nombres + ' Actualizado!!');  
            }         
        },
        error: function(jqXHR, statusText, errorThrown){
            console.log('Error::'+errorThrown);
            console.log('Error::'+statusText);

            console.log(jqXHR);
        }
    });   
}

const data = function(){
    // Agregando directamente el responseJSON devuelto del controlador al DataTable
    $('.dataTable-hc').DataTable({
        responsive:true,
        destroy:true,
        // processing:true,
        serverSide:true,
        ajax: {
            url:'historias-clinicas/all',
            type:'GET'
            // dataSrc: ''
        },
        columns:[
            {data:'id_historia_clinica',width: "10%"},
            {data:'paciente'},
            {data:'edad'},
            {data:'telefono'},
            {data:'fecha_registro',width:"20%"},
            {data:'opciones', name:"opciones", orderable:false, searchable: false, width:"20%"}
        ],
        lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "Todo"]],
        language:{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
};