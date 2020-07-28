var ID_ALM = 0;
var TABLA_ALMACEN = '';

$(function(){

	TABLA_ALMACEN = $('#tabla_almacenes').DataTable( {columns: [ { data: 'ID' }, { data: 'NOMBRE' }, { data: 'ACCIONES' } ] });

	/**
	* Metodo para mostrar la modal 
	* para agregar un nuevo almacen
	*/
	$("#addAlm").click(function(){
		$("#modalNewAlm").modal('show');
	});

	/**
	* Metodo para la funcionalidad
	* de guardar el nuevo almacen
	* @param nameUbicacion
	* @param tipo_update
	*/
	$("#saveNewAlm").click(function(){

		if( $("#nameAlm").val() === "" || $("#nameAlm").val() === null ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del almacen no puede estar vacio!' });
		}else{
			
			$.ajax({
            	url:BASE_PATH + 'almacen/Almacenes/addAlm',
            	type:'POST',
            	dataType:'json',
            	data:{
                	nameAlm : $("#nameAlm").val()
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                		
                		TABLA_ALMACEN.clear().draw();

                		Swal.fire( 'Exito!', 'El almacen se agrego.', 'success');

                		$.each(json.almacenes, function(i,alm){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-alm' data-id='"+alm.Id_Almacen+"' data-toggle='tooltip' data-placement='top' title='Eliminar Almacen'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-alm' style='margin-left: 4px;' data-id='"+alm.Id_Almacen+"' data-toggle='tooltip' data-placement='top' title='Editar Almacen'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_ALMACEN.row.add( { "#" : alm.Id_Almacen, "NOMBRE" : alm.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});
                    	$("#modalNewAlm").modal('hide');
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
	* del almacen
	* @param id_ubic
	*/
	$("#tabla_almacenes").on('click','.delete-alm',function(){
		
		ID_ALM = $(this).attr('data-id');
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
            		url:BASE_PATH + 'almacen/Almacenes/updateInfoAlm',
            		type:'POST',
            		dataType:'json',
            		data:{
            			tipoUpd : 'B',
            			id_alm : ID_ALM,
            			name_alm : ''
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
            		TABLA_ALMACEN.row( $(this).parents('tr') ).remove().draw();
            	}
            }
        });
	});

	/**
	* Metodo para detectar el click en el boton de editar
	* del almacen
	* @param id_ubic
	*/
	$("#tabla_almacenes").on('click','.edit-alm',function(){
		ID_ALM = $(this).attr('data-id');

		$.ajax({
           	async:false,
           	url:BASE_PATH + 'almacen/Almacenes/getInfoAlm',
            type:'POST',
            dataType:'json',
            data:{
            	id_alm : ID_ALM
            },
            success:function(json) {
            	if(json.response_code === "200"){
            		//llenamos el nombre con el que regresa de la DB
            		$("#nameAlmEdt").val(json.almacen.Nombre);
            		$("#modalAlmEdit").modal('show');
            	}
            },
            error : function(xhr, status) {
            	console.log("algo salio mal");
            }
        });
	});

	/**
	* Metodo para guardar la informacion de la edicion de
	* un almacen
	* @param id_alm
	* @param name_alm
	*/
	$("#saveEditAlm").click(function(){

		if($("#nameAlmEdt").val() === null || $("#nameAlmEdt").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre de la ubicacion no puede estar vacio!' });
		}else{		
			$.ajax({
	           	async:false,
	           	url:BASE_PATH + 'almacen/Almacenes/updateInfoAlm',
	            type:'POST',
	            dataType:'json',
	            data:{
	            	tipoUpd : 'A',
	            	id_alm : ID_ALM,
	            	name_alm : $("#nameAlmEdt").val()
	            },
	            success:function(json) {
	            	if(json.response_code === "200"){
	            		
	            		$("#nameAlmEdt").val('');
	            		ID_ALM = '';
	            		
						TABLA_ALMACEN.clear().draw();
	            		$.each(json.almacenes, function(i,alm){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-alm' data-id='"+alm.Id_Almacen+"' data-toggle='tooltip' data-placement='top' title='Eliminar Almacen'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-alm' style='margin-left: 4px;' data-id='"+alm.Id_Almacen+"' data-toggle='tooltip' data-placement='top' title='Editar Almacen'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_ALMACEN.row.add( { "ID" : alm.Id_Almacen, "NOMBRE" : alm.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});

	            		$("#modalAlmEdit").modal('hide');
	            		
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