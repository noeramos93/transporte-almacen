var id_per = 0;

$(function(){

	//Metodo para editar la info de un rol
	$("#table_permisos").on('click','.edit-per',function(){
		//obtenermos el id del rol
		id_per = $(this).attr('data-id');
		//funcion ajax
		$.ajax({
            url:BASE_PATH + 'configuracion/Permisos/getEditPer',
            type:'POST',
            dataType:'json',
            data:{
                idPer : id_per
            },
            success:function(json) {
                if(json.response_code === "200"){
                	$("#namePer").val(json.per.Nombre);
                    $("#modalPermisoEdit").modal('show');
                }else{
                	console.log(json.response_msg);
                }
            },
            error : function(xhr, status) {
            	console.log("algo salio mal");
            }
        });
	});

    $("#saveEditPer").on('click',function(){
        //obtenemos el nombre del permiso
        var name_per = $("#namePer").val();
        //funcion ajax
        $.ajax({
            url:BASE_PATH + 'configuracion/Permisos/updatePer',
            type:'POST',
            dataType:'json',
            data:{
                namePer : name_per,
                idPer : id_per,
                tipo : 'C'
            },
            success:function(json) {
                if(json.response_code === "200"){
                    //vaciamos la tabla
                    $("#table_permisos tbody").html("");
                    //recorremos los registros para rellenar la tabla
                    $.each(json.newPermisos, function(i,p){
                        var newRow = "<tr id='tr-"+p.Id_Permiso+"'>"
                                        +"<td>"+p.Id_Permiso+"</td>"
                                        +"<td>"+p.Nombre+"</td>"
                                        +"<td>"
                                            +"<button type='button' class='btn btn-danger delete-per' data-id='"+p.Id_Permiso+"' data-toggle='tooltip' data-placement='top' title='Eliminar Permiso'>"
                                                +"<i class='fa fa-trash-o'></i>"
                                            +"</button>"
                                            +"<button type='button' class='btn btn-warning edit-per' style='margin-left: 4px;' data-id='"+p.Id_Permiso+"' data-toggle='tooltip' data-placement='top' title='Editar Permiso'>"
                                                +"<i class='fa fa-pencil-square-o'></i>"
                                            +"</button>"
                                        +"</td>"
                                +"</tr>";
                        $(newRow).appendTo("#table_permisos tbody");
                    });
                    //ocultamos modal
                    $("#modalPermisoEdit").modal('hide');
                }else{
                    console.log(json.response_msg);
                }
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });
    });


    //Metodo para Borrar un Permiso
    $("#table_permisos").on('click','.delete-per',function(){
        //obtenermos el id del permiso
        id_per = $(this).attr('data-id');
        var name_per = $("#namePer").val();
        //Se pregunta si quiere eliminar el permiso
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
                        url:BASE_PATH + 'configuracion/Permisos/updatePer',
                        type:'POST',
                        dataType:'json',
                        data:{
                            namePer : name_per,
                            idPer : id_per,
                            tipo : 'D'
                        },
                        success:function(json) {
                            if(json.response_code === "200"){
                                $("#tr-"+id_per).remove();
                                Swal.fire( 'Eliminado!', 'El registro se elimino con exito!.', 'success');
                            }else{
                                console.log(json.response_msg);
                            }
                        },
                        error : function(xhr, status) {
                            console.log("algo salio mal");
                        }
                    });
                }
        })
    });

});