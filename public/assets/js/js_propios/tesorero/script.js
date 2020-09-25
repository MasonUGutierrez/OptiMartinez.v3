
//Cada vez que en el select de pacientes cambie, los campos se actualizaran tambien
$('#nombrePacientes').on('change', function (){

    //Aqui se obtiene el id del paciente del select
    var id = $('#nombrePacientes').val();


    $('#nombre').val(" ");
    $('#apellidoPaciente').val(" ");
    $('#identificacion').val(" ");
    $('#edadPaciente').val(" ");

    //peticion ajax para traer todos los datos de un paciente mediante el id
    $.ajax({
        type:"GET",
        url:"pacienteById/" +id,
        success:function (pacientes){
           $('#nombre').val(pacientes[0].nombres);
           $('#apellidoPaciente').val(pacientes[0].apellidos);
           $('#identificacion').val(pacientes[0].cedula);
           $('#edadPaciente').val(pacientes[0].edad);
        }
    })
})
//Ajax para rellenar el select de Marcos cada que haya cambios en el select de marca
$('#marca').on('change',function (){
    $('#fotoMarco').attr('src', "");
    $('#marco option:selected').remove();
    $('#marco').trigger('change');
    $.ajax({
        type:"GET",
        url:"getMarcos/" + $('#marca').val(),
        success:function (marcos){
            console.log(marcos);
            var rows="<option class='text-muted' selected>-- Seleccione un Marco --</option>";
            $.each(marcos,function (key,value) {
                rows += `<option value="${value.id_marco}">${value.cod_marco} </option>`
            });
            $('#marco').html(rows);
        }
    })
})

//Ajax para la imagen del marco
$('#marco').on('change',function (){
    $('#fotoMarco').attr('src', "");
    $.ajax({
        type:"GET",
        url:"getMarcosInfo/" + $('#marco').val(),
        success:function (marcos){
            var dir = "/storage/imagenes/marcos/" + marcos[0].dir_foto ;
            console.log(dir);
            $('#fotoMarco').attr('src', dir);
        }
    })
})
////////////////////////////////////////////////////////////////////
//Variables par controlar el click en los checkbox tipo lente
var monofocal="";
var bifocal="";
var progresivo="";

//Checkbox Monofocal
$('#monofocal').on('click',function (){
    if (monofocal==0){
        $('#bifocal').attr('disabled','disabled');
        $('#progresivo').attr('disabled','disabled');
        monofocal++;
    }else {
        $('#bifocal').removeAttr('disabled','disabled');
        $('#progresivo').removeAttr('disabled','disabled');
        monofocal--;
    }
})
//Checkbox Bifocal
$('#bifocal').on('click',function (){
    if (bifocal==0){
        $('#monofocal').attr('disabled','disabled');
        $('#progresivo').attr('disabled','disabled');
        bifocal++;
    }else {
        $('#monofocal').removeAttr('disabled','disabled');
        $('#progresivo').removeAttr('disabled','disabled');
        bifocal--;
    }
})
//Checkbox Progresivo
$('#progresivo').on('click',function (){
    if (progresivo==0){
        $('#bifocal').attr('disabled','disabled');
        $('#monofocal').attr('disabled','disabled');
        progresivo++;
    }else {
        $('#bifocal').removeAttr('disabled','disabled');
        $('#monofocal').removeAttr('disabled','disabled');
        progresivo--;
    }
})
////////////////////////////////////////////////////////////////////////////
//Variavles para controlar el click en los checkbox Tipo Material
var plastico="";
var policarbonato="";
var vidrio="";
var antirreflejo="";
var transition="";

//Checkbox Plastico
$('#plastico').on('click',function (){
    if (plastico==0){
        $('#vidrio').attr('disabled','disabled');
        $('#policarbonato').attr('disabled','disabled');
        plastico++;
    }else {
        $('#vidrio').removeAttr('disabled','disabled');
        $('#policarbonato').removeAttr('disabled','disabled');
        plastico--;
    }
})

//Checkbox Policarbonato
$('#policarbonato').on('click',function (){
    if (policarbonato==0){
        $('#vidrio').attr('disabled','disabled');
        $('#plastico').attr('disabled','disabled');
        policarbonato++;
    }else {
        $('#vidrio').removeAttr('disabled','disabled');
        $('#plastico').removeAttr('disabled','disabled');
        policarbonato--;
    }
})

//Checkbox Vidrio
$('#vidrio').on('click',function (){
    if (vidrio==0){
        $('#policarbonato').attr('disabled','disabled');
        $('#plastico').attr('disabled','disabled');
        vidrio++;
    }else {
        $('#policarbonato').removeAttr('disabled','disabled');
        $('#plastico').removeAttr('disabled','disabled');
        vidrio--;
    }
})

$(function (){
    //Ajax para rellenar el select con los pacientes
        $.ajax({
            type:"GET",
            url:"allPacientes",
            success:function (pacientes){
                console.log(pacientes);
                var rows="<option class='text-muted' selected>-- Seleccione un Paciente --</option>";
                $.each(pacientes,function (key,value) {
                    rows += `<option value="${value.id_paciente}">${value.cedula} - ${value.nombres} ${value.apellidos} </option>`
                });
                $('#nombrePacientes').html(rows);
            }
        })

    //Ajax para rellenar el select de marcas
        $.ajax({
            type:"GET",
            url:"getMarcas",
            success:function (marcas){
                console.log(marcas);
                var rows="<option class='text-muted' selected>-- Seleccione una Marca --</option>";
                $.each(marcas,function (key,value) {
                    rows += `<option value="${value.id_marca}">${value.marca}</option>`
                });
                $('#marca').html(rows);
            }
        })

    //Ajax para rellenar select de Tipo lente
    $.ajax({
        type:"GET",
        url:"getLente",
        success:function (lente){
            console.log(lente);
            var rows="<option class='text-muted' selected>-- Seleccione un Tipo de Lente --</option>";
            $.each(lente,function (key,value) {
                rows += `<option value="${value.id_tipo_lente}">${value.tipo_lente}</option>`
            });
            $('#tipoLente').html(rows);
        }
    })
    //Ajax para rellenar select de Tipo material
    $.ajax({
        type:"GET",
        url:"getMaterial",
        success:function (material){
            console.log(material);
            var rows="<option class='text-muted' selected>-- Seleccione un Tipo de Material --</option>";
            $.each(material,function (key,value) {
                rows += `<option value="${value.id_tipo_material}">${value.tipo_material}</option>`
            });
            $('#tipoMaterial').html(rows);
        }
    })
})


