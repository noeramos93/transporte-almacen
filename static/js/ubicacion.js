var ID_UBIC = 0;
var TABLA_UBICACION = '';

$(function(){

	TABLA_UBICACION = $('#tabla_ubicaciones').DataTable( {columns: [ { data: '#' }, { data: 'NOMBRE' }, { data: 'ACCIONES' } ] });

	/**
	* Metodo para mostrar la modal 
	* para agregar una nueva ubicacion
	*/
	$("#addUbic").click(function(){
		$("#modalNewUbic").modal('show');
	});

	/**
	* Metodo para la funcionalidad
	* de guardar la nueva ubicacion
	* @param nameUbicacion
	* @param tipo_update
	*/
	$("#saveNewUbic").click(function(){

		if( $("#nameUbic").val() === "" || $("#nameUbic").val() === null ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre de la ubicacion no puede estar vacio!' });
		}else{
			
			$.ajax({
            	url:BASE_PATH + 'almacen/Ubicaciones/addUbic',
            	type:'POST',
            	dataType:'json',
            	data:{
                	nameUbic : $("#nameUbic").val()
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                		
                		TABLA_UBICACION.clear().draw();

                		Swal.fire( 'Exito!', 'La ubicaicon se agrego.', 'success');

                		$.each(json.ubicaciones, function(i,ubc){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-ubc' data-id='"+ubc.Id_Ubicacion+"' data-toggle='tooltip' data-placement='top' title='Eliminar Ubicacion'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-ubc' style='margin-left: 4px;' data-id='"+ubc.Id_Ubicacion+"' data-toggle='tooltip' data-placement='top' title='Editar Ubicacion'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_UBICACION.row.add( { "#" : ubc.Id_Ubicacion, "NOMBRE" : ubc.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});
                    	$("#modalNewUbic").modal('hide');
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
	* de la ubicacion
	* @param id_ubic
	*/
	$("#tabla_ubicaciones").on('click','.delete-ubc',function(){
		
		ID_UBIC = $(this).attr('data-id');
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
            		url:BASE_PATH + 'almacen/Ubicaciones/updateInfoUbic',
            		type:'POST',
            		dataType:'json',
            		data:{
            			tipoUpd : 'B',
            			id_ubic : ID_UBIC,
            			name_ubic : ''
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
            		TABLA_UBICACION.row( $(this).parents('tr') ).remove().draw();
            	}
            }
        });
	});

	/**
	* Metodo para detectar el click en el boton de editar
	* de la ubicacion
	* @param id_ubic
	*/
	$("#tabla_ubicaciones").on('click','.edit-ubc',function(){
		ID_UBIC = $(this).attr('data-id');

		$.ajax({
           	async:false,
           	url:BASE_PATH + 'almacen/Ubicaciones/getInfoUbic',
            type:'POST',
            dataType:'json',
            data:{
            	id_ubic : ID_UBIC
            },
            success:function(json) {
            	if(json.response_code === "200"){
            		//llenamos el nombre con el que regresa de la DB
            		$("#nameUbicEdt").val(json.ubicacion.Nombre);
            		$("#modalUbicEdit").modal('show');
            	}
            },
            error : function(xhr, status) {
            	console.log("algo salio mal");
            }
        });
	});

	/**
	* Metodo para guardar la informacion de la eidcion de
	* la ubicacion
	* @param id_ubic
	* @param name_ubic
	*/
	$("#saveEditUbic").click(function(){

		if($("#nameUbicEdt").val() === null || $("#nameUbicEdt").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre de la ubicacion no puede estar vacio!' });
		}else{		
			$.ajax({
	           	async:false,
	           	url:BASE_PATH + 'almacen/Ubicaciones/updateInfoUbic',
	            type:'POST',
	            dataType:'json',
	            data:{
	            	tipoUpd : 'A',
	            	id_ubic : ID_UBIC,
	            	name_ubic : $("#nameUbicEdt").val()
	            },
	            success:function(json) {
	            	if(json.response_code === "200"){
	            		
	            		$("#nameUbicEdt").val('');
	            		ID_UBIC = '';
	            		
						TABLA_UBICACION.clear().draw();
	            		$.each(json.ubicaciones, function(i,ubc){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-ubc' data-id='"+ubc.Id_Ubicacion+"' data-toggle='tooltip' data-placement='top' title='Eliminar Ubicacion'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-ubc' style='margin-left: 4px;' data-id='"+ubc.Id_Ubicacion+"' data-toggle='tooltip' data-placement='top' title='Editar Ubicacion'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_UBICACION.row.add( { "#" : ubc.Id_Ubicacion, "NOMBRE" : ubc.Nombre, "ACCIONES" : botonesAction } ).draw();
                    	});

	            		$("#modalUbicEdit").modal('hide');
	            		
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