var ID_PERMISO_REL_USU = '';
var PERMISO_REL_USU = '';
var ID_USUARIO = '';

$(function(){

	$("#idUsu").on('change',function(){
		ID_USUARIO = $(this).val();
		//limpiamos los campos cuando cambie de valor
		$(".check-permiso").prop("checked","");

		//vamos a buscar los permisos relacionados a ese usuario
		if(ID_USUARIO === '0' || ID_USUARIO === null || ID_USUARIO === ""){

		}else{
			$.ajax({
            	url:BASE_PATH + 'configuracion/UsuariosPermisos/getRelPerUsu',
            	type:'POST',
            	dataType:'json',
            	data:{
                	id_usuario : ID_USUARIO,
            	},
            	success:function(json) {
                	if(json.response_code === "200"){

                		$.each(json.relacionesPermisos,function(i,r){
                			$("#checkPer-"+r.Id_Relacion).prop('checked','checked');
                		});
                		
                	}
            	},
            	error : function(xhr, status) {
            		console.log("algo salio mal");
            	}
        	});
		}
	});

	$(".check-permiso").click(function(){
		ID_PERMISO_REL_USU = $(this).attr("id");
		PERMISO_REL_USU = $(this).prop("checked");

		var id_permiso = ID_PERMISO_REL_USU.split('-');

		if(ID_USUARIO === '0' || ID_USUARIO === null || ID_USUARIO === ""){
			Swal.fire({ type: 'error', title: 'Oops...', text: 'debe de seleccionar un usuario antes de asignar permisos!' });
			$(this).prop("checked","");
		}else{
			//funcion ajax para guardar los permisos de los usuario
			$.ajax({
            	url:BASE_PATH + 'configuracion/UsuariosPermisos/addRelModPer',
            	type:'POST',
            	dataType:'json',
            	data:{
                	id_rel_per : id_permiso[1],
                	id_usuario : ID_USUARIO,
                	status_rel : PERMISO_REL_USU
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                		console.log("relacion exitosa!");	
                	}
            	},
            	error : function(xhr, status) {
            		console.log("algo salio mal");
            	}
        	});
		}
	});
});