var id_rol = 0;

$(function(){

    //Metodo para editar la info de un rol
	$("#table_roles").on('click','.edit-rol',function(){
		//obtenermos el id del rol
		id_rol = $(this).attr('data-id');
		//funcion ajax
		$.ajax({
            url:BASE_PATH + 'configuracion/Roles/getEditRol',
            type:'POST',
            dataType:'json',
            data:{
                idRol : id_rol
            },
            success:function(json) {
                if(json.response_code === "200"){
                	$("#nameRol").val(json.rol.Nombre);
                    $("#modalRolesEdit").modal('show');
                }else{
                	console.log(json.response_msg);
                }
            },
            error : function(xhr, status) {
            	console.log("algo salio mal");
            }
        });
	});

    //Metodo para Borrar un rol
    $("#table_roles").on('click','.delete-rol',function(){
        //obtenermos el id del rol
        id_rol = $(this).attr('data-id');
        var name_rol = $("#nameRol").val();
        //Se pregunta si quiere eliminar el archivo
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
                        url:BASE_PATH + 'configuracion/Roles/updateRol',
                        type:'POST',
                        dataType:'json',
                        data:{
                            nameRol : name_rol,
                            idRol : id_rol,
                            tipo : 'D'
                        },
                        success:function(json) {
                            if(json.response_code === "200"){
                                $("#tr-"+id_rol).remove();
                                Swal.fire( 'Deleted!', 'Your file has been deleted.', 'success')
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


	$("#saveEditRol").on('click',function(){
		//obtenermos el id del rol
		var name_rol = $("#nameRol").val();
		//funcion ajax
		$.ajax({
            url:BASE_PATH + 'configuracion/Roles/updateRol',
            type:'POST',
            dataType:'json',
            data:{
            	nameRol : name_rol,
                idRol : id_rol,
                tipo : 'C'
            },
            success:function(json) {
                if(json.response_code === "200"){
                    //vaciamos la tabla
                    $("#table_roles tbody").html("");
                    //recorremos los registros para rellenar la tabla
                    $.each(json.newRoles, function(i,r){
                        var newRow = "<tr id='tr-"+r.Id_Rol+"'>"
                                        +"<td>"+r.Id_Rol+"</td>"
                                        +"<td>"+r.Nombre+"</td>"
                                        +"<td>"
                                            +"<button type='button' class='btn btn-danger delete-rol' data-id='"+r.Id_Rol+"' data-toggle='tooltip' data-placement='top' title='Eliminar Rol'>"
                                                +"<i class='fa fa-trash-o'></i>"
                                            +"</button>"
                                            +"<button type='button' class='btn btn-warning edit-rol' style='margin-left: 4px;' data-id='"+r.Id_Rol+"' data-toggle='tooltip' data-placement='top' title='Editar Rol'>"
                                                +"<i class='fa fa-pencil-square-o'></i>"
                                            +"</button>"
                                        +"</td>"
                                +"</tr>";
                        $(newRow).appendTo("#table_roles tbody");
                    });
                    //ocultamos modal
                    $("#modalRolesEdit").modal('hide');
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