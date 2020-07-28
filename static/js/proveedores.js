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

    $('#nombresProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#nombresProv').removeClass("is-invalid");
            $('#nombresProv').addClass("is-valid");
        }else{
            $('#nombresProv').addClass("is-invalid");
        }
    });

    $('#razSoProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#razSoProv').removeClass("is-invalid");
            $('#razSoProv').addClass("is-valid");
        }else{
            $('#razSoProv').addClass("is-invalid");
        }
    });

    $('#rfcProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#rfcProv').removeClass("is-invalid");
            $('#rfcProv').addClass("is-valid");
        }else{
            $('#rfcProv').addClass("is-invalid");
        }
    });

    $('#calleProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#calleProv').removeClass("is-invalid");
            $('#calleProv').addClass("is-valid");
        }else{
            $('#calleProv').addClass("is-invalid");
        }
    });

    $('#colProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#colProv').removeClass("is-invalid");
            $('#colProv').addClass("is-valid");
        }else{
            $('#colProv').addClass("is-invalid");
        }
    });

    $('#cpProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#cpProv').removeClass("is-invalid");
            $('#cpProv').addClass("is-valid");
        }else{
            $('#cpProv').addClass("is-invalid");
        }
    });

    $('#celProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#celProv').removeClass("is-invalid");
            $('#celProv').addClass("is-valid");
        }else{
            $('#celProv').addClass("is-invalid");
        }
    });

    $('#emailProv').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#emailProv').removeClass("is-invalid");
            $('#emailProv').addClass("is-valid");
        }else{
            $('#emailProv').addClass("is-invalid");
        }
    });

    //validamos el combobox de estado
    $("#estadoProv").on('change',function(){
        estadoSelect = $(this).val();
        if(estadoSelect === '0'){
            $('#estadoProv').addClass("is-invalid");
        }else{
            $('#estadoProv').removeClass("is-invalid");
            $('#estadoProv').addClass("is-valid");
        }
    });

    //validamos combobox de tipo de persona
    $("#tipoPerProv").on('change',function(){
        tipoPersonaSelect = $(this).val();
        if(tipoPersonaSelect === '0'){
            $('#tipoPerProv').addClass("is-invalid");
        }else{
            $('#tipoPerProv').removeClass("is-invalid");
            $('#tipoPerProv').addClass("is-valid");
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

    $('#nombresProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#nombresProvEdt').removeClass("is-invalid");
            $('#nombresProvEdt').addClass("is-valid");
        }else{
            $('#nombresProvEdt').addClass("is-invalid");
        }
    });

    $('#razSoProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#razSoProvEdt').removeClass("is-invalid");
            $('#razSoProvEdt').addClass("is-valid");
        }else{
            $('#razSoProvEdt').addClass("is-invalid");
        }
    });

    $('#rfcProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#rfcProvEdt').removeClass("is-invalid");
            $('#rfcProvEdt').addClass("is-valid");
        }else{
            $('#rfcProvEdt').addClass("is-invalid");
        }
    });

    $('#calleProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#calleProvEdt').removeClass("is-invalid");
            $('#calleProvEdt').addClass("is-valid");
        }else{
            $('#calleProvEdt').addClass("is-invalid");
        }
    });

    $('#colProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#colProvEdt').removeClass("is-invalid");
            $('#colProvEdt').addClass("is-valid");
        }else{
            $('#colProvEdt').addClass("is-invalid");
        }
    });

    $('#cpProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#cpProvEdt').removeClass("is-invalid");
            $('#cpProvEdt').addClass("is-valid");
        }else{
            $('#cpProvEdt').addClass("is-invalid");
        }
    });

    $('#celProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#celProvEdt').removeClass("is-invalid");
            $('#celProvEdt').addClass("is-valid");
        }else{
            $('#celProvEdt').addClass("is-invalid");
        }
    });

    $('#emailProvEdt').on('keyup',function(event){
        var valueInputName = $(this).val().length;
        if(valueInputName > 0){
            $('#emailProvEdt').removeClass("is-invalid");
            $('#emailProvEdt').addClass("is-valid");
        }else{
            $('#emailProvEdt').addClass("is-invalid");
        }
    });

    //validamos el combobox de estado para editar
    $("#estadoProvEdt").on('change',function(){
        estadoSelect = $(this).val();
        if(estadoSelect === '0'){
            $('#estadoProvEdt').addClass("is-invalid");
        }else{
            $('#estadoProvEdt').removeClass("is-invalid");
            $('#estadoProvEdt').addClass("is-valid");
        }
    });

    //validamos combobox de tipo de persona para editar
    $("#tipoPerProvEdt").on('change',function(){
        tipoPersonaSelect = $(this).val();
        if(tipoPersonaSelect === '0'){
            $('#tipoPerProvEdt').addClass("is-invalid");
        }else{
            $('#tipoPerProvEdt').removeClass("is-invalid");
            $('#tipoPerProvEdt').addClass("is-valid");
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

	$("#form_alta_proveedor").submit(function(){

        var formValid = true;

        //validamos formulario
        if($("#idProv").val() === null || $("#idProv").val() === ""){
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El id del Proveedor no puede estar vacio!' });
            formValid = false;
        }else if($("#nombresProv").val() === null || $("#nombresProv").val() === ""){
            $('#nombresProv').addClass("is-invalid");
            Swal.fire({ 
                type: 'error', 
                title: 'Oops...', 
                text: 'El Nombre del prveedor no puede estar vacio!',
            }).then((result) => {
                if (result.value) {
                    scrollFocus($("#nombresProv"));
                }
            });
            formValid = false;
        }else if($("#razSoProv").val() === null || $("#razSoProv").val() === ""){
            $('#razSoProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Razon Social no puede estar vacia!' });
            formValid = false;
        }else if($("#rfcProv").val() === null || $("#rfcProv").val() === ""){
            $('#rfcProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El RFC no puede estar vacia!' });
            formValid = false;
        }else if($("#calleProv").val() === null || $("#calleProv").val() === ""){
            $('#calleProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Calle no puede estar vacia!' });
            formValid = false;
        }else if($("#colProv").val() === null || $("#colProv").val() === ""){
            $('#colProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Colonia no puede estar vacia!' });
            formValid = false;
        }else if($("#cpProv").val() === null || $("#cpProv").val() === ""){
            $('#cpProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El codigo postal no puede estar vacia!' });
            formValid = false;
        }else if($("#estadoProv").val() === '0'){
            $('#estadoProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar un estado!' });
            formValid = false;
        }else if($("#celProv").val() === null || $("#celProv").val() === ""){
            $('#celProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El numero del celular no puede estar vacia!' });
            formValid = false;
        }else if($("#emailProv").val() === null || $("#emailProv").val() === ""){
            $('#emailProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El email no puede estar vacia!' });
            formValid = false;
        }else if($("#tipoPerProv").val() === '0'){
            $('#tipoPerProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe seleccionar un tipo de persona!' });
            formValid = false;
        }else if($("#diasEntProv").val() === null || $("#diasEntProv").val() === ""){
        	$('#diasEntProv').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El campo de dias no puede estar nulo!' });
            formValid = false;
        }

        if(formValid){
            loaderPage.fadeIn();

            $.ajax({
                url:BASE_PATH + 'catalogosGenerales/catalogoGeneral/saveInfoCat',
                type:'POST',
                dataType:'json',
                data:{
                    paterno : $('#appaternoProv').val(),
                    materno : $("#apmaternoProv").val(),
                    nombre :$('#nombresProv').val(),
                    social : $("#razSoProv").val(),
                    rfc : $("#rfcProv").val(),
                    calle : $("#calleProv").val(),
                    col : $("#colProv").val(),
                    cp : $("#cpProv").val(),
                    estado : $("#estadoProv option:selected").text(),
                    cel : $("#celProv").val(),
                    tel : $("#telProv").val(),
                    email : $("#emailProv").val(),
                    tipoPer : $("#tipoPerProv").val(),
                    diasEntrega : $("#diasEntProv").val(),
                    tipoSave : 'B'
                },
                success:function(json) {
                    //Validamos si el codigo de respuesta es 200
                    if(json.response_code === "200"){

                        //se debe de obtener de la base
                        $("#idProv").attr("value",json.nextIdCat);

                        //damos click al boton de reinciar
                        $("#btnResetProv").click();

                        //recargamos la tabla de registros
                        fillTableProv(json);

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
    $("#btnResetProv").click(function(){
        // campo 1
        $('#appaternoProv').removeClass("is-invalid");
        $('#appaternoProv').removeClass("is-valid");
        // campo 2
        $('#apmaternoProv').removeClass("is-invalid");
        $('#apmaternoProv').removeClass("is-valid");
        // campo 3
        $('#nombresProv').removeClass("is-invalid");
        $('#nombresProv').removeClass("is-valid");
        // campo 4
        $('#razSoProv').removeClass("is-invalid");
        $('#razSoProv').removeClass("is-valid");
        // campo 5
        $('#rfcProv').removeClass("is-invalid");
        $('#rfcProv').removeClass("is-valid");
        // campo 6
        $('#calleProv').removeClass("is-invalid");
        $('#calleProv').removeClass("is-valid");
        // campo 7
        $('#colProv').removeClass("is-invalid");
        $('#colProv').removeClass("is-valid");
        // campo 8
        $('#cpProv').removeClass("is-invalid");
        $('#cpProv').removeClass("is-valid");
        // campo 9, combobox
        $('#estadoProv').removeClass("is-invalid");
        $('#estadoProv').removeClass("is-valid");
        // campo 10
        $('#celProv').removeClass("is-invalid");
        $('#celProv').removeClass("is-valid");
        // campo 11, no es ibligatorio
        $('#telProv').removeClass("is-invalid");
        $('#telProv').removeClass("is-valid");
        // campo 12
        $('#emailProv').removeClass("is-invalid");
        $('#emailProv').removeClass("is-valid");
        // campo 13, combobox
        $('#tipoPerProv').removeClass("is-invalid");
        $('#tipoPerProv').removeClass("is-valid");
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
    $("#table_proveedor").on('click','.delete-prov',function(){
        
        id_prov = $(this).attr('data-id');

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
                            idRowCat : id_prov,
                            tipoUp : 'D',
                            tipoCat : 'B'
                        },
                        success:function(json) {
                            if(json.response_code === "200"){
                                $("#tr-"+id_prov).remove();
                                Swal.fire( 'Borrado!', 'El Proveedor fue eliminado con exito!', 'success');
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
    var id_prov_edit = '0';
    $("#table_proveedor").on('click','.edit-prov',function(){
        id_prov_edit = $(this).attr('data-id');
        //funcion ajax para hacer la busqueda
        $.ajax({
            url:BASE_PATH + 'catalogosGenerales/catalogoGeneral/selectInfoCat',
            type:'POST',
            dataType:'json',
            data:{
                idRowCat : id_prov_edit,
                tipoSelectCat : 'B'
            },
            success:function(json) {
                //si todo sale bien muestra el modal con la info del cliente
                if(json.response_code === "200"){

                    $("#idProvEdt").attr("value",json.cliente.Id_Proveedor);
                    $('#appaternoProvEdt').val(json.cliente.APaterno);
                    $("#apmaternoProvEdt").val(json.cliente.AMaterno);
                    $('#nombresProvEdt').val(json.cliente.Nombres);
                    $("#razSoProvEdt").val(json.cliente.RazonSocial);
                    $("#rfcProvEdt").val(json.cliente.RFC);
                    $("#calleProvEdt").val(json.cliente.Calle);
                    $("#colProvEdt").val(json.cliente.Colonia);
                    $("#cpProvEdt").val(json.cliente.CP);
                    $("#estadoProvEdt option:contains("+json.cliente.Estado+")").attr('selected', true);
                    $("#celProvEdt").val(json.cliente.Celular);
                    $("#telProvEdt").val(json.cliente.Telefono);
                    $("#emailProvEdt").val(json.cliente.email);
                    $("#tipoPerProvEdt option:contains("+json.cliente.Tipo_Persona+")").attr('selected', true);
                    $("#diasEntProvEdt").val(json.cliente.Dias_Entrega);
                    //mostramos la modal con la informacion cargada
                    $("#modalProveedorEdit").modal('show');
                        
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
    $("#saveEditProv").click(function(){
        var formValidEdt = true;

        //validamos formulario
        if($("#idProvEdt").val() === null || $("#idProvEdt").val() === ""){
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El id del cliente no puede estar vacio!' });
            formValidEdt = false;
        }else if($("#nombresProvEdt").val() === null || $("#nombresProvEdt").val() === ""){
            $('#nombresProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El apellido paterno no puede estar vacio!' });
            formValidEdt = false;
        }else if($("#razSoProvEdt").val() === null || $("#razSoProvEdt").val() === ""){
            $('#razSoProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Razon Social no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#rfcProvEdt").val() === null || $("#rfcProvEdt").val() === ""){
            $('#rfcProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El RFC no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#calleProvEdt").val() === null || $("#calleProvEdt").val() === ""){
            $('#calleProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Calle no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#colProvEdt").val() === null || $("#colProvEdt").val() === ""){
            $('#colProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'La Colonia no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#cpProvEdt").val() === null || $("#cpProvEdt").val() === ""){
            $('#cpProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El codigo postal no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#estadoProvEdt").val() === '0'){
            $('#estadoProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar un estado!' });
            formValidEdt = false;
        }else if($("#celProvEdt").val() === null || $("#celProvEdt").val() === ""){
            $('#celProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El numero del celular no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#emailProvEdt").val() === null || $("#emailProvEdt").val() === ""){
            $('#emailProvEdt').addClass("is-invalid");
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El email no puede estar vacia!' });
            formValidEdt = false;
        }else if($("#tipoPerProvEdt").val() === '0'){
            $('#tipoPerProvEdt').addClass("is-invalid");
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
                    paterno : $('#appaternoProvEdt').val(),
                    materno : $("#apmaternoProvEdt").val(),
                    nombre :$('#nombresProvEdt').val(),
                    social : $("#razSoProvEdt").val(),
                    rfc : $("#rfcProvEdt").val(),
                    calle : $("#calleProvEdt").val(),
                    col : $("#colProvEdt").val(),
                    cp : $("#cpProvEdt").val(),
                    estado : $("#estadoProvEdt option:selected").text(),
                    cel : $("#celProvEdt").val(),
                    tel : $("#telProvEdt").val(),
                    email : $("#emailProvEdt").val(),
                    tipoPer : $("#tipoPerProvEdt").val(),
                    diasEntrega : $("#diasEntProvEdt").val(),
                    tipoUp : 'C',
                    tipoCat : 'B',
                    idRowCat : $("#idProvEdt").attr("value")
                },
                success:function(json) {
                    //Validamos si el codigo de respuesta es 200
                    if(json.response_code === "200"){

                        //cerramos la modal
                        $("#modalProveedorEdit").modal('hide');
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
function fillTableProv(json){

    if(json.catalogos !== null){

        $("#table_proveedor tbody").html("");
        //recorremos los registros para rellenar la tabla
        $.each(json.catalogos, function(i,v){
            var newRow = "<tr id='tr-"+v.Id_Proveedor+"'>"
                +"<td>"+v.Id_Proveedor+"</td>"
                +"<td>"+v.NombreCompleto+"</td>"
                +"<td>"+v.RazonSocial+"</td>"
                +"<td>"
                    +"<button type='button' class='btn btn-danger delete-prov' data-id='"+v.Id_Proveedor+"' data-toggle='tooltip' data-placement='top' title='Eliminar Proveedor'>"
                        +"<i class='fa fa-trash-o'></i>"
                    +"</button>"
                    +"<button type='button' class='btn btn-warning edit-prov' style='margin-left: 4px;' data-id='"+v.Id_Proveedor+"' data-toggle='tooltip' data-placement='top' title='Editar Proveedor'>"
                        +"<i class='fa fa-pencil-square-o'></i>"
                    +"</button>"
                +"</td>"
            +"</tr>";
            $(newRow).appendTo("#table_proveedor tbody");
        });
    }
}

function scrollFocus(objetoFocus){
     $('html, body').animate({ scrollTop: $(objetoFocus).offset().top }, 5000);
}