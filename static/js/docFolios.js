var ID_FOLIO_DOC = '';
var TABLA_DOC_FOL = '';

$(function(){
	TABLA_DOC_FOL = $('#tabla_folios').DataTable( {columns: [ { data: 'ID' }, { data: 'DOCUMENTO' }, { data: 'SERIE' }, { data: 'SIGUIENTE FOLIO' }, { data: 'ACCIONES' } ] });

	$("#btnSaveFol").click(function(){
		var validForm = true;

		if( $("#docName").val() === null || $("#docName").val() === ""){
			validForm = false;
			Swal.fire( 'Error!', 'El documento esta vacio.', 'error');
		}else if( $("#serieFol").val() === null || $("#serieFol").val() === ""){
			validForm = false;
			Swal.fire( 'Error!', 'La serie esta vacia.', 'error');
		}else if( $("#nextFol").val() === null || $("#nextFol").val() === ""){
			validForm = false;
			Swal.fire( 'Error!', 'El siguiente folio esta vacia.', 'error');
		}

		if(validForm){

			$.ajax({
                url:BASE_PATH + 'configuracion/FoliosDocumentos/addFolDoc',
                type:'POST',
                dataType:'json',
                data:{
                	id_fol :  ID_FOLIO_DOC,
                    doc_fol : $("#docName").val(),
                    sig_fol : $("#nextFol").val(),
                    serie_fol: $("#serieFol").val(),
                    tipo_opr : 'S'
                },
                success:function(json) {
                    if(json.response_code === "200"){
                    	
                    	$("#docName").val('');
                    	$("#nextFol").val('');
                    	$("#serieFol").val('');
                    	$("#idFol").val(json.idNextFol);

                    	TABLA_DOC_FOL.clear().draw();
                        Swal.fire( 'Exitos!', json.response_msg, 'success');
                        $.each(json.folios, function(i,fol){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-fol' data-id='"+fol.Id_Folio+"' data-toggle='tooltip' data-placement='top' title='Eliminar Folio'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-fol' style='margin-left: 4px;' data-id='"+fol.Id_Folio+"' data-toggle='tooltip' data-placement='top' title='Editar Folio'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_DOC_FOL.row.add( { "ID" : fol.Id_Folio, "DOCUMENTO" : fol.Documento,"SERIE": fol.Serie, "SIGUIENTE FOLIO" : fol.FolioSiguiente , "ACCIONES" : botonesAction } ).draw();
                    	});
                    }   
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });

		}
		return false;
	});


	$("#tabla_folios").on('click','.edit-fol',function(){
		ID_FOL = $(this).attr('data-id');

		$.ajax({
           	async:false,
           	url:BASE_PATH + 'configuracion/FoliosDocumentos/getInfoFol',
            type:'POST',
            dataType:'json',
            data:{
            	id_fol : ID_FOL
            },
            success:function(json) {
            	if(json.response_code === "200"){
            		ID_FOLIO_DOC = json.folio.Id_Folio;
            		$("#docNameEdt").val(json.folio.Documento);
            		$("#serieFolEdt").val(json.folio.Serie);
            		$("#nextFolEdt").val(json.folio.FolioSiguiente);
            		$("#modalFolEdit").modal('show');
            	}
            },
            error : function(xhr, status) {
            	console.log("algo salio mal");
            }
        });
	});


	/**
	* Metodo para guardar la informacion de la edicion de
	* un folio
	* @param id_fol
	* @param doc_fol
	* @param serie_fol
	* @param sig_fol
	* @param tipo_opr
	*/
	$("#saveEditFol").click(function(){

		if($("#docNameEdt").val() === null || $("#docNameEdt").val() === "" ){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del documento esta vacio!' });
		}else{		
			$.ajax({
	           	url:BASE_PATH + 'configuracion/FoliosDocumentos/addFolDoc',
	            type:'POST',
	            dataType:'json',
	            data:{
	            	id_fol : ID_FOLIO_DOC,
	            	doc_fol : $("#docNameEdt").val(),
	            	serie_fol : $("#serieFolEdt").val(),
	            	sig_fol : $("#nextFolEdt").val(),
	            	tipo_opr : 'A'
	            },
	            success:function(json) {
	            	if(json.response_code === "200"){
	            		
	            		$("#docNameEdt").val('');
	            		$("#serieFolEdt").val('');
	            		$("#nextFolEdt").val('');
	            		$("#idFol").val(json.idNextFol);

	            		ID_FOLIO_DOC = '';
	            		
						TABLA_DOC_FOL.clear().draw();
	            		$.each(json.folios, function(i,fol){
                        	var botonesAction = "<button type='button' class='btn btn-danger delete-fol' data-id='"+fol.Id_Folio+"' data-toggle='tooltip' data-placement='top' title='Eliminar Folio'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-fol' style='margin-left: 4px;' data-id='"+fol.Id_Folio+"' data-toggle='tooltip' data-placement='top' title='Editar Folio'><i class='fa fa-pencil-square-o'></i></button>";
                        	TABLA_DOC_FOL.row.add( { "ID" : fol.Id_Folio, "DOCUMENTO" : fol.Documento,"SERIE": fol.Serie, "SIGUIENTE FOLIO" : fol.FolioSiguiente , "ACCIONES" : botonesAction } ).draw();
                    	});

	            		$("#modalFolEdit").modal('hide');
	            		
	            		Swal.fire( 'Exito!', 'El folio se edito.', 'success');
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
	* de la tabla de folio
	* @param id_fol
	*/
	$("#tabla_folios").on('click','.delete-fol',function(){
		
		ID_FOL = $(this).attr('data-id');
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
            		url:BASE_PATH + 'configuracion/FoliosDocumentos/dropFolio',
            		type:'POST',
            		dataType:'json',
            		data:{
            			id_fol : ID_FOL
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
            		TABLA_DOC_FOL.row( $(this).parents('tr') ).remove().draw();
            	}
            }
        });
	});
});