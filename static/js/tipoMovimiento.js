var ID_TIP_MOV = 0;
var TABLA_TIP_MOV = '';

$(function(){

	TABLA_TIP_MOV = $('#tabla_tipo_mov').DataTable( {columns: [ { data: 'ID' }, { data: 'NOMBRE' }, { data: 'ACCIONES' } ] });

	/**
	* Metodo para mostrar la modal 
	* para agregar un nuevo tipo de movimiento
	*/
	$("#addTipMov").click(function(){
		$("#modalNewTipMov").modal('show');
	});

	/**
	* Metodo para la funcionalidad
	* de guardar el nuevo tipo de movimiento
	* @param nameUbicacion
	* @param tipo_update
	*/
	$("#saveNewTipMov").click(function(){

		if( $("#nameTipInv").val() === "" || $("#nameTipInv").val() === null ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del tipo de movimiento no puede estar vacio!' });
		}else{
			
			$.ajax({
            	url:BASE_PATH + 'almacen/TipoMovimientos/addTipMov',
            	type:'POST',
            	dataType:'json',
            	data:{
                	nameTipMov : $("#nameTipMov").val()
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                		
                		TABLA_TIP_MOV.clear().draw();

                		Swal.fire( 'Exito!', 'El tipo de movimeinto se agrego.', 'success');

                		$.each(json.tipoMovimientos, function(i,tmov){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-tipMov' data-id='"+tmov.Id_TipoMov+"' data-toggle='tooltip' data-placement='top' title='Eliminar tipo movimeinto'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-tipMov' style='margin-left: 4px;' data-id='"+tmov.Id_TipoMov+"' data-toggle='tooltip' data-placement='top' title='Editar tipo movimiento'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_TIP_MOV.row.add( { "ID" : tmov.Id_TipoMov, "NOMBRE" : tmov.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});
                    	$("#modalNewTipMov").modal('hide');
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
	* de la tabla de tipo de movimiento
	* @param id_ubic
	*/
	$("#tabla_tipo_mov").on('click','.delete-tipMov',function(){
		
		ID_TIP_MOV = $(this).attr('data-id');
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
            		url:BASE_PATH + 'almacen/TipoMovimientos/updateInfoTipMov',
            		type:'POST',
            		dataType:'json',
            		data:{
            			tipoUpd : 'B',
            			id_tip_mov : ID_TIP_MOV,
            			name_tip_mov : ''
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
            		TABLA_TIP_MOV.row( $(this).parents('tr') ).remove().draw();
            	}
            }
        });
	});

	/**
	* Metodo para detectar el click en el boton de editar
	* de la tabla de tipos de inventario
	* @param id_tip_inv
	*/
	$("#tabla_tipo_mov").on('click','.edit-tipMov',function(){
		ID_TIP_MOV = $(this).attr('data-id');

		$.ajax({
           	async:false,
           	url:BASE_PATH + 'almacen/TipoMovimientos/getInfoTipMov',
            type:'POST',
            dataType:'json',
            data:{
            	id_tip_mov : ID_TIP_MOV
            },
            success:function(json) {
            	if(json.response_code === "200"){
            		//llenamos el nombre con el que regresa de la DB
            		$("#nameTipMovEdt").val(json.tipoMovimiento.Nombre);
            		$("#modalTipMovEdit").modal('show');
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
	* @param id_tip_mov
	* @param name_tip_mov
	*/
	$("#saveEditTipMov").click(function(){

		if($("#nameTipMovEdt").val() === null || $("#nameTipMovEdt").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre de la ubicacion no puede estar vacio!' });
		}else{		
			$.ajax({
	           	async:false,
	           	url:BASE_PATH + 'almacen/TipoMovimientos/updateInfoTipMov',
	            type:'POST',
	            dataType:'json',
	            data:{
	            	tipoUpd : 'A',
	            	id_tip_mov : ID_TIP_MOV,
	            	name_tip_mov : $("#nameTipMovEdt").val()
	            },
	            success:function(json) {
	            	if(json.response_code === "200"){
	            		
	            		$("#nameTipMovEdt").val('');
	            		ID_TIP_MOV = '';
	            		
						TABLA_TIP_MOV.clear().draw();
	            		$.each(json.tipoMovimientos, function(i,tmov){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-tipMov' data-id='"+tmov.Id_TipoMov+"' data-toggle='tooltip' data-placement='top' title='Eliminar tipo movimeinto'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-tipMov' style='margin-left: 4px;' data-id='"+tmov.Id_TipoMov+"' data-toggle='tooltip' data-placement='top' title='Editar tipo movimiento'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_TIP_MOV.row.add( { "ID" : tmov.Id_TipoMov, "NOMBRE" : tmov.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});

	            		$("#modalTipMovEdit").modal('hide');
	            		
	            		Swal.fire( 'Exito!', 'El tipo de movimiento se agrego.', 'success');
	            	}
	            },
	            error : function(xhr, status) {
	            	console.log("algo salio mal");
	            }
	        });
		}
	});

});