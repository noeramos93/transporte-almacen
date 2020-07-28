/**
* @author Ing.Noe Ramos Lopez
* @version 1.0
* @copyright Todos los derechos resevados 2019
*/

//variables globales para el loader
var loaderPage = $('.preloader');
var estadoSelect = '';
var tipoPersonaSelect = '';
/**
* funcionalidad para detectar el precionado de las teclas en cada uno de los campos
* del formulario de alta obligatorios si el campo esta vacio  se agrega una clase
* para indicar que no es valida, de lo contrario se quita esa clase y se pone la clase is-valid.
* @param apellido paterno
* @param apellido materno
* @param nombre del cliente
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
    $('#appaternoCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#appaternoCli').removeClass("is-invalid");
            $('#appaternoCli').addClass("is-valid");
        }else{
            $('#appaternoCli').addClass("is-invalid");
        }
    });

    $('#apmaternoCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#apmaternoCli').removeClass("is-invalid");
            $('#apmaternoCli').addClass("is-valid");
        }else{
            $('#apmaternoCli').addClass("is-invalid");
        }
    });

    $('#nombresCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#nombresCli').removeClass("is-invalid");
            $('#nombresCli').addClass("is-valid");
        }else{
            $('#nombresCli').addClass("is-invalid");
        }
    });

    $('#razSoCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#razSoCli').removeClass("is-invalid");
            $('#razSoCli').addClass("is-valid");
        }else{
            $('#razSoCli').addClass("is-invalid");
        }
    });

    $('#rfcCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#rfcCli').removeClass("is-invalid");
            $('#rfcCli').addClass("is-valid");
        }else{
            $('#rfcCli').addClass("is-invalid");
        }
    });

    $('#calleCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#calleCli').removeClass("is-invalid");
            $('#calleCli').addClass("is-valid");
        }else{
            $('#calleCli').addClass("is-invalid");
        }
    });

    $('#colCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#colCli').removeClass("is-invalid");
            $('#colCli').addClass("is-valid");
        }else{
            $('#colCli').addClass("is-invalid");
        }
    });

    $('#cpCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#cpCli').removeClass("is-invalid");
            $('#cpCli').addClass("is-valid");
        }else{
            $('#cpCli').addClass("is-invalid");
        }
    });

    $('#celCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#celCli').removeClass("is-invalid");
            $('#celCli').addClass("is-valid");
        }else{
            $('#celCli').addClass("is-invalid");
        }
    });

    $('#emailCli').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#emailCli').removeClass("is-invalid");
            $('#emailCli').addClass("is-valid");
        }else{
            $('#emailCli').addClass("is-invalid");
        }
    });

    //validamos el combobox de estado
    $("#estadoCli").on('change',function(){
        estadoSelect = $(this).val();
        if(estadoSelect === '0'){
            $('#estadoCli').addClass("is-invalid");
        }else{
            $('#estadoCli').removeClass("is-invalid");
            $('#estadoCli').addClass("is-valid");
        }
    });

    //validamos combobox de tipo de persona
    $("#tipoPerCli").on('change',function(){
        tipoPersonaSelect = $(this).val();
        if(tipoPersonaSelect === '0'){
            $('#tipoPerCli').addClass("is-invalid");
        }else{
            $('#tipoPerCli').removeClass("is-invalid");
            $('#tipoPerCli').addClass("is-valid");
        }
    });
});


/**
* Funcionalidad para el validamiento de campos del formulario para editar
* al cliente.
* @param apellido paterno
* @param apellido materno
* @param nombre del cliente
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
    $('#appaternoCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#appaternoCliEdt').removeClass("is-invalid");
            $('#appaternoCliEdt').addClass("is-valid");
        }else{
            $('#appaternoCliEdt').addClass("is-invalid");
        }
    });

    $('#apmaternoCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#apmaternoCliEdt').removeClass("is-invalid");
            $('#apmaternoCliEdt').addClass("is-valid");
        }else{
            $('#apmaternoCliEdt').addClass("is-invalid");
        }
    });

    $('#nombresCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#nombresCliEdt').removeClass("is-invalid");
            $('#nombresCliEdt').addClass("is-valid");
        }else{
            $('#nombresCliEdt').addClass("is-invalid");
        }
    });

    $('#razSoCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#razSoCliEdt').removeClass("is-invalid");
            $('#razSoCliEdt').addClass("is-valid");
        }else{
            $('#razSoCliEdt').addClass("is-invalid");
        }
    });

    $('#rfcCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#rfcCliEdt').removeClass("is-invalid");
            $('#rfcCliEdt').addClass("is-valid");
        }else{
            $('#rfcCliEdt').addClass("is-invalid");
        }
    });

    $('#calleCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#calleCliEdt').removeClass("is-invalid");
            $('#calleCliEdt').addClass("is-valid");
        }else{
            $('#calleCliEdt').addClass("is-invalid");
        }
    });

    $('#colCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#colCliEdt').removeClass("is-invalid");
            $('#colCliEdt').addClass("is-valid");
        }else{
            $('#colCliEdt').addClass("is-invalid");
        }
    });

    $('#cpCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#cpCliEdt').removeClass("is-invalid");
            $('#cpCliEdt').addClass("is-valid");
        }else{
            $('#cpCliEdt').addClass("is-invalid");
        }
    });

    $('#celCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#celCliEdt').removeClass("is-invalid");
            $('#celCliEdt').addClass("is-valid");
        }else{
            $('#celCliEdt').addClass("is-invalid");
        }
    });

    $('#emailCliEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#emailCliEdt').removeClass("is-invalid");
            $('#emailCliEdt').addClass("is-valid");
        }else{
            $('#emailCliEdt').addClass("is-invalid");
        }
    });

    //validamos el combobox de estado para editar
    $("#estadoCliEdt").on('change',function(){
        estadoSelect = $(this).val();
        if(estadoSelect === '0'){
            $('#estadoCliEdt').addClass("is-invalid");
        }else{
            $('#estadoCliEdt').removeClass("is-invalid");
            $('#estadoCliEdt').addClass("is-valid");
        }
    });

    //validamos combobox de tipo de persona para editar
    $("#tipoPerCliEdt").on('change',function(){
        tipoPersonaSelect = $(this).val();
        if(tipoPersonaSelect === '0'){
            $('#tipoPerCliEdt').addClass("is-invalid");
        }else{
            $('#tipoPerCliEdt').removeClass("is-invalid");
            $('#tipoPerCliEdt').addClass("is-valid");
        }
    });
});

/**
* funcinalidad para hacer la validacion de los campos
* del formulario de clientes en caso de que no sea valido
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

	$("#form_alta_cliente").submit(function(){

        var formValid = true;

        //validamos formulario
        if($("#idCli").val() === null || $("#idCli").val() === ""){
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El id del cliente no puede estar vacio!' });
            formValid = false;
        }else if($("#appaternoCli").val() === null || $("#appaternoCli").val() === ""){
            $('#appaternoCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El apellido paterno no puede estar vacio!' });
            formValid = false;
        }else if($("#apmaternoCli").val() === null || $("#apmaternoCli").val() === ""){
            $('#apmaternoCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El apellido materno no puede estar vacio!' });
            formValid = false;
        }else if($("#razSoCli").val() === null || $("#razSoCli").val() === ""){
            $('#razSoCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Razon Social no puede estar vacia!' });
            formValid = false;
        }else if($("#rfcCli").val() === null || $("#rfcCli").val() === ""){
            $('#rfcCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El RFC no puede estar vacia!' });
            formValid = false;
        }else if($("#calleCli").val() === null || $("#calleCli").val() === ""){
            $('#calleCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Calle no puede estar vacia!' });
            formValid = false;
        }else if($("#colCli").val() === null || $("#colCli").val() === ""){
            $('#colCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Colonia no puede estar vacia!' });
            formValid = false;
        }else if($("#cpCli").val() === null || $("#cpCli").val() === ""){
            $('#cpCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El codigo postal no puede estar vacia!' });
            formValid = false;
        }else if($("#estadoCli").val() === '0'){
            $('#cpCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar un estado!' });
            formValid = false;
        }else if($("#celCli").val() === null || $("#celCli").val() === ""){
            $('#celCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El numero del celular no puede estar vacia!' });
            formValid = false;
        }else if($("#emailCli").val() === null || $("#emailCli").val() === ""){
            $('#emailCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El email no puede estar vacia!' });
            formValid = false;
        }else if($("#tipoPerCli").val() === '0'){
            $('#tipoPerCli').addClass("is-invalid");
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
                    paterno : $('#appaternoCli').val(),
                    materno : $("#apmaternoCli").val(),
                    nombre :$('#nombresCli').val(),
                    social : $("#razSoCli").val(),
                    rfc : $("#rfcCli").val(),
                    calle : $("#calleCli").val(),
                    col : $("#colCli").val(),
                    cp : $("#cpCli").val(),
                    estado : $("#estadoCli option:selected").text(),
                    cel : $("#celCli").val(),
                    tel : $("#telCli").val(),
                    email : $("#emailCli").val(),
                    tipoPer : $("#tipoPerCli").val(),
                    tipoSave : 'A'
                },
                success:function(json) {
                    //Validamos si el codigo de respuesta es 200
                    if(json.response_code === "200"){

                        //se debe de obtener de la base
                        $("#idCli").attr("value",json.nextIdCat);

                        //damos click al boton de reinciar
                        $("#btnReset").click();

                        //recargamos la tabla de registros
                        fillTableCli(json);

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
    $("#btnReset").click(function(){
        // campo 1
        $('#appaternoCli').removeClass("is-invalid");
        $('#appaternoCli').removeClass("is-valid");
        // campo 2
        $('#apmaternoCli').removeClass("is-invalid");
        $('#apmaternoCli').removeClass("is-valid");
        // campo 3
        $('#nombresCli').removeClass("is-invalid");
        $('#nombresCli').removeClass("is-valid");
        // campo 4
        $('#razSoCli').removeClass("is-invalid");
        $('#razSoCli').removeClass("is-valid");
        // campo 5
        $('#rfcCli').removeClass("is-invalid");
        $('#rfcCli').removeClass("is-valid");
        // campo 6
        $('#calleCli').removeClass("is-invalid");
        $('#calleCli').removeClass("is-valid");
        // campo 7
        $('#colCli').removeClass("is-invalid");
        $('#colCli').removeClass("is-valid");
        // campo 8
        $('#cpCli').removeClass("is-invalid");
        $('#cpCli').removeClass("is-valid");
        // campo 9, combobox
        $('#estadoCli').removeClass("is-invalid");
        $('#estadoCli').removeClass("is-valid");
        // campo 10
        $('#celCli').removeClass("is-invalid");
        $('#celCli').removeClass("is-valid");
        // campo 11, no es ibligatorio
        $('#telCli').removeClass("is-invalid");
        $('#telCli').removeClass("is-valid");
        // campo 12
        $('#emailCli').removeClass("is-invalid");
        $('#emailCli').removeClass("is-valid");
        // campo 13, combobox
        $('#tipoPerCli').removeClass("is-invalid");
        $('#tipoPerCli').removeClass("is-valid");
    }); 
});

/**
* accion para el boton delete cleinte
* de la tabla, obtiene el id del cliente
* y pregunta si estamos seguros de eleiminar el resgrustro
* si damos en si envia una peticion ajax
* la cual envia el id al cual se le hara la baja logica
* y se borrara el registro de la tabla
* @param id_cli
*/
$(function(){
    var id_clie = '0';
    $("#table_clientes").on('click','.delete-cli',function(){
        
        id_clie = $(this).attr('data-id');

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
                            idRowCat : id_clie,
                            tipoUp : 'D',
                            tipoCat : 'A'
                        },
                        success:function(json) {
                            if(json.response_code === "200"){
                                $("#tr-"+id_clie).remove();
                                Swal.fire( 'Borrado!', 'El Cliente fue eliminado con exito!', 'success');
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
* Funcion que trae la informacion de un cliente
* que se muestre en la tabla
* @param id_cli_edit
*/
$(function(){
    var id_cli_edit = '0';
    $("#table_clientes").on('click','.edit-cli',function(){
        id_cli_edit = $(this).attr('data-id');
        //funcion ajax para hacer la busqueda
        $.ajax({
            url:BASE_PATH + 'catalogosGenerales/catalogoGeneral/selectInfoCat',
            type:'POST',
            dataType:'json',
            data:{
                idRowCat : id_cli_edit,
                tipoSelectCat : 'A'
            },
            success:function(json) {
                //si todo sale bien muestra el modal con la info del cliente
                if(json.response_code === "200"){

                    $("#idCliEdt").attr("value",json.cliente.Id_Cliente);
                    $('#appaternoCliEdt').val(json.cliente.APaterno);
                    $("#apmaternoCliEdt").val(json.cliente.AMaterno);
                    $('#nombresCliEdt').val(json.cliente.Nombres);
                    $("#razSoCliEdt").val(json.cliente.RazonSocial);
                    $("#rfcCliEdt").val(json.cliente.RFC);
                    $("#calleCliEdt").val(json.cliente.Calle);
                    $("#colCliEdt").val(json.cliente.Colonia);
                    $("#cpCliEdt").val(json.cliente.CP);
                    $("#estadoCliEdt option:contains("+json.cliente.Estado+")").attr('selected', true);
                    $("#celCliEdt").val(json.cliente.Celular);
                    $("#telCliEdt").val(json.cliente.Telefono);
                    $("#emailCliEdt").val(json.cliente.email);
                    $("#tipoPerCliEdt option:contains("+json.cliente.Tipo_Persona+")").attr('selected', true);
                    //mostramos la modal con la informacion cargada
                    $("#modalClienteEdit").modal('show');
                        
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
* Funcion para la actualizacion de un la informaicon de un cliente.
* @param id del cliente
* @param nombre del cliente
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
    $("#saveEditCli").click(function(){
        var formValidEdt = true;

        //validamos formulario
        if($("#idCliEdt").val() === null || $("#idCliEdt").val() === ""){
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El id del cliente no puede estar vacio!' });
            formValidEdt = false;
        }else if($("#appaternoCliEdt").val() === null || $("#appaternoCliEdt").val() === ""){
            $('#appaternoCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El apellido paterno no puede estar vacio!' });
            formValidEdt = false;
        }else if($("#apmaternoCliEdt").val() === null || $("#apmaternoCliEdt").val() === ""){
            $('#apmaternoCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El apellido materno no puede estar vacio!' });
            formValidEdt = false;
        }else if($("#razSoCliEdt").val() === null || $("#razSoCliEdt").val() === ""){
            $('#razSoCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Razon Social no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#rfcCliEdt").val() === null || $("#rfcCliEdt").val() === ""){
            $('#rfcCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El RFC no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#calleCliEdt").val() === null || $("#calleCliEdt").val() === ""){
            $('#calleCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Calle no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#colCliEdt").val() === null || $("#colCliEdt").val() === ""){
            $('#colCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Colonia no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#cpCliEdt").val() === null || $("#cpCliEdt").val() === ""){
            $('#cpCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El codigo postal no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#estadoCliEdt").val() === '0'){
            $('#estadoCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar un estado!' });
            formValidEdt = false;
        }else if($("#celCliEdt").val() === null || $("#celCliEdt").val() === ""){
            $('#celCliEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El numero del celular no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#emailCliEdt").val() === null || $("#emailCliEdt").val() === ""){
            $('#emailCli').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El email no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#tipoPerCliEdt").val() === '0'){
            $('#tipoPerCliEdt').addClass("is-invalid");
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
                    paterno : $('#appaternoCliEdt').val(),
                    materno : $("#apmaternoCliEdt").val(),
                    nombre :$('#nombresCliEdt').val(),
                    social : $("#razSoCliEdt").val(),
                    rfc : $("#rfcCliEdt").val(),
                    calle : $("#calleCliEdt").val(),
                    col : $("#colCliEdt").val(),
                    cp : $("#cpCliEdt").val(),
                    estado : $("#estadoCliEdt option:selected").text(),
                    cel : $("#celCliEdt").val(),
                    tel : $("#telCliEdt").val(),
                    email : $("#emailCliEdt").val(),
                    tipoPer : $("#tipoPerCliEdt").val(),
                    tipoUp : 'C',
                    tipoCat : 'A',
                    idRowCat : $("#idCliEdt").attr("value")
                },
                success:function(json) {
                    //Validamos si el codigo de respuesta es 200
                    if(json.response_code === "200"){

                        //cerramos la modal
                        $("#modalClienteEdit").modal('hide');
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
function fillTableCli(json){

    if(json.catalogos !== null){

        $("#table_clientes tbody").html("");
        //recorremos los registros para rellenar la tabla
        $.each(json.catalogos, function(i,c){
            var newRow = "<tr id='tr-"+c.Id_Cliente+"'>"
                +"<td>"+c.Id_Cliente+"</td>"
                +"<td>"+c.NombreCompleto+"</td>"
                +"<td>"+c.RazonSocial+"</td>"
                +"<td>"
                    +"<button type='button' class='btn btn-danger delete-cli' data-id='"+c.Id_Cliente+"' data-toggle='tooltip' data-placement='top' title='Eliminar Cliente'>"
                        +"<i class='fa fa-trash-o'></i>"
                    +"</button>"
                    +"<button type='button' class='btn btn-warning edit-cli' style='margin-left: 4px;' data-id='"+c.Id_Cliente+"' data-toggle='tooltip' data-placement='top' title='Editar Cliente'>"
                        +"<i class='fa fa-pencil-square-o'></i>"
                    +"</button>"
                +"</td>"
            +"</tr>";
            $(newRow).appendTo("#table_clientes tbody");
        });
    }
}