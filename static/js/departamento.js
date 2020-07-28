
 var ID_DEP = '';
 var TABLA_DEPARTAMENTO = '';

$(function(){
	TABLA_DEPARTAMENTO = $('#table_departamento').DataTable( {columns: [ { data: '#' }, { data: 'NOMBRE' }, { data: 'ACCIONES' } ] });
	//metodo para la accion del boton de delete de la tabla de departamento
    $("#table_departamento").on('click','.delete-dep',function(){
		ID_DEP = $(this).attr('data-id');
		var isRemove = false;
		//Se pregunta si quiere eliminar el modulo
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
                        url:BASE_PATH + 'configuracion/Departamentos/deleteDep',
                        type:'POST',
                        dataType:'json',
                        data:{
                            depId : ID_DEP
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
                		TABLA_DEPARTAMENTO.row( $(this).parents('tr') ).remove().draw();
            		}
                }
        });
	});

    //metodo para la funcionalidad de deditar un departamento
    $("#table_departamento").on('click','.edit-dep',function(){
        ID_DEP = $(this).attr('data-id');
        //funcion ajax
        $.ajax({
            url:BASE_PATH + 'configuracion/Departamentos/getEditDet',
            type:'POST',
            dataType:'json',
            data:{
                idDep : ID_DEP
            },
            success:function(json) {
                if(json.response_code === "200"){
                    $("#nameDep").val(json.departamento.Nombre);
                    $("#modalDepEdit").modal('show');
                }else{
                    console.log(json.response_msg);
                }
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });
    });

    //metodo para el clik de guardar los cambios del departamento
    $("#saveEditDep").click(function(){
                //obtenermos el id del rol
        var name_dep = $("#nameDep").val();
        //funcion ajax
        $.ajax({
            url:BASE_PATH + 'configuracion/Departamentos/updateDep',
            type:'POST',
            dataType:'json',
            data:{
                nameDep : name_dep,
                idDep : ID_DEP,
            },
            success:function(json) {
                if(json.response_code === "200"){
                    TABLA_DEPARTAMENTO.clear().draw();
                    $.each(json.departamentos, function(i,dep){
                        //botones que se crean en acciones
                        var botonesAction = "<button type='button' class='btn btn-danger delete-dep' data-id='"+dep.Id_Departamento+"' data-toggle='tooltip' data-placement='top' title='Eliminar departamento'><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-warning edit-dep' style='margin-left: 4px;' data-id='"+dep.Id_Departamento+"' data-toggle='tooltip' data-placement='top' title='Editar Departamento'><i class='fa fa-pencil-square-o'></i></button>";
                        //redibujamos todo con la nueva info que trae el json
                        TABLA_DEPARTAMENTO.row.add( { "#" : dep.Id_Departamento, "NOMBRE" : dep.Nombre, "ACCIONES" : botonesAction } ).draw();
                    });
                    //ocultamos modal
                    $("#modalDepEdit").modal('hide');
                }else{
                    console.log(json.response_msg);
                }
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });
    });
});