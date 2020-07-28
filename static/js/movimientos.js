var BTN_EDITAR = false;
// atrinutos tanla de partes
var TB_ID_PARTE = '';
var TB_DSC = '';
var TB_CANT = '';
var TB_COST_UNI = '';
var TB_COST_TOT = '';

$(function(){


	$("#btnSaveMov").click(function(){
		var movimiento = $('input:radio[name=tipo_mov]:checked').attr('id');
		var formMov = true;

		if( $("#folioMov").val() === null || $("#folioMov").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El folio no puede estar vacio!' });
			formMov = false;
		}else if( $("#serieMov").val() === null || $("#serieMov").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El numero de serie no puede estar vacio!' });
			formMov = false;
		}else if( $("#fechaMov").val() === null || $("#fechaMov").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'La fecha no puede estar vacia!' });
			formMov = false;
		}else if( $("#slcConcepMov").val() === null || $("#slcConcepMov").val() === "0" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El concepto no puede estar vacio!' });
			formMov = false;
		}else if( $("#slcAlmMov").val() === null  || $("#slcAlmMov").val() === "0" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El almacen no puede estar vacio!' });
			formMov = false;
		}else if( $("#obsMov").val() === null || $("#obsMov").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'La observacion no puede estar vacia!' });
			formMov = false;
		}

		if(formMov){

		var partes_ajuste = [];
		//obtenemos los valores de la tabla
        $("#tabla_parte tbody tr").each(function (index) {

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
            	partes_ajuste.push(parte);
        	});

			if(BTN_EDITAR === false){
				// Guardar la informacion de un movimiento
				$.ajax({
					url:BASE_PATH + 'almacen/MovAlmacen/addMovAlmacen',
					type:'POST',
					dataType:'json',
					data:{
						folio_mov : $("#folioMov").val(),
						serie_mov : $("#serieMov").val(),
						fech_mov : $("#fechaMov").val(),
						tipo_mov_id : $("#slcConcepMov").val(),
						alm_mov_id : $("#slcAlmMov").val(),
						obs_mov : $("#obsMov").val(),
						tipo_mov : movimiento,
						tabla_parte : partes_ajuste,
						total_mov :$("#total_final").val()
					},
					success:function(json) {
						if(json.response_code === "200"){
							$("#btnLimpMov").click();
							Swal.fire({ type: 'success', title: 'Exito!', text: 'Operacion Exitosa!' });
						}
	                },
	                error : function(xhr, status) {
	                	console.log("algo salio mal");
	                }
	            });

			}else{
			// Editar la informacion de un movimiento
				$.ajax({
					url:BASE_PATH + 'almacen/MovAlmacen/editMovimiento',
					type:'POST',
					dataType:'json',
					data:{
						id_mov : $("#idMov").val(),
						folio_mov : $("#folioMov").val(),
						serie_mov : $("#serieMov").val(),
						fech_mov : $("#fechaMov").val(),
						tipo_mov_id : $("#slcConcepMov").val(),
						alm_mov_id : $("#slcAlmMov").val(),
						obs_mov : $("#obsMov").val(),
						tipo_mov : movimiento,
						tabla_parte : partes_ajuste,
						total_mov :$("#total_final").val()
					},
					success:function(json) {
						if(json.response_code === "200"){
							$("#folioMov").val('');
							$("#serieMov").val('');
							$("#fechaMov").val('');
							$("#slcConcepMov").val('');
							$("#slcAlmMov").val('');
							$("#obsMov").val('');

							BTN_EDITAR = false;
							$("#btnBajaMov").addClass('hide-element');
							
							Swal.fire({ type: 'success', title: 'Exito!', text: 'Operacion Exitosa!' });
						}
	                },
	                error : function(xhr, status) {
	                	console.log("algo salio mal");
	                }
	            });
			}

		}

	});

	$("#newParteMov").click(function(){
		$("#modalPartMov").modal('show');
	});

	$("#btnLimpMov").click(function(){
		
		$("#folioMov").val('');
		$("#serieMov").val('');
		$("#fechaMov").val('');
		$("#slcConcepMov").val('0');
		$("#slcAlmMov").val('0');
		$("#obsMov").val('');
		$('input:radio[name=tipo_mov]').prop('checked',false);
		$("#tabla_parte tbody").html("");
		$("#total_final").val(0.00);

	});

	$("#btnEditMov").click(function(){
		var validoEdt = true;
		if( $("#folioMov").val() === null || $("#folioMov").val() === ""){
			validoEdt = false;
 		}else if( $("#serieMov").val() === null || $("#serieMov").val() === ""){
 			validoEdt = false;
		}

		if(validoEdt){

			$.ajax({
				url:BASE_PATH + 'almacen/MovAlmacen/getInfoMov',
				type:'POST',
				dataType:'json',
				data:{
					folio_mov_edt : $("#folioMov").val(),
					serie_mov_edt : $("#serieMov").val()
				},
				success:function(json) {
					if(json.response_code === "200"){

						$("#btnBajaMov").removeClass('hide-element');
						BTN_EDITAR = true;
						$("#idMov").val(json.infoMovimiento.Id_Ajuste);
						$("#fechaMov").val(json.infoMovimiento.Fecha);
						$("#slcConcepMov").val(json.infoMovimiento.Id_TipoMov);
						$("#slcAlmMov").val(json.infoMovimiento.Id_Almacen);
						$("#obsMov").val(json.infoMovimiento.Observaciones);
						$("#total_final").val(json.infoMovimiento.Costotal);
						$("input:radio[name=tipo_mov][id='"+json.infoMovimiento.Tipo+"']").attr('checked',true);

						// rellenar la tabla de partes
						$("#tabla_parte tbody").html("");
                        $.each(json.detalleMov, function (i, dt) {

                            var newRow = "<tr id='tr-prt-" + dt.ID_PART + "'>"
                                    + "<td>" + dt.ID_PART + "</td>"
                                    + "<td>" + dt.Descripcion + "</td>"
                                    + "<td>" + dt.Cantidad + "</td>"
                                    + "<td>" + dt.Costo + "</td>"
                                    + "<td>" + dt.Costototal + "</td>"
                                    + "<td>"
                                    + "<button type='button' class='btn btn-danger delete-part' data-id='" + dt.ID_PART + "' data-toggle='tooltip' data-placement='top' title='Eliminar Parte'>"
                                    + "<i class='fa fa-trash-o'></i>"
                                    + "</button>"
                                    + "<button type='button' class='btn btn-warning edit-part' style='margin-left: 4px;' data-id='" + dt.ID_PART + "' data-toggle='tooltip' data-placement='top' title='Editar Parte'>"
                                    + "<i class='fa fa-pencil-square-o'></i>"
                                    + "</button>"
                                    + "</td>"
                                    + "</tr>";

                            $(newRow).appendTo("#tabla_parte tbody");
                        });
					}
                },
                error : function(xhr, status) {
                	console.log("algo salio mal");
                }
            });
		}
	});

	$("#slcParte").on('change',function(){
		var parteId = $(this).val();
		
		if(parteId !== '0'){
			$.ajax({
				url:BASE_PATH + 'almacen/MovAlmacen/getInfoParte',
				type:'POST',
				dataType:'json',
				data:{
					id_parte : parteId
				},
				success:function(json) {
					if(json.response_code === "200"){
						TB_ID_PARTE = parteId;
						$("#cantidadOrden").attr('max',json.numero.Exis_Final);
						TB_DSC = json.numero.Descripcion;
						TB_COST_UNI = json.numero.Costo;
					}
                },
                error : function(xhr, status) {
                	console.log("algo salio mal");
                }
            });
		}
	});

	$("#addPartMov").click(function(){
		
		TB_CANT = $("#cantidadOrden").val();
		var total = (TB_CANT * TB_COST_UNI);

        var newRow = "<tr id='tr-prt-"+TB_ID_PARTE+"'>"
                       	+"<td>"+TB_ID_PARTE+"</td>"
                        +"<td>"+TB_DSC+"</td>"
                        +"<td>"+TB_CANT+"</td>"
                        +"<td>"+TB_COST_UNI+"</td>"
                        +"<td>"+  total +"</td>"
                		+"<td>"
                    		+"<button type='button' class='btn btn-danger delete-part' data-id='"+TB_ID_PARTE+"' data-toggle='tooltip' data-placement='top' title='Eliminar Parte'>"
                        		+"<i class='fa fa-trash-o'></i>"
                    		+"</button>"
                    		+"<button type='button' class='btn btn-warning edit-part' style='margin-left: 4px;' data-id='"+TB_ID_PARTE+"' data-toggle='tooltip' data-placement='top' title='Editar Parte'>"
                        		+"<i class='fa fa-pencil-square-o'></i>"
                    		+"</button>"
                		+"</td>"
                    +"</tr>";
       	$(newRow).appendTo("#tabla_parte tbody");

       	var calculaTotal = creaTotal(total);

       	$("#total_final").val(calculaTotal);

       	$("#modalPartMov").modal('hide');
	});


	$("#btnBajaMov").click(function(){

		$.ajax({
			url:BASE_PATH + 'almacen/MovAlmacen/dropMovimiento',
			type:'POST',
			dataType:'json',
			data:{
				id_mov : $("#idMov").val()
			},
			success:function(json) {
				if(json.response_code === "200"){
					$("#btnLimpMov").click();
					Swal.fire({ type: 'success', title: 'Exito!', text: 'Operacion Exitosa!' });
				}
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });
	});

	$("#btnAutMov").click(function(){

		if($("#idMov").val() === '' || $("#idMov").val() === null){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'debe seleccionar un movimeito para autorizar' });
		}else{

			$.ajax({
				url:BASE_PATH + 'almacen/MovAlmacen/autorizarMovimiento',
				type:'POST',
				dataType:'json',
				data:{
					id_mov : $("#idMov").val()
				},
				success:function(json) {
					if(json.response_code === "200"){
						$("#btnLimpMov").click();
						Swal.fire({ type: 'success', title: 'Exito!', text: 'Operacion Exitosa!' });
					}
	            },
	            error : function(xhr, status) {
	                console.log("algo salio mal");
	            }
	        });
		}
	});
});


function creaTotal(preTotal){

 	var total_anterior = parseFloat($("#total_final").val());
 	var total_final = total_anterior + parseFloat(preTotal);
 	console.log(total_anterior);
 	console.log(preTotal);
 	console.log(total_final);
 	return total_final;
}