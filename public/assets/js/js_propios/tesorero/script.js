var dataOrden;
var fecha="";



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Funcion para obtener los datos una orden de lentes
function ordenLentes(){
    var idHCuenta = $('#idHistoriaCuenta').val();

    var idMarco = $('#marco').val();
    var idTipoLente = $('#tipoLente').val();
    var idTipoMaterial = $('#tipoMaterial').val();
    var filtro = $('#filtro').val(); //Filtro se toma como un array cuando hay mas de un valor dentro de el
    var precioMarco=0; //Variable para obtener el precio del marco
    var precioTipoLente=0; //Variable para obtener el precio del tipo de lente
    var precioMaterial=0; //Variable para obtener el precio del material
    var precioFiltro=0; //Variable para obtener la suam de los precios de los filtros
    var precioTotal=0; //Variable para obtener la suma total entre marco, tipo lente, material y los filtros
    var filtroPrecio=[];
////////////////////////////////////////////////////////////
    //Ajax para la fecha de la ultima consulta
    //Traer la historia clinica
    $.ajax({
        type:"GET",
        url:"/getHClinica/"+ $('#nombrePacientes').val(),
        success:function (values){
            $('#historiaClinica').val(values.id_historia_clinica);
            console.log("historia clinica para la fecha: "+values.id_historia_clinica);
            //Traer la fecha de la consulta
            $.ajax({
                type:"GET",
                url:"/getFecha/"+ $('#historiaClinica').val(),
                success:function (values){
                    /*$('#fecha').val(values.fecha);*/
                    fecha = values.fecha;
                    console.log("variable global fecha: "+fecha);
                },error:function (result){
                    console.log("fallo en extraer la fecha");
                    console.log(result);
                }
            })
        },error:function (result){
            console.log(result);
        },complete:function (){

            //Costo de marco, Costo de Material, Costo de tipo lente
            //Ajax para costo de material, tipo de lente y marcos

            $.ajax({
                type:"GET",
                url:"getPrecios/" + idMarco +"/"+ idTipoLente+"/"+idTipoMaterial,
                success:function (precios){
                    precioMarco = precios[0].precio;
                    precioTipoLente = precios[1].precio;
                    precioMaterial = precios[2].precio;
                    precioTotal = precioMarco+precioTipoLente+precioMaterial;

                },complete:function (){
                    console.log("Suma de los precio total sin costo filtro: "+precioTotal);
                }
            })

            ///Hacer un arreglo bidimensional para meter el id de filtro con el precio

            //Costo total de filtros

            $.each(filtro,function (index){
                $.ajax({
                    type:"GET",
                    url:"getPrecioFiltro/"+filtro[index],
                    success:function (precios){

                        precioFiltro += precios.precio;
                        precioTotal += precios.precio;

                        filtroPrecio.push([filtro[index],precios.precio]);

                        $("#montoTotalEstimado").val(precioTotal);
                        dataOrden={id_historia_cuenta:idHCuenta,fecha:fecha,
                            id_marco:idMarco,id_material:idTipoMaterial,id_tipo_lente:idTipoLente,filtros:filtroPrecio,filtroCont:filtro,
                            costo_marco:precioMarco,costo_material:precioMaterial,costo_tipo_lente:precioTipoLente,monto_total:precioTotal,
                            costo_filtros:precioFiltro

                        };
                        console.log(dataOrden);
                    }
                })
            })
        }
    })
////////////////////////////////////////////////////////////


    //Costo de marco, Costo de Material, Costo de tipo lente
    //Ajax para costo de material, tipo de lente y marcos

  /*  $.ajax({
        type:"GET",
        url:"getPrecios/" + idMarco +"/"+ idTipoLente+"/"+idTipoMaterial,
        success:function (precios){
            precioMarco = precios[0].precio;
            precioTipoLente = precios[1].precio;
            precioMaterial = precios[2].precio;
            precioTotal = precioMarco+precioTipoLente+precioMaterial;

        },complete:function (){
            console.log("Suma de los precio total: "+precioTotal);
        }
    })*/

    ///Hacer un arreglo bidimensional para meter el id de filtro con el precio

    //Costo total de filtros
   /* $.each(filtro,function (index){
        $.ajax({
            type:"GET",
            url:"getPrecioFiltro/"+filtro[index],
            success:function (precios){

                precioFiltro += precios.precio;
                precioTotal += precios.precio;

                filtroPrecio.push([filtro[index],precios.precio]);
                console.log("filtro: "+conta+"precio: "+precios.precio );
                console.log("filtroPrecio: "+filtroPrecio);

                $("#montoTotalEstimado").val(precioTotal);

                dataOrden={id_historia_cuenta:idHCuenta,id_plan_pago:idPlanPago,fecha:fecha,
                    id_marco:idMarco,id_material:idTipoMaterial,id_tipo_lente:idTipoLente,filtros:filtroPrecio,filtroCont:filtro.length,
                    costo_marco:precioMarco,costo_material:precioMaterial,costo_tipo_lente:precioTipoLente,/!*monto_total:inputTotal,*!/
                    costo_filtros:precioFiltro

                };
                console.log(dataOrden);
                conta++;
            }
        })
    })*/

}

//Funcion para guardar los datos optenidos en una orden de lentes
function saveOrden(){

    var idPlanPago = $('#getPlanPagos').val();

    var inputTotal = $("#montoTotalEstimado").val();

    var totalTotal={monto_total:inputTotal};

    var planPago={id_plan_pago:idPlanPago};

    var cuotaInicia ={monto_cuota:$('#cuotaInicial').val()};

    Object.assign(dataOrden, totalTotal,planPago);

    console.log(dataOrden);
    console.log($('#cuotaInicial').val());

    var planPa = $("#getPlanPagos > option:selected").text().toLowerCase().trim();

    if(planPa !== String("contado") ){
        Object.assign(dataOrden,cuotaInicia);
    }

    console.log(dataOrden);

   /* $.ajax({
        type:"post",
        data: dataOrden,
        url:"/ordenLentes" ,
        success:function (){
           console.log("nice");
        },error:function (result){
            console.log("bad");
            console.log(result);
        }
    })*/
}

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

    //Ajax para obtener el id de una historia
    $.ajax({
        type:"GET",
        url:"getHistoria/"+id,
        success:function (historiaC){
            $('#idHistoriaCuenta').val(historiaC[0].id_historia_cuenta);
        },error:function (result) {
            console.log(result);
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
            var rows="<option class='text-muted' selected>-- Seleccione un Marco --</option>";
            $.each(marcos,function (key,value) {
                rows += `<option value="${value.id_marco}">${value.cod_marco} </option>`
            });
            $('#marco').html(rows);
        }
    })
})
/*//Funcion para la fecha de la consulta
function fechas(){
    console.log("antes de ajax");
    console.log(fecha);

    $.ajax({
        type:"GET",
        url:"/getHClinica/"+ $('#nombrePacientes').val(),
        success:function (values){
            $('#historiaClinica').val(values.id_historia_clinica);
            console.log("historia clinica para la fecha: "+values.id_historia_clinica);
            //Traer la fecha de la consulta
            $.ajax({
                type:"GET",
                url:"getFecha/"+ $('#historiaClinica').val(),
                success:function (values){
                    /!*$('#fecha').val(values.fecha);*!/
                  fecha = values.fecha;
                  console.log("variable global fecha: "+fecha);
                },error:function (result){
                    console.log("fallo en extraer la fecha");
                    console.log(result);
                }
            })
        },error:function (result){
            console.log(result);
        }
    })
}*/
//Ajax para la imagen del marco
$('#marco').on('change',function (){
    $('#fotoMarco').attr('src', "");
    $.ajax({
        type:"GET",
        url:"getMarcosInfo/" + $('#marco').val(),
        success:function (marcos){
            var dir = "/storage/imagenes/marcos/" + marcos[0].dir_foto ;
            $('#fotoMarco').attr('src', dir);
        }
    })
})
//Ajax para traer los planes de pago en el select del modal
$.ajax({
    type:"GET",
    url:"getPlanPagos",
    success:function (values){
        var rows="<option class='text-muted' disabled selected>-- Plan de Pago --</option>";
        $.each(values,function (key,value) {
            rows += `<option value="${value.id_plan_pago}">${value.plan_pago} </option>`
        });
        $('#getPlanPagos').html(rows);

    }
})
$(function (){

    $("#divCuota").hide();
    //Ajax para rellenar el select con los pacientes
        $.ajax({
            type:"GET",
            url:"allPacientes",
            success:function (pacientes){
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
        url:"getMicas",
        success:function (micas){

            var rows="<option class='text-muted' selected>-- Seleccione un Tipo de Material --</option>";
            $.each(micas,function (key,value) {
                console.log(micas);
                console.log(value.id_mica_marca);
                rows += `<option value="${value.id_marca_material}">${value.marca_material} - ${value.material_mica}</option>`
            });
            $('#tipoMaterial').html(rows);
        }
    })
    //Ajax para rellenar select Filtro
    $.ajax({
        type:"GET",
        url:"getFiltro",
        success:function (filtros){
            var rows/*="<option class='text-muted' selected>-- Seleccione una Material --</option>"*/;
            $.each(filtros,function (key,value) {
                rows += `<option value="${value.id_filtro}">${value.filtro}</option>`
            });
            $('#filtro').html(rows);
        }
    })
    //
    $("#getPlanPagos").on("change",function (){

        var plan = $("#getPlanPagos > option:selected").text().toLowerCase().trim();
        console.log(plan === "contado");



        if (plan === String("contado")){
            $("#divCuota").hide();
        }else {
            $("#divCuota").show();
        }
    })


})


