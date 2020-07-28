/**
* @author Ing.Noe Ramos Lopez
* @version 1.0
* @copyright Todos los derechos resevados 2019
*/


var loaderPage = $('.preloader');
var estadoSelect = '';
var tipoPersonaSelect = '';

/**
* funcionalidad para detectar el precionado de las teclas en cada uno de los campos
* del formulario de alta obligatorios si el campo esta vacio  se agrega una clase
* para indicar que no es valida, de lo contrario se quita esa clase y se pone la clase is-valid.
* @param apellido paterno
* @param apellido materno
* @param nombre del propietario
* @param razon social
* @param rfc
* @param calle
* @param colonia
* @param codigo postal
* @param celular
* @param email
* @param estado
* @param tipo de persona
*/
$(function(){
    //validaciones para los inputs
    $('#nombresProp').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#nombresProp').removeClass("is-invalid");
            $('#nombresProp').addClass("is-valid");
        }else{
            $('#nombresProp').addClass("is-invalid");
        }
    });

    $('#razSoProp').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#razSoProp').removeClass("is-invalid");
            $('#razSoProp').addClass("is-valid");
        }else{
            $('#razSoProp').addClass("is-invalid");
        }
    });

    $('#rfcProp').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#rfcProp').removeClass("is-invalid");
            $('#rfcProp').addClass("is-valid");
        }else{
            $('#rfcProp').addClass("is-invalid");
        }
    });

    //validamos combobox de tipo de persona
    $("#tipoPerProp").on('change',function(){
        tipoPersonaSelect = $(this).val();
        if(tipoPersonaSelect === '0'){
            $('#tipoPerProp').addClass("is-invalid");
        }else{
            $('#tipoPerProp').removeClass("is-invalid");
            $('#tipoPerProp').addClass("is-valid");
        }
    });
});


/**
* Funcionalidad para el validamiento de campos del formulario para editar
* al propietario.
* @param apellido paterno
* @param apellido materno
* @param nombre del propietario
* @param razon social
* @param rfc
* @param calle
* @param colonia
* @param codigo postal
* @param celular
* @param email
* @param estado
* @param tipo de persona
*/
$(function(){
    
    $('#nombresPropEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#nombresPropEdt').removeClass("is-invalid");
            $('#nombresPropEdt').addClass("is-valid");
        }else{
            $('#nombresPropEdt').addClass("is-invalid");
        }
    });

    $('#razSoPropEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#razSoPropEdt').removeClass("is-invalid");
            $('#razSoPropEdt').addClass("is-valid");
        }else{
            $('#razSoPropEdt').addClass("is-invalid");
        }
    });

    $('#rfcPropEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#rfcPropEdt').removeClass("is-invalid");
            $('#rfcPropEdt').addClass("is-valid");
        }else{
            $('#rfcPropEdt').addClass("is-invalid");
        }
    });

    //validamos combobox de tipo de persona para editar
    $("#tipoPerPropEdt").on('change',function(){
        tipoPersonaSelect = $(this).val();
        if(tipoPersonaSelect === '0'){
            $('#tipoPerPropEdt').addClass("is-invalid");
        }else{
            $('#tipoPerPropEdt').removeClass("is-invalid");
            $('#tipoPerPropEdt').addClass("is-valid");
        }
    });
});

/**
* funcinalidad para hacer la validacion de los campos
* del formulario de propietarios en caso de que no sea valido
* agrega una clase al campo que no paso la valdiacion y mustra un pop-up
* indicando que tal campo no puede estar vacio.
* @param idCli
* @param nombre
* @param appaterno
* @param apmaterno
* @param razon social
* @param rfc
* @param calle
* @param colonia
* @param codigo postal
* @param celular
* @param email
* @param tipo de persona
*/
$(function(){

	$("#form_alta_propietario").submit(function(){

        var formValid = true;

        //validamos formulario
        if($("#idProp").val() === null || $("#idProp").val() === ""){
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El id del Propietario no puede estar vacio!' });
            formValid = false;
        }else if($("#nombresProp").val() === null || $("#nombresProp").val() === ""){
            $('#nombresProp').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del propietario no puede estar vacia!' });
            formValid = false;
        }else if($("#razSoProp").val() === null || $("#razSoProp").val() === ""){
            $('#razSoProp').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Razon Social no puede estar vacia!' });
            formValid = false;
        }else if($("#rfcProp").val() === null || $("#rfcProp").val() === ""){
            $('#rfcProp').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El RFC no puede estar vacia!' });
            formValid = false;
        }else if($("#tipoPerProp").val() === '0'){
            $('#tipoPerProp').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe seleccionar un tipo de persona!' });
            formValid = false;
        }

        if(formValid){
            loaderPage.fadeIn();

            $.ajax({
                url:BASE_PATH + 'catalogosGenerales/catalogoGeneral/saveInfoCat',
                type:'POST',
                dataType:'json',
                data:{
                    paterno : $('#appaternoProp').val(),
                    materno : $("#apmaternoProp").val(),
                    nombre :$('#nombresProp').val(),
                    social : $("#razSoProp").val(),
                    rfc : $("#rfcProp").val(),
                    calle : $("#calleProp").val(),
                    col : $("#colProp").val(),
                    cp : $("#cpProp").val(),
                    estado : $("#estadoProp option:selected").text(),
                    cel : $("#celProp").val(),
                    tel : $("#telProp").val(),
                    email : $("#emailProp").val(),
                    tipoPer : $("#tipoPerProp").val(),
                    tipoSave : 'C'
                },
                success:function(json) {
                    //Validamos si el codigo de respuesta es 200
                    if(json.response_code === "200"){

                        //se debe de obtener de la base
                        $("#idProp").attr("value",json.nextIdCat);

                        //damos click al boton de reinciar
                        $("#btnResetProp").click();

                        //recargamos la tabla de registros
                        fillTableProp(json);

                        loaderPage.fadeOut();
                        Swal.fire({ type: 'success', title: 'Registro Exitoso!', text: "Se guardo la informacion Correctamente!" });

                    // en caso de que no sea 200 se verifica si es 400 y se muestra un mensaje de error
                    }else if(json.response_code === "400"){
                        loaderPage.fadeOut();
                        Swal.fire({ type: 'error', title: 'Oops...', text: json.response_msg });
                    }
                },
                error : function(xhr, status) {
                    loaderPage.fadeOut();
                    Swal.fire({ type: 'error', title: 'Oops...', text: 'Ocurrio un problema intentalo mas tarde!' });
                }
            });
        }
        return false;
    });

});

/**
* funcionalidad para el boton
* de limpiar el formulario.
* aparte de limpiar los campos 
* les quita las clases de is-valid y is-invalid
*/
$(function(){
    // quitamos las clases de valido e invalido
    $("#btnResetProp").click(function(){
        // campo 1
        $('#appaternoProp').removeClass("is-invalid");
        $('#appaternoProp').removeClass("is-valid");
        // campo 2
        $('#apmaternoProp').removeClass("is-invalid");
        $('#apmaternoProp').removeClass("is-valid");
        // campo 3
        $('#nombresProp').removeClass("is-invalid");
        $('#nombresProp').removeClass("is-valid");
        // campo 4
        $('#razSoProp').removeClass("is-invalid");
        $('#razSoProp').removeClass("is-valid");
        // campo 5
        $('#rfcProp').removeClass("is-invalid");
        $('#rfcProp').removeClass("is-valid");
        // campo 6
        $('#calleProp').removeClass("is-invalid");
        $('#calleProp').removeClass("is-valid");
        // campo 7
        $('#colProp').removeClass("is-invalid");
        $('#colProp').removeClass("is-valid");
        // campo 8
        $('#cpProp').removeClass("is-invalid");
        $('#cpProp').removeClass("is-valid");
        // campo 9, combobox
        $('#estadoProp').removeClass("is-invalid");
        $('#estadoProp').removeClass("is-valid");
        // campo 10
        $('#celProp').removeClass("is-invalid");
        $('#celProp').removeClass("is-valid");
        // campo 11, no es ibligatorio
        $('#telProp').removeClass("is-invalid");
        $('#telProp').removeClass("is-valid");
        // campo 12
        $('#emailProp').removeClass("is-invalid");
        $('#emailProp').removeClass("is-valid");
        // campo 13, combobox
        $('#tipoPerProp').removeClass("is-invalid");
        $('#tipoPerProp').removeClass("is-valid");
    }); 
});

/**
* accion para el boton delete cleinte
* de la tabla, obtiene el id del propietario
* y pregunta si estamos seguros de eleiminar el resgrustro
* si damos en si envia una peticion ajax
* la cual envia el id al cual se le hara la baja logica
* y se borrara el registro de la tabla
* @param id_cli
*/
$(function(){
    var id_clie = '0';
    $("#table_propietarios").on('click','.delete-prop',function(){
        
        id_prop = $(this).attr('data-id');

        //Se pregunta si quiere eliminar el archivo
        Swal.fire({
                title: '¿Esta seguro?',
                text: "No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Borrar Registro!'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url:BASE_PATH + 'catalogosGenerales/catalogoGeneral/updateInfoCat',
                        type:'POST',
                        dataType:'json',
                        data:{
                            idRowCat : id_prop,
                            tipoUp : 'D',
                            tipoCat : 'C'
                        },
                        success:function(json) {
                            if(json.response_code === "200"){
                                $("#tr-"+id_prop).remove();
                                Swal.fire( 'Borrado!', 'El Propeedor fue eliminado con exito!', 'success');
                            }else{
                                console.log(json.response_msg);
                            }
                        },
                        error : function(xhr, status) {
                            console.log("algo salio mal");
                        }
                    });
                }
            });
    });
});

/**
* Funcion que trae la informacion de un propietario
* que se muestre en la tabla
* @param id_cli_edit
*/
$(function(){
    var id_prop_edit = '0';
    $("#table_propietarios").on('click','.edit-prop',function(){
        id_prop_edit = $(this).attr('data-id');
        //funcion ajax para hacer la busqueda
        $.ajax({
            url:BASE_PATH + 'catalogosGenerales/catalogoGeneral/selectInfoCat',
            type:'POST',
            dataType:'json',
            data:{
                idRowCat : id_prop_edit,
                tipoSelectCat : 'C'
            },
            success:function(json) {
                //si todo sale bien muestra el modal con la info del propietario
                if(json.response_code === "200"){

                    $("#idPropEdt").attr("value",json.cliente.Id_Propietario);
                    $('#appaternoPropEdt').val(json.cliente.APaterno);
                    $("#apmaternoPropEdt").val(json.cliente.AMaterno);
                    $('#nombresPropEdt').val(json.cliente.Nombres);
                    $("#razSoPropEdt").val(json.cliente.RazonSocial);
                    $("#rfcPropEdt").val(json.cliente.RFC);
                    $("#callePropEdt").val(json.cliente.Calle);
                    $("#colPropEdt").val(json.cliente.Colonia);
                    $("#cpPropEdt").val(json.cliente.CP);
                    $("#estadoPropEdt option:contains("+json.cliente.Estado+")").attr('selected', true);
                    $("#celPropEdt").val(json.cliente.Celular);
                    $("#telPropEdt").val(json.cliente.Telefono);
                    $("#emailPropEdt").val(json.cliente.email);
                    $("#tipoPerPropEdt option:contains("+json.cliente.Tipo_Persona+")").attr('selected', true);
                    //mostramos la modal con la informacion cargada
                    $("#modalPropietarioEdit").modal('show');
                        
                }else{
                    
                }
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });
    });
});

/**
* Funcion para la actualizacion de un la informaicon de un propietario.
* @param id del propietario
* @param nombre del propietario
* @param apellido paterno
* @param apellido materno
* @param razon social
* @param rfc
* @param calle
* @param colonia
* @param codigo postal
* @param celular
* @param email
* @param estado
* @param tipo de persona
*/
$(function(){
    $("#saveEditProp").click(function(){
        var formValidEdt = true;

        //validamos formulario
        if($("#idPropEdt").val() === null || $("#idPropEdt").val() === ""){
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El id del propietario no puede estar vacio!' });
            formValidEdt = false;
        }else if($("#nombresPropEdt").val() === null || $("#nombresPropEdt").val() === ""){
            $('#nombresPropEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del propietario no puede estar vacio!' });
            formValidEdt = false;
        }else if($("#razSoPropEdt").val() === null || $("#razSoPropEdt").val() === ""){
            $('#razSoPropEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Razon Social no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#rfcPropEdt").val() === null || $("#rfcPropEdt").val() === ""){
            $('#rfcPropEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El RFC no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#tipoPerPropEdt").val() === '0'){
            $('#tipoPerPropEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe seleccionar un tipo de persona!' });
            formValidEdt = false;
        }

        if(formValidEdt){
            loaderPage.fadeIn();

            $.ajax({
                url:BASE_PATH + 'catalogosGenerales/catalogoGeneral/updateInfoCat',
                type:'POST',
                dataType:'json',
                data:{
                    paterno : $('#appaternoPropEdt').val(),
                    materno : $("#apmaternoPropEdt").val(),
                    nombre :$('#nombresPropEdt').val(),
                    social : $("#razSoPropEdt").val(),
                    rfc : $("#rfcPropEdt").val(),
                    calle : $("#callePropEdt").val(),
                    col : $("#colPropEdt").val(),
                    cp : $("#cpPropEdt").val(),
                    estado : $("#estadoPropEdt option:selected").text(),
                    cel : $("#celPropEdt").val(),
                    tel : $("#telPropEdt").val(),
                    email : $("#emailPropEdt").val(),
                    tipoPer : $("#tipoPerPropEdt").val(),
                    diasEntrega : $("#diasEntPropEdt").val(),
                    tipoUp : 'C',
                    tipoCat : 'C',
                    idRowCat : $("#idPropEdt").attr("value")
                },
                success:function(json) {
                    //Validamos si el codigo de respuesta es 200
                    if(json.response_code === "200"){

                        //cerramos la modal
                        $("#modalPropietarioEdit").modal('hide');
                        //buscar funcionalidad para actualizar la tabla

                        loaderPage.fadeOut();
                        Swal.fire({ type: 'success', title: 'Operacion exitosa Exitoso!', text: "Se guardo la informacion Correctamente!" });

                    // en caso de que no sea 200 se verifica si es 400 y se muestra un mensaje de error
                    }else if(json.response_code === "400"){
                        loaderPage.fadeOut();
                        Swal.fire({ type: 'error', title: 'Oops...', text: json.response_msg });
                    }
                },
                error : function(xhr, status) {
                    loaderPage.fadeOut();
                    Swal.fire({ type: 'error', title: 'Oops...', text: 'Ocurrio un problema intentalo mas tarde!' });
                }
            });
        }
    });
});

/**
* funcion para llenar la tabla con la
* actualizacion de los registros obtenidos
* en las peticiones ajax
* @param json
*/
function fillTableProp(json){

    if(json.catalogos !== null){

        $("#table_propietarios tbody").html("");
        //recorremos los registros para rellenar la tabla
        $.each(json.catalogos, function(i,p){
            var newRow = "<tr id='tr-"+p.Id_Propietario+"'>"
                +"<td>"+p.Id_Propietario+"</td>"
                +"<td>"+p.NombreCompleto+"</td>"
                +"<td>"+p.RazonSocial+"</td>"
                +"<td>"
                    +"<button type='button' class='btn btn-danger delete-prop' data-id='"+p.Id_Propietario+"' data-toggle='tooltip' data-placement='top' title='Eliminar Propietario'>"
                        +"<i class='fa fa-trash-o'></i>"
                    +"</button>"
                    +"<button type='button' class='btn btn-warning edit-prop' style='margin-left: 4px;' data-id='"+p.Id_Propietario+"' data-toggle='tooltip' data-placement='top' title='Editar Propietario'>"
                        +"<i class='fa fa-pencil-square-o'></i>"
                    +"</button>"
                +"</td>"
            +"</tr>";
            $(newRow).appendTo("#table_propietarios tbody");
        });
    }
}