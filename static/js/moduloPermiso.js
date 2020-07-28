var id_mod = 0;
var id_per = 0;
var TABLA_RELACION = "";

$(function(){
	TABLA_RELACION = $('#tabla_rel_mod_per').DataTable( {columns: [ { data: 'ID' }, { data: 'MODULO' }, { data: 'PERMISO' }, { data: 'ACCIONES' } ] });

	// on change para el select de modulos
	$("#idMod").on('change',function(){
		id_mod = $("#idMod").val();
	});

	// on change para el select de permisos
	$("#idPer").on('change',function(){
		id_per = $("#idPer").val();
	});

	//metodo para agregar a la tabla de relacion modulo permiso
	$("#alta_modulo_permiso").submit(function(){
		var validaFormulario = true;
		//validamos que si este seleccionado un modulo con un permiso
		if(id_mod === 0 || id_mod === '0'){
			validaFormulario = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El campo modulo no puede estar vacio!'});
		}else if(id_per === 0 || id_per === '0'){
			validaFormulario = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El campo permiso no puede estar vacio!'});
		}

		if(validaFormulario){

			$.ajax({
            	url:BASE_PATH + 'configuracion/ModulosPermisos/saveRelacionModPer',
            	type:'POST',
            	dataType:'json',
            	data:{
                	idMod : id_mod,
                	idPer : id_per
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                        fillTableModuloPermiso(json);
                        $("#idMod").val('0');
                        $("#idPer").val('0');
                        Swal.fire( 'Exito!','Operacion exitosa','success');
                	}else{
                        Swal.fire({ type: 'error', title: json.response_code, text: json.response_msg});
                	}
            	},
            	error : function(xhr, status) {
            		console.log("algo salio mal");
            	}
        	});
		}
		return false;
	});
});

/**
* Metodo para llenar la tabla de modulo permiso
* con el nuevo permiso
* @param json array con la respuesta de la relacion modulo - permiso.
*/
function fillTableModuloPermiso(json){

    if(json.relacionesModPer !== null){
        //limipamos la tabla
        TABLA_RELACION.clear().draw();
        
        //recorremos los registros para rellenar la tabla
        $.each(json.relacionesModPer, function(i,rmp){
            //botones que se crean en acciones
            var botonesAction = "<button type='button' class='btn btn-danger delete-rmp' data-id='"+rmp.Id_Relacion+"' data-toggle='tooltip' data-placement='top' title='Eliminar Relacion Modulo Permiso'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-rmp' style='margin-left: 4px;' data-id='"+rmp.Id_Relacion+"' data-toggle='tooltip' data-placement='top' title='Editar Relacion Modulo Permiso'><i class='fa fa-pencil-square-o'></i></button>";
            //redibujamos todo con la nueva info que trae el json
            TABLA_RELACION.row.add( { "ID" : rmp.Id_Relacion, "MODULO" : rmp.Modulo, "PERMISO" : rmp.Permiso, "ACCIONES" : botonesAction } ).draw();
        });

    }
}

$(function(){
    //funion para borrar una relacion de modulo permiso
    $("#tabla_rel_mod_per").on('click','.delete-rmp',function(){
        var id_relacion = $(this).attr('data-id');
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
                    url:BASE_PATH + 'configuracion/ModulosPermisos/deleteRelacion',
                    type:'POST',
                    dataType:'json',
                    data:{
                        idRelacion : id_relacion
                    },
                    success:function(json) {
                        if(json.response_code === "200"){
                            isRemove = true;
                            Swal.fire( 'Borrado!', 'El usuaro fue eliminado con exito!', 'success');
                        }
                    },
                    error : function(xhr, status) {
                        console.log("algo salio mal");
                    }
                });
            }
            
            if(isRemove){
                TABLA_RELACION.row( $(this).parents('tr') ).remove().draw();
            }
        });

    });

    //funion para editar una relacion de modulo permiso
    $("#tabla_rel_mod_per").on('click','.edit-rmp',function(){

    });

});
