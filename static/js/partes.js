// variable globales del archivo de partes
var CODIGO_ALTERNO = "";
var ID_PARTE = "";
var ID_SLC_ALM = '0';
var ID_SLC_NV1 = '0';
var ID_SLC_NV2 = '0';
var ID_SLC_NV3 = '0';
var ID_SLC_NV4 = '0';
var TIPO_OPERACION = 'S';
var NOW = new Date();
var TODAY = NOW.getFullYear() + '-' + (NOW.getMonth() + 1) + '-' + NOW.getDate();
/**
* Metodo para la accion del boton guardar parte
* la cual recibe toda la info de la parte y la guarda
* @param fechaAlta
* @param codAlterno
* @param tipoInvt
* @param dscTxt
* @param fichaTecnica
* @param minimo
* @param maximo
* @param reOrden
* @param costRepo
* @param ultCosto
* @param ultCompra
*/
$(function(){

    //Metodo para poner la fecha actual
    $("#fechaAlta").val(TODAY);
	
	$("#btnSavePart").click(function(){
		
		var camposValidos = true;

		if($("#fechaAlta").val() === null || $("#fechaAlta").val() === ""){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'La fecha de alta no puede estar vacia!' });
		}else if($("#codAlterno").val() === null || $("#codAlterno").val() === ""){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El codigo alterno no puede estar vacio!' });
		}else if($("#tipoInvt").val() === null || $("#tipoInvt").val() === "0"){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe seleccionar un tipo de inventario no puede estar vacio!' });
		}else if($("#dscTxt").val() === null || $("#dscTxt").val() === ""){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'La descripcion no puede estar vacia!' });
		}else if($("#fichaTecnica").val() === null || $("#fichaTecnica").val() === ""){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'La ficha tecnica no puede estar vacia!' });
		}else if($("#minimo").val() === null ){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El minimo no puede estar vacia!' });
		}else if($("#maximo").val() === null){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El maximo no puede estar vacia!' });
		}else if($("#reOrden").val() === null){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El Pto de reorden no puede estar vacia!' });
		}else if($("#costRepo").val() === null){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El costo de reposicion no puede estar vacia!' });
		}else if($("#ultCosto").val() === null){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El precio del ultimo costo no puede estar vacia!' });
		}else if($("#ultCompra").val() === null){
			camposValidos = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'La fecha de la ultima compra no puede estar vacia!' });
		}


		if(camposValidos){
			console.log("Paso validaciones ");

			$.ajax({
            	url:BASE_PATH + 'almacen/Partes/saveParte',
            	type:'POST',
            	dataType:'json',
            	data:{
                    id_parte : $("#idPart").val(),
                	fch_alta : $("#fechaAlta").val(),
                	cod_alter : $("#codAlterno").val(),
                	tipo_invt : $("#tipoInvt").val(),
                	dsc_txt : $("#dscTxt").val(),
                	fch_tec : $("#fichaTecnica").val(),
                	min_part : $("#minimo").val(),
                	max_part : $("#maximo").val(),
                	re_ord : $("#reOrden").val(),
                	cost_repo : $("#costRepo").val(),
                	ult_cost : $("#ultCosto").val(),
                	ult_comp : $("#ultCompra").val(),
                    tip_oper : TIPO_OPERACION
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                		//guardamos el codigo alterno y el id de la parte que se
                        CODIGO_ALTERNO = $("#codAlterno").val();
                        ID_PARTE = $("#idPart").val();

                		$("#fechaAlta").val(TODAY);
                		$("#codAlterno").val("");
                		$("#tipoInvt").val("0");
                		$("#dscTxt").val("");
                		$("#fichaTecnica").val("");
                		$("#minimo").val("");
                		$("#maximo").val("");
                		$("#reOrden").val("");
                		$("#costRepo").val("");
                		$("#ultCosto").val("");
                		$("#ultCompra").val("");
                		//obtenemos el nuevo id de la parte
                		$("#idPart").attr("value",json.idParteNew);
                        //desbloqueamos los botones
                        $("#addUbic").prop('disabled','');
                        $("#deleteUbic").prop('disabled','');
                        $("#addProv").prop('disabled','');
                        $("#deleteProv").prop('disabled','');
                        $("#tb_ubicacion tbody").html("");
                        $("#tb_proveedor tbody").html("");

                		Swal.fire( 'Exito!', 'Se guardo el registro, ahora puedes agregar un Proveedor y una Ubicacion!.', 'success');

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

/**
* Metodo para obtener la informacion de una parte
* dependiendo del codigo alterno que se busque.
* @param codigo_alterno
*/
$(function(){
	// funcion para hacer la busqueda de una parte
	$("#searchPart").click(function(){
		var codAlt = $("#codAlterno").val();
		if(codAlt === null || codAlt === ""){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'Es necesario el codigo alterno para realizar la buesqueda!' });
		}else{

            $.ajax({
                url:BASE_PATH + 'almacen/Partes/getInfoPart',
                type:'POST',
                dataType:'json',
                data:{
                    cod_alter : codAlt
                },
                success:function(json) {
                    if(json.response_code === "200"){
                        // llenar formulario de partes
                        $("#fechaAlta").val(json.infoParte.Fecha);
                        //$("#codAlterno").val("");
                        $("#tipoInvt").val(json.infoParte.Id_Tipo);
                        $("#dscTxt").val(json.infoParte.Descripcion);
                        $("#fichaTecnica").val(json.infoParte.Ficha_Tecnica);
                        $("#minimo").val(json.infoParte.Minimo);
                        $("#maximo").val(json.infoParte.Maixmo);
                        $("#reOrden").val(json.infoParte.Punto_Reorden);
                        $("#costRepo").val(json.infoParte.Costo_Reposicion);
                        $("#ultCosto").val(json.infoParte.Ultimo_Costo);
                        $("#ultCompra").val(json.infoParte.Fecha_UltimaCompra);
                        $("#idPart").attr("value",json.infoParte.Id_Parte);
                        //cambios para dar valor al codigo alterno y al id de la parte
                        CODIGO_ALTERNO = $("#codAlterno").val();
                        ID_PARTE = json.infoParte.Id_Parte;

                        $("#saveRelation").removeClass('hide-element');
                        // llenamos la tabla de proveedore
                        $("#tb_proveedor tbody").html("");
                        $.each(json.proveedores,function(i,p){
                            var isPrin = 'Si';

                            if(p.EsPrincipal == 'N'){
                                isPrin = 'No';
                            }
                            var newRow = "<tr id='tr-pv-"+p.Id_Proveedor+"'>"
                                            +"<td>"+p.Id_Proveedor+"</td>"
                                            +"<td>"+p.RazonSocial+"</td>"
                                            +"<td>"+p.Codigo_Proveedor+"</td>"
                                            +"<td>"+isPrin+"</td>"
                                            +"<td>"+p.Dias_Entrega+"</td>"
                                        +"</tr>";
                            $(newRow).appendTo("#tb_proveedor tbody");
                        });

                        // llenamos la tabla de ubicaciones
                        $("#tb_ubicacion tbody").html("");
                        $.each(json.ubicaciones,function(i,b){

                            var newRow = "<tr id='tr-ubc-"+b.ID_ALM+"'>"
                                            +"<td>"+b.ID_ALM+"</td>"
                                            +"<td>"+b.ALMACEN+"</td>"
                                            +"<td>"+b.NV1+"</td>"
                                            +"<td>"+b.NV2+"</td>"
                                            +"<td>"+b.NV3+"</td>"
                                            +"<td>"+b.NV4+"</td>"
                                        +"</tr>";
                            $(newRow).appendTo("#tb_ubicacion tbody");
                        });
                        $("#btnDeletePart").removeClass('hide-element');
                        TIPO_OPERACION = 'A';
                        Swal.fire( 'Exito!', 'Ahora puedes agregar un Proveedor y una Ubicacion!.', 'success');
                        $("#modalAddProv").modal('hide');
                    }else{
                        //limpiamos los campos
                        $("#fechaAlta").val(TODAY);
                        $("#codAlterno").val('');
                        $("#tipoInvt").val();
                        $("#dscTxt").val('');
                        $("#fichaTecnica").val('');
                        $("#minimo").val('');
                        $("#maximo").val('');
                        $("#reOrden").val('');
                        $("#costRepo").val('');
                        $("#ultCosto").val('');
                        $("#ultCompra").val('');
                        $("#tipoInvt").empty().append("<option value='0'> - Selecionar - </option>");
                        $("#idPart").attr("value",json.idPart);
                        console.error(json.response_msg);
                        Swal.fire( 'Error!', json.response_msg, 'error');
                    }
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });

            //Desbloqueo de los botonoes de proveedor y ubicacion
            $("#addUbic").prop('disabled','');
            $("#deleteUbic").prop('disabled','');
            $("#addProv").prop('disabled','');
            $("#deleteProv").prop('disabled','');
			
		}
	});
});

$(function(){
    $("#btnDeletePart").click(function(){

    });
});


/**
* Metodo para mostrar la moda para agregar un proveedor
* o una ubicacion de la parte.
*/
$(function(){
        $("#addProv").click(function(){
        $("#modalAddProv").modal('show');
    });

    $("#addUbic").click(function(){
        $("#modalAddUbic").modal('show');
    });
});


$(function(){

	//traemos la informacion del proveedor 
	$("#saveAddProv").click(function(){
        
        var idProv = $("#slcProv").val();
        var checkBoxPrin = "No";

        if($("#provPrin").prop("checked") === true){
            checkBoxPrin = "Si";
        }

        if(idProv === '0' || idProv === ""){
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Es necesario selecionar un provedor para la relacion!' });
        }else{
            // ejecutamos la funcion de guardar info
            if(getInfoRelProv(idProv,checkBoxPrin)){
                saveRelProv(idProv,ID_PARTE,CODIGO_ALTERNO,checkBoxPrin);
            }
        }

	});

});

/**
* funcion para llamar el metodo ajax
* de busqueda de la inforamcion de un proveedor
* recibe el id del proveedor, el del checkbox
* para saber si es un proveedor principal.
* @param idPorv
* @param checkBoxPrin
*/
function getInfoRelProv(idProv,checkBoxPrin){
    var getCorrec = false;
    $.ajax({
        async:false,
        url:BASE_PATH + 'almacen/Partes/getInfoProv',
        type:'POST',
        dataType:'json',
        data:{
            id_prov : idProv
        },
        success:function(json) {
            if(json.response_code === "200"){
                //Agregamos el Reistro a la tabla
                var newRow = "<tr id='tr-"+json.proveedor.Id_Proveedor+"'>"
                                +"<td>"+json.proveedor.Id_Proveedor+"</td>"
                                +"<td>"+json.proveedor.RazonSocial+"</td>"
                                +"<td>"+CODIGO_ALTERNO+"</td>"
                                +"<td>"+checkBoxPrin+"</td>"
                                +"<td>"+json.proveedor.Dias_Entrega+"</td>"
                            +"</tr>";
                $(newRow).appendTo("#tb_proveedor tbody");
                $("#slcProv").find("option[value='"+idProv+"']").remove();
                $("#provPrin").prop("checked",false);
                getCorrec = true;

            }else{
                console.log(json.response_msg);
            }
        },
        error : function(xhr, status) {
            console.log("algo salio mal");
        }
    });
    return getCorrec;
}

/**
* funcion para guardar la relacion entre una parte
* y un proveedor , recibe el id del proveedor
* el id de la parte, el codigo alterno y el valor checkbox
* para saber si es un priveddor principal
* @param idProv
* @param idParte
* @param codigoAlterno
* @param isPrincipal
*/
function saveRelProv(idProv,idParte,codigoAlterno,isPrincipal){
    var isCorrect = false;
    $.ajax({
        async:false,
        url:BASE_PATH + 'almacen/Partes/saveRelPartProv',
        type:'POST',
        dataType:'json',
        data:{
            id_prov : idProv,
            id_part : idParte,
            cod_alterno : codigoAlterno,
            is_principal : isPrincipal
        },
        success:function(json) {
            if(json.response_code === "200"){

                $("#modalAddProv").modal('hide');
                isCorrect = true;
            }
        },
        error : function(xhr, status) {
            console.log("algo salio mal");
        }
    });
    return isCorrect;
}


/**
* metodo para obtener las ubicaciones y llenar
* el select 2 quitando la que se haya seleccionado
* del select 1
*/
$(function(){

    $("#slcNv1").on('change',function(){
        ID_SLC_NV1 = $("#slcNv1").val();

        if(ID_SLC_NV1 === '0'){

            $("#slcNv2").empty().append("<option value='0'>- Seleccione un Nivel 2 -</option>");
            $("#slcNv3").empty().append("<option value='0'>- Seleccione un Nivel 3 -</option>");
            $("#slcNv4").empty().append("<option value='0'>- Seleccione un Nivel 4 -</option>");

        }else{
            $.ajax({
                url:BASE_PATH + 'almacen/Partes/getUbicNv',
                type:'POST',
                dataType:'json',
                data:{
                    id_nv1 : ID_SLC_NV1
                },
                success:function(json) {
                    if(json.response_code === "200"){

                        $.each(json.nvlUbic,function(i,ub){
                            $("#slcNv2").append("<option value='"+ub.Id_Ubicacion+"'>"+ub.Nombre+"</option>");
                        });

                        $("#slcNv2").find("option[value='"+ID_SLC_NV1+"']").remove();
                    }
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });

        }
    });
});

/**
* funcion para llenar el select del nivel 3,
* qutando lo que se selecciono en el nivel 1 y nivel 2
* @param ID_SLC_NV2
*/
$(function(){

    $("#slcNv2").on('change',function(){
        ID_SLC_NV2 = $("#slcNv2").val();

        if(ID_SLC_NV2 === '0'){
            //ponemos en el opcion 1 a todos los niveles
            $("#slcNv3").empty().append("<option value='0'>- Seleccione un Nivel 3 -</option>");
            $("#slcNv4").empty().append("<option value='0'>- Seleccione un Nivel 4 -</option>");
        }else{
            $.ajax({
                url:BASE_PATH + 'almacen/Partes/getUbicNv',
                type:'POST',
                dataType:'json',
                data:{
                    id_nv1 : ID_SLC_NV2
                },
                success:function(json) {
                    if(json.response_code === "200"){

                        // llenamos el select 2
                        $.each(json.nvlUbic,function(i,ub){
                            $("#slcNv3").append("<option value='"+ub.Id_Ubicacion+"'>"+ub.Nombre+"</option>");
                        });

                        $("#slcNv3").find("option[value='"+ID_SLC_NV1+"']").remove();
                        $("#slcNv3").find("option[value='"+ID_SLC_NV2+"']").remove();
                        //quitamos del select 3 el slcNV1 y el 
                    }
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });

        }
    });
});

/**
* Metodo apra detectar cuando se selecione una opcion
* y caragar el select 4 , quitando los que coincidan con 
* los select 1,2, y 3
* @param ID_SLC_NV3
*/
$(function(){

    $("#slcNv3").on('change',function(){
        ID_SLC_NV3 = $("#slcNv3").val();

        if(ID_SLC_NV3 === '0'){
            //ponemos en el opcion 1 a todos los niveles
            $("#slcNv4").empty().append("<option value='0'>- Seleccione un Nivel 4 -</option>");
        }else{
            $.ajax({
                url:BASE_PATH + 'almacen/Partes/getUbicNv',
                type:'POST',
                dataType:'json',
                data:{
                    id_nv1 : ID_SLC_NV3
                },
                success:function(json) {
                    if(json.response_code === "200"){

                        // llenamos el select 2
                        $.each(json.nvlUbic,function(i,ub){
                            $("#slcNv4").append("<option value='"+ub.Id_Ubicacion+"'>"+ub.Nombre+"</option>");
                        });

                        $("#slcNv4").find("option[value='"+ID_SLC_NV1+"']").remove();
                        $("#slcNv4").find("option[value='"+ID_SLC_NV2+"']").remove();
                        $("#slcNv4").find("option[value='"+ID_SLC_NV3+"']").remove();
                        //quitamos del select 3 el slcNV1 y el 
                    }
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });

        }
    });
});

/**
* Metodo para agregar la relacion ubicacion de las partes
* recibe el id de la parte, el id del almacen,
* la ubicaicon 1, ubicacion 2 , ubicacion 3 , ubicacion 4
* @param ID_PARTE
* @param idAlmacen
* @param ID_SLC_NV1
* @param ID_SLC_NV2
* @param ID_SLC_NV3
* @param ID_SLC_NV4
*/
$(function(){
    $("#slcAlm").on('change',function(){
        ID_SLC_ALM = $(this).val();
    });

    $("#slcNv4").on('change',function(){
        ID_SLC_NV4 = $(this).val();
    });


    $("#saveAddUbic").click(function(){
        var isValidForm = true;
        if(ID_SLC_ALM === '0'){
            isValidForm = false;
        }else if(ID_SLC_NV1 === '0'){
            isValidForm = false;
        }


        if(isValidForm){
            $.ajax({
                url:BASE_PATH + 'almacen/Partes/saveRelUbic',
                type:'POST',
                dataType:'json',
                data:{
                    id_alm : ID_SLC_ALM,
                    id_parte : ID_PARTE,
                    id_nv1 : ID_SLC_NV1,
                    id_nv2 : ID_SLC_NV2,
                    id_nv3 : ID_SLC_NV3,
                    id_nv4 : ID_SLC_NV4
                },
                success:function(json) {
                    if(json.response_code === "200"){
                        var alm = $("#slcAlm option:selected").text();
                        var nv1 = $("#slcNv1 option:selected").text();
                        var nv2 = $("#slcNv2 option:selected").text();
                        var nv3 = $("#slcNv3 option:selected").text();
                        var nv4 = $("#slcNv4 option:selected").text();
                        // llenamos la tabla con la informacion que se selecciono
                        var newRow = "<tr id='tr-ubc-"+ID_SLC_ALM+"'>"
                                        +"<td>"+ID_SLC_ALM+"</td>"
                                        +"<td>"+alm+"</td>"
                                        +"<td>"+nv1+"</td>"
                                        +"<td>"+nv2+"</td>"
                                        +"<td>"+nv3+"</td>"
                                        +"<td>"+nv4+"</td>"
                                    +"</tr>";
                        $(newRow).appendTo("#tb_ubicacion tbody");
                        //limipamos los campos de la modal
                        $("#slcAlm").val('0');
                        $("#slcNv1").val('0');
                        $("#slcNv2").empty().append("<option value='0'>- Seleccione un Nivel 2 -</option>");
                        $("#slcNv3").empty().append("<option value='0'>- Seleccione un Nivel 3 -</option>");
                        $("#slcNv4").empty().append("<option value='0'>- Seleccione un Nivel 4 -</option>");
                        //ocultamos la modal
                        $("#modalAddUbic").modal('hide');
                    }
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });
        }
    });
});


/**
* deleteUbic
* deleteProv
*/


/**
* funcion para borrar los elementos de la tabla de proveedores
*/
$(function(){
    $("#deleteUbic").click(function(){
        var numRowsTab = "";
        $("#tb_ubicacion tbody tr").each(function (index) {
            numRowsTab = index;
        });
        
        if(numRowsTab === ""){
            Swal.fire( 'Errror!', 'debe de existir una relaion para eliminar!.', 'error');
            console.error("debe tener almenos una ubicacion");
        }else{
            var idUbc = $("#tb_ubicacion tr:last").attr('id');
            var realIdUbc = idUbc.split("-");

            $.ajax({
                url:BASE_PATH + 'almacen/Partes/dropRelProv',
                type:'POST',
                dataType:'json',
                data:{
                    id_prov : realIdUbc[2],
                    id_part : ID_PARTE,
                    tipo_del : 'U'
                },
                success:function(json) {
                    if(json.response_code === "200"){
                        Swal.fire( 'Exito!', 'Se elimino la relacion de ubicacion!.', 'success');
                        $("#tb_ubicacion tr:last").remove();
                    }   
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });
        }
    });

    $("#deleteProv").click(function(){
        var numRowsTab = "";
        $("#tb_ubicacion tbody tr").each(function (index) {
            numRowsTab = index;
        });

        if(numRowsTab === ""){
            Swal.fire( 'Errror!', 'debe de existir una relaion para eliminar!.', 'error');
            console.error("debe tener almenos un proveedor");
        }else{
            var idProv = $("#tb_proveedor tr:last").attr('id');
            var realIdProv = idProv.split("-");

            $.ajax({
                url:BASE_PATH + 'almacen/Partes/dropRelProv',
                type:'POST',
                dataType:'json',
                data:{
                    id_prov : realIdProv[2],
                    id_part : ID_PARTE,
                    tipo_del : 'P'
                },
                success:function(json) {
                    if(json.response_code === "200"){
                        Swal.fire( 'Exito!', 'Se elimino la relacion del provedor!.', 'success');
                        $("#tb_proveedor tr:last").remove();
                    }   
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });
        }

    });
});

$(function(){

    $("#btnDeletePart").click(function(){

        if(ID_PARTE == ""){
            Swal.fire( 'Errror!', 'La parte aun no existe.', 'error');
        }else{

            $.ajax({
                url:BASE_PATH + 'almacen/Partes/dropAllParte',
                type:'POST',
                dataType:'json',
                data:{
                    id_parte : ID_PARTE,
                },
                success:function(json) {
                    if(json.response_code === "200"){
                        $("#fechaAlta").val(TODAY);
                        $("#codAlterno").val('');
                        $("#tipoInvt").val();
                        $("#dscTxt").val('');
                        $("#fichaTecnica").val('');
                        $("#minimo").val('');
                        $("#maximo").val('');
                        $("#reOrden").val('');
                        $("#costRepo").val('');
                        $("#ultCosto").val('');
                        $("#ultCompra").val('');
                        $("#tipoInvt").empty().append("<option value='0'> - Selecionar - </option>");
                        $("#tb_ubicacion tbody").html("");
                        $("#tb_proveedor tbody").html("");
                        $("#idPart").attr("value",json.idPart);
                        $("#addUbic").prop('disabled','disabled');
                        $("#deleteUbic").prop('disabled','disabled');
                        $("#addProv").prop('disabled','disabled');
                        $("#deleteProv").prop('disabled','disabled');
                        TIPO_OPERACION = 'S';
                        Swal.fire( 'Exito!', 'Se elimino la parte con exito!.', 'success');
                    }   
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });
        }
    });
});