var ID_TIP_INV = 0;
var TABLA_TIP_INV = '';

$(function(){

	TABLA_TIP_INV = $('#tabla_tipo_inv').DataTable( {columns: [ { data: 'ID' }, { data: 'NOMBRE' }, { data: 'ACCIONES' } ] });

	/**
	* Metodo para mostrar la modal 
	* para agregar un nuevo tipo de inventario
	*/
	$("#addTipInv").click(function(){
		$("#modalNewTipInv").modal('show');
	});

	/**
	* Metodo para la funcionalidad
	* de guardar el nuevo tipo de inventario
	* @param nameUbicacion
	* @param tipo_update
	*/
	$("#saveNewTipInv").click(function(){

		if( $("#nameTipInv").val() === "" || $("#nameTipInv").val() === null ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del tipo de inventario no puede estar vacio!' });
		}else{
			
			$.ajax({
            	url:BASE_PATH + 'almacen/TipoInventario/addTipInv',
            	type:'POST',
            	dataType:'json',
            	data:{
                	nameTipInv : $("#nameTipInv").val()
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                		
                		TABLA_TIP_INV.clear().draw();

                		Swal.fire( 'Exito!', 'La el tipo de inventario se agrego.', 'success');

                		$.each(json.tipoInventarios, function(i,tinv){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-tipInv' data-id='"+tinv.Id_Tipo+"' data-toggle='tooltip' data-placement='top' title='Eliminar tipo inventario'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-tipInv' style='margin-left: 4px;' data-id='"+tinv.Id_Tipo+"' data-toggle='tooltip' data-placement='top' title='Editar tipo inventario'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_TIP_INV.row.add( { "ID" : tinv.Id_Tipo, "NOMBRE" : tinv.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});
                    	$("#modalNewTipInv").modal('hide');
                	}
            	},
            	error : function(xhr, status) {
                	console.log("algo salio mal");
            	}
        	});
		}
	});

	/**
	* Metodo para detectar el click en el boton de eliminar
	* de la tabla de tipo de inventario
	* @param id_ubic
	*/
	$("#tabla_tipo_inv").on('click','.delete-tipInv',function(){
		
		ID_TIP_INV = $(this).attr('data-id');
		var isRemove = false;

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
            		async:false,
            		url:BASE_PATH + 'almacen/TipoInventario/updateInfoTipInv',
            		type:'POST',
            		dataType:'json',
            		data:{
            			tipoUpd : 'B',
            			id_tip_inv : ID_TIP_INV,
            			name_tip_inv : ''
            		},
            		success:function(json) {
            			if(json.response_code === "200"){
            				isRemove = true;
            				Swal.fire( 'Eliminado!', 'El registro se elimino con exito!.', 'success');
            			}
            		},
            		error : function(xhr, status) {
            			console.log("algo salio mal");
            		}
            	});

            	if(isRemove){
            		TABLA_TIP_INV.row( $(this).parents('tr') ).remove().draw();
            	}
            }
        });
	});

	/**
	* Metodo para detectar el click en el boton de editar
	* de la tabla de tipos de inventario
	* @param id_tip_inv
	*/
	$("#tabla_tipo_inv").on('click','.edit-tipInv',function(){
		ID_TIP_INV = $(this).attr('data-id');

		$.ajax({
           	async:false,
           	url:BASE_PATH + 'almacen/TipoInventario/getInfoTipInv',
            type:'POST',
            dataType:'json',
            data:{
            	id_tip_inv : ID_TIP_INV
            },
            success:function(json) {
            	if(json.response_code === "200"){
            		//llenamos el nombre con el que regresa de la DB
            		$("#nameTipInvEdt").val(json.tipoInventario.Nombre);
            		$("#modalTipInvEdit").modal('show');
            	}
            },
            error : function(xhr, status) {
            	console.log("algo salio mal");
            }
        });
	});

	/**
	* Metodo para guardar la informacion de la eidcion de
	* un tipo de inventario
	* @param id_tip_inv
	* @param name_tip_inv
	*/
	$("#saveEditTipInv").click(function(){

		if($("#nameTipInvEdt").val() === null || $("#nameTipInvEdt").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre de la ubicacion no puede estar vacio!' });
		}else{		
			$.ajax({
	           	async:false,
	           	url:BASE_PATH + 'almacen/TipoInventario/updateInfoTipInv',
	            type:'POST',
	            dataType:'json',
	            data:{
	            	tipoUpd : 'A',
	            	id_tip_inv : ID_TIP_INV,
	            	name_tip_inv : $("#nameTipInvEdt").val()
	            },
	            success:function(json) {
	            	if(json.response_code === "200"){
	            		
	            		$("#nameTipInvEdt").val('');
	            		ID_TIP_INV = '';
	            		
						TABLA_TIP_INV.clear().draw();
	            		$.each(json.tipoInventarios, function(i,tinv){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-tipInv' data-id='"+tinv.Id_Tipo+"' data-toggle='tooltip' data-placement='top' title='Eliminar tipo de inventario'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-tipInv' style='margin-left: 4px;' data-id='"+tinv.Id_Tipo+"' data-toggle='tooltip' data-placement='top' title='Editar tipo de inventario'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_TIP_INV.row.add( { "ID" : tinv.Id_Tipo, "NOMBRE" : tinv.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});

	            		$("#modalTipInvEdit").modal('hide');
	            		
	            		Swal.fire( 'Exito!', 'La ubicaicon se agrego.', 'success');
	            	}
	            },
	            error : function(xhr, status) {
	            	console.log("algo salio mal");
	            }
	        });
		}
	});

});