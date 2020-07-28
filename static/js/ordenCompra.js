var loaderPage = $('.preloader');
var ID_PROV_SEARCH = '';
var ID_PROP_SEARCH = '';
var CANT_ORDEN = 0;
var COST_UNI_ORDEN = 0;
var TOT_ORDEN = 0;
var ID_PARTE_ORDEN = '0';
var TIPO_ORDEN = 'A'; //-> A para alta y C para cambio
var NOW = new Date();
var TODAY = NOW.getFullYear() + '-' + (NOW.getMonth() + 1) + '-' + NOW.getDate();
var IMPUESTO_VAL = 0.16;

$(function(){
	//funcion para cargar la fecha actual en el inpt de fecha
	$("#fchOrden").val(TODAY);

	//funcion para desactivar el envio en el action del form
	$("#form_orden_one").submit(function(){
		return false;
	});

	//funcion para mostrar el modal al preciona el boton de nueva partida
	$("#newParOrdenComp").click(function(){
		$("#modalOrdenCompra").modal("show");
	});

	/*
	* funcion para detectar el option que se 
	* selecione del select de proveedores
	*/
	$("#slcProv").on('change',function(){
		ID_PROV_SEARCH = $(this).val();
	});
	//funcion para hacer la busqueda del proveedor
	$("#searchOrdProv").click(function(){

		var nameProv = $("#provOrden").val();

		if(nameProv === "" || nameProv === null){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del proveedor no puede estar vacio vacia!' });
		}else{
			$.ajax({
	            url:BASE_PATH + 'almacen/OrdenCompra/searchPropProv',
	            type:'POST',
	            dataType:'json',
	            data:{
	               	name : nameProv,
	                tipo_search : 'A'
	            },
	            success:function(json) {
	                if(json.response_code === "200"){

	                	if(json.proveedor === null){
	                		Swal.fire({ type: 'error', title: 'Oops...', text: 'No se encontro ningun proveedor con ese nombre!' });
	                		//limpiamos los campos
	                		$("#rsProv").attr('value','');
	                		ID_PROV_SEARCH = '';
	                	}else{
	                		$("#slcProv").empty().append("<option value='0'> - Selecionar Proveedor - </option>");
	                		$.each(json.proveedores,function(i,pv){
                            	$("#slcProv").append("<option value='"+pv.Id_Proveedor+"'>"+pv.RazonSocial+"</option>");
                        	});
	                	}
	                }
	            },
	            error : function(xhr, status) {
	            	console.log("algo salio mal");
	            }
	        });
		}
	});

	/*funcion para detectar el option que se 
	* selecione del select de propietarios
	*/
	$("#slcProp").on('change',function(){
		ID_PROP_SEARCH = $(this).val();
	});

	//funcion para hacer la busqueda del propietario
	$("#searchOrdProp").click(function(){
		
		var nameProp = $("#propOrden").val();

		if(nameProp === "" || nameProp === null){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del propietario no puede estar vacio vacia!' });
		}else{

			$.ajax({
	            url:BASE_PATH + 'almacen/OrdenCompra/searchPropProv',
	            type:'POST',
	            dataType:'json',
	            data:{
	               	name : nameProp,
	                tipo_search : 'B'
	            },
	            success:function(json) {
	                if(json.response_code === "200"){

	                	if(json.propietario === null){
	                		Swal.fire({ type: 'error', title: 'Oops...', text: 'No se encontro ningun propietario con ese nombre!' });
	                		$("#slcProp").val("0");
	                		ID_PROP_SEARCH = '';
	                	}else{
	                		$("#slcProp").empty().append("<option value='0'> - Selecionar Propietario - </option>");
	                		$.each(json.propietarios,function(i,pp){
                            	$("#slcProp").append("<option value='"+pp.Id_Propietario+"'>"+pp.RazonSocial+"</option>");
                        	});
	                	}
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

	//agregamos a la tabla las ordenes de compra
	$("#addPartOrden").click(function(){
		var desc_parte = $("#slcProducto option:selected").text();
		CANT_ORDEN = $("#cantidadOrden").val();
		COST_UNI_ORDEN = parseFloat($("#costUni").val());
		TOT_ORDEN = parseFloat(CANT_ORDEN * COST_UNI_ORDEN);
		ID_PARTE_ORDEN = $("#slcProducto").val();

		//agregamos el contendio a la tabla
        var newRow = "<tr id='tr-ord-"+ID_PARTE_ORDEN+"'>"
                       	+"<td>"+ID_PARTE_ORDEN+"</td>"
                        +"<td>"+desc_parte+"</td>"
                        +"<td>"+CANT_ORDEN+"</td>"
                        +"<td>"+ COST_UNI_ORDEN.toFixed(2) +"</td>"
                        +"<td>"+ TOT_ORDEN.toFixed(2) +"</td>"
                		+"<td>"
                    		+"<button type='button' class='btn btn-danger delete-part' data-id='"+ID_PARTE_ORDEN+"' data-toggle='tooltip' data-placement='top' title='Eliminar Parte'>"
                        		+"<i class='fa fa-trash-o'></i>"
                    		+"</button>"
                    		+"<button type='button' class='btn btn-warning edit-part' style='margin-left: 4px;' data-id='"+ID_PARTE_ORDEN+"' data-toggle='tooltip' data-placement='top' title='Editar Parte'>"
                        		+"<i class='fa fa-pencil-square-o'></i>"
                    		+"</button>"
                		+"</td>"
                    +"</tr>";
       	$(newRow).appendTo("#table_partidas_orden tbody");

       	//funcion para llenar el campo de suma y subtotal
       	llenarCamposFinalesSuma(TOT_ORDEN);
		//limpiamos campos y cerramos el modal
		$("#cantidadOrden").val('');
		$("#costUni").val('');
		$("#slcProducto").val('0');
		$("#modalOrdenCompra").modal("hide");
	});
});


function llenarCamposFinalesSuma(totalOrden){
	
	// obtenemos valores anteriores
	var subTotalAnt = parseFloat($("#txtSub").val());
	var impuestoAnt = parseFloat($("#txtImp").val());
	var totalAnt = parseFloat($("#txtTot").val());

	// sumamos los anteriores con los actuales
	var totalImpuesto  = (totalOrden * IMPUESTO_VAL) + impuestoAnt;
	var totalFinal = (totalImpuesto + totalOrden) + subTotalAnt;
	var subtotalFinal = totalOrden + subTotalAnt;

	//llenamos los campos finales
	$("#txtSub").val(subtotalFinal.toFixed(2));
	$("#txtImp").val(totalImpuesto.toFixed(2));
	$("#txtTot").val(totalFinal.toFixed(2));
}


$(function(){
    $("#table_partidas_orden tbody").on('click','.delete-part',function(){

        var id_part = "#tr-ord-"+$(this).attr('data-id');

        var subtotal = parseFloat($(this).parents("tr").find("td").eq(4).html());
        //Se pregunta si quiere eliminar el registro
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
                    $(id_part).remove();
                    llenarCamposFinalesResta(subtotal);
            }
        });
    });
});

function llenarCamposFinalesResta(subTotal) {
    // obtenemos valores anteriores
    var subTotalAnt = parseFloat($("#txtSub").val());
    var impuestoAnt = parseFloat($("#txtImp").val());
    var totalAnt = parseFloat($("#txtTot").val());

    var subNew = subTotalAnt - subTotal;
    var impuestoResta = subTotal * IMPUESTO_VAL;
    var impuestoNew = impuestoAnt - impuestoResta;
    var totalNew = totalAnt - (impuestoResta + subTotal);

    console.log(subNew);
    console.log(impuestoNew);
    console.log(totalNew);

    $("#txtSub").val(subNew.toFixed(2));
    $("#txtImp").val(impuestoNew.toFixed(2));
    $("#txtTot").val(totalNew.toFixed(2));
}

/**
 * Metodo apra guardar las ordenenes de compra
 */
$(function () {
    $("#btnSaveOrden").click(function () {
        // disabled the save button
        $("#btnSaveOrden").prop("disabled", true);

        var folio_orden = $("#folOrden").val();
        var serie_orden = $("#serieOrden").val();
        var fecha_orden = $("#fchOrden").val();
        var obs_orden = $("#txtAreaOrden").val();
        var partes_orden = [];
        var sub_total_orden = parseInt($("#txtSub").val());
        var impuesto_orden = parseInt($("#txtImp").val());
        var total_orden = parseInt($("#txtTot").val());

        //obtenemos los valores de la tabla
        $("#table_partidas_orden tbody tr").each(function (index) {

            var camp1, camp2, camp3, camp4;
            var parte = new Object();

            $(this).children("td").each(function (index2) {
                switch (index2) {
                    case 0 :
                        camp1 = $(this).text();
                        break;
                    case 2 :
                        camp2 = $(this).text();
                        break;
                    case 3 :
                        camp3 = $(this).text();
                        break;
                    case 4 :
                        camp4 = $(this).text();
                        break;
                }
            });
            // asiganos los valores
            parte.id = camp1;
            parte.cantidad = camp2;
            parte.costo = camp3;
            parte.total = camp4;
            // agregamos la parte al arreglo
            partes_orden.push(parte);
        });

        if (partes_orden.length === 0) {

            Swal.fire({ 
                type: 'error',
                title: 'Oops...',
                text: 'Para hacer la orden de compra se necesita agregar almenos 1 parte'
            });
            
            $("#btnSaveOrden").prop("disabled", false);
            return;
        }
        
        var input = $('#pdfOrden')[0];
        if (input.files && input.files[0]) {

            uploadPdf(folio_orden, serie_orden, fecha_orden, obs_orden, partes_orden, 
                      sub_total_orden, impuesto_orden, total_orden);
        } else {
            
            saveOrden(folio_orden, serie_orden, fecha_orden, obs_orden, partes_orden, 
                      sub_total_orden, impuesto_orden, total_orden, null);
        }
    });
});


$(function () {

    $("#btnOrdenCan").click(function () {

        $("#folOrden").val("");
        $("#serieOrden").val("");
        $("#fchOrden").val(TODAY);

        $("#provOrden").val('');
        $("#propOrden").val('');
        ID_PROV_SEARCH = '';
        ID_PROP_SEARCH = '';
        $("#slcProv").empty().append("<option value='0'> - Selecionar Proveedor - </option>");
        $("#slcProp").empty().append("<option value='0'> - Selecionar Propietario - </option>");

        $("#txtAreaOrden").val("");
        $("#table_partidas_orden tbody").html("");
        $("#txtSub").attr('value','0.00');
        $("#txtImp").attr('value','0.00');
        $("#txtTot").attr('value','0.00');
        //cambiamos el estatus de la bandera
        TIPO_ORDEN = 'A';

    });

    //metodo para buscar la orden de compra
    $("#btnOrdenEdit").click(function () {

        var isValidSearch = true;

        if ($("#folOrden").val() === null || $("#folOrden").val() === "") {
            Swal.fire({type: 'error', title: 'Oops...', text: 'Para realizar la busqueda debe de ingresa el folio!'});
            isValidSearch = false;
        } else if ($("#serieOrden").val() === null || $("#serieOrden").val() === "") {
            Swal.fire({type: 'error', title: 'Oops...', text: 'Para realziar la busqueda debe de ingresa la serie!'});
            isValidSearch = false;
        }

        // si es valido hacemos la peticion ajax
        if (isValidSearch) {
            loaderPage.fadeIn();
            $.ajax({
                url: BASE_PATH + 'almacen/OrdenCompra/getInfoOrdenCompra',
                type: 'POST',
                dataType: 'json',
                data: {
                    folioOrden: $("#folOrden").val(),
                    serieOrden: $("#serieOrden").val()

                },
                success: function (json) {
                    if (json.response_code === "200" || json.response_code === "202") {

                        $("#idOrden").attr('value', json.infoOrden.Id_Orden);
                        $("#fchOrden").val(json.infoOrden.FechaAlta);
                        $("#txtAreaOrden").val(json.infoOrden.Observaciones);
                        $("#txtSub").attr('value', json.infoOrden.Subtotal);
                        $("#txtImp").attr('value', json.infoOrden.Impuestos);
                        $("#txtTot").attr('value', json.infoOrden.Total);
                        //agregamos al select los valores que trae la orden
                        $("#slcProv").empty().append("<option value='0'> - Selecionar Proveedor - </option>");
                        $("#slcProp").empty().append("<option value='0'> - Selecionar Propietario - </option>");
                        $("#slcProv").append("<option value='" + json.infoOrden.Id_Proveedor + "' selected>" + json.infoOrden.Proveedor + "</option>");
                        $("#slcProp").append("<option value='" + json.infoOrden.Id_Propietario + "' selected>" + json.infoOrden.Propietario + "</option>");
                        ID_PROV_SEARCH = json.infoOrden.Id_Proveedor;
                        ID_PROP_SEARCH = json.infoOrden.Id_Propietario;

                        //agremaos los registros a la tabla
                        $("#table_partidas_orden tbody").html("");
                        $.each(json.infoDetalleOrden, function (i, dt) {
                            var newRow = "<tr id='tr-ord-" + dt.Id_Parte + "'>"
                                    + "<td>" + dt.Id_Parte + "</td>"
                                    + "<td>" + dt.Descripcion + "</td>"
                                    + "<td>" + dt.Cantidad + "</td>"
                                    + "<td>" + dt.Costo + "</td>"
                                    + "<td>" + dt.Costo_Total + "</td>"
                                    + "<td>"
                                    + "<button type='button' class='btn btn-danger delete-part' data-id='" + dt.Id_Parte + "' data-toggle='tooltip' data-placement='top' title='Eliminar Parte'>"
                                    + "<i class='fa fa-trash-o'></i>"
                                    + "</button>"
                                    + "<button type='button' class='btn btn-warning edit-part' style='margin-left: 4px;' data-id='" + dt.Id_Parte + "' data-toggle='tooltip' data-placement='top' title='Editar Parte'>"
                                    + "<i class='fa fa-pencil-square-o'></i>"
                                    + "</button>"
                                    + "</td>"
                                    + "</tr>";
                            $(newRow).appendTo("#table_partidas_orden tbody");
                        });
                        //indicamos de que tipo sera si se guarda
                        TIPO_ORDEN = 'C';
                        if (json.response_code === "202") {
                            Swal.fire({type: 'info', title: 'Un detalle ...', text: json.response_msg});
                        }
                        $("#btnBajaOrden").removeClass('hide-element');
                        loaderPage.fadeOut();
                    } else if (json.response_code === "201") {
                        loaderPage.fadeOut();
                        $("#btnOrdenCan").click();
                        var msgError = json.response_code + " : " + json.response_msg;
                        Swal.fire({type: 'error', title: 'Oops...', text: msgError});
                    }
                },
                error: function (xhr, status) {
                    console.log("algo salio mal");
                    loaderPage.fadeOut();
                }
            });
        }
    });
});

$(function(){

    $("#btnOrdenAut").click(function(){
        $.ajax({
            url:BASE_PATH + 'almacen/OrdenCompra/ordenAut',
            type:'POST',
            dataType:'json',
            data:{
                id_orden : $("#idOrden").val()
            },
            success:function(json) {
                if(json.response_code === "200"){
                    $("#btnOrdenCan").click();
                    Swal.fire( 'Autorizado!', 'La orden de compra se autorizo!.', 'success');
                }
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });
    });
});

function readURL(input) {

    if (input.files && input.files[0]) {

        var filename = input.files[0].name;
        $("#filenameLabel").html('<i class="fa fa-file-pdf-o"></i> ' + filename);
    } else {
        
        $("#filenameLabel").html('<i class="fa fa-file-pdf-o"></i> Adjuntar PDF');
    }
}

function saveOrden(folio_orden, serie_orden, fecha_orden, obs_orden, partes_orden, 
                   sub_total_orden, impuesto_orden, total_orden, fileName) {
         
    $.ajax({
      url: BASE_PATH + 'almacen/OrdenCompra/saveOrdenCompra',
      type: 'POST',
      dataType: 'json',
      data: {
          idOrden: $("#idOrden").val(),
          proveedorOrden: ID_PROV_SEARCH,
          propietarioOrden: ID_PROP_SEARCH,
          tipoOper: TIPO_ORDEN,
          folioOrden: folio_orden,
          serieOrden: serie_orden,
          fechaOrden: fecha_orden,
          observacionOrden: obs_orden,
          partidasOrden: partes_orden,
          subOrden: sub_total_orden,
          impOrden: impuesto_orden,
          totOrden: total_orden,
          filename: fileName
    }, success: function (json) {
          if (json.response_code === "200") {

              $("#btnSaveOrden").prop("disabled", false);
              Swal.fire({type: 'success', title: 'Registro Exitoso!', text: 'Oden de compra Guardada correctamente'});
              //limpiamos campos
              $("#folOrden").val("");
              $("#serieOrden").val("");
              $("#fchOrden").val(TODAY);

              $("#provOrden").val('');
              $("#propOrden").val('');
              ID_PROV_SEARCH = '';
              ID_PROP_SEARCH = '';
              //$("#rsProv").attr('value','');
              //$("#rsProp").attr('value','');
              $("#slcProv").empty().append("<option value='0'> - Selecionar Proveedor - </option>");
              $("#slcProp").empty().append("<option value='0'> - Selecionar Propietario - </option>");

              $("#txtAreaOrden").val("");
              $("#table_partidas_orden tbody").html("");
              //$("#txtSub").attr('value','');
              //$("#txtImp").attr('value','');
              //$("#txtTot").attr('value','');
              $("#txtSub").val('0');
              $("#txtImp").val('0');
              $("#txtTot").val('0');
          }
      }, error: function (xhr, status) {

          $("#btnSaveOrden").prop("disabled", false);
          console.log("algo salio mal");
      }
    });
}

function uploadPdf(folio_orden, serie_orden, fecha_orden, obs_orden, partes_orden, 
                   sub_total_orden, impuesto_orden, total_orden) {

    // Get form
    var form = $('#fileUploadForm')[0];

    console.log("form", form);

    // Create an FormData object 
    var data = new FormData(form);

    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: BASE_PATH + 'almacen/OrdenCompra/uploadPDF',
        data: data,
        processData: false,
        contentType: false,
        dataType: 'json',
        cache: false,
        timeout: 600000,
        success: function (data) {

            console.log("SUCCESS : ", data.filename);
            $("#pdfOrden").val(null);
            $("#filenameLabel").html('<i class="fa fa-file-pdf-o"></i> Adjuntar PDF');
            saveOrden(folio_orden, serie_orden, fecha_orden, obs_orden, partes_orden, 
                      sub_total_orden, impuesto_orden, total_orden, data.filename);
        }, error: function (e) {

            console.log("ERROR : ", e);
            $("#pdfOrden").val(null);
            $("#filenameLabel").html('<i class="fa fa-file-pdf-o"></i> Adjuntar PDF');
            $("#btnSaveOrden").prop("disabled", false);
        }
    });
}

$(function(){

    $("#btnBajaOrden").click(function(){
        $.ajax({
            url:BASE_PATH + 'almacen/OrdenCompra/cancelarOrden',
            type:'POST',
            dataType:'json',
            data:{
                id_orden : $("#idOrden").val()
            },
            success:function(json) {
                if(json.response_code === "200"){
                    $("#btnOrdenCan").click();
                    Swal.fire( 'Cancelada!', 'La orden de compra se cancelo!.', 'success');
                    $("#btnBajaOrden").addClass('hide-element');
                    $("#idOrden").attr('value',json.idOrden);
                }
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });
    });
});

