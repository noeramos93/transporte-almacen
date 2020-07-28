var id_mod = 0;

$(function(){

    //Metodo para editar la info de un modulo
	$("#table_modulos").on('click','.edit-mod',function(){
		//obtenermos el id del modulo
		id_mod = $(this).attr('data-id');
		//funcion ajax
		$.ajax({
            url:BASE_PATH + 'configuracion/Modulos/getEditMod',
            type:'POST',
            dataType:'json',
            data:{
                idMod : id_mod
            },
            success:function(json) {
                if(json.response_code === "200"){
                	$("#nameModulo").val(json.modulo.Nombre);
                    $("#modalModulosEdit").modal('show');
                }else{
                	console.log(json.response_msg);
                }
            },
            error : function(xhr, status) {
            	console.log("algo salio mal");
            }
        });
	});

    //Metodo para Borrar un Modulo
    $("#table_modulos").on('click','.delete-mod',function(){
        //obtenermos el id del modulo
        id_mod = $(this).attr('data-id');
        //var name_mod = $("#nameModulo").val();
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
                        url:BASE_PATH + 'configuracion/Modulos/updateMod',
                        type:'POST',
                        dataType:'json',
                        data:{
                            idMod : id_mod,
                            tipo : 'D'
                        },
                        success:function(json) {
                            if(json.response_code === "200"){
                                $("#tr-"+id_mod).remove();
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
        });
    });


	$("#saveEditMod").on('click',function(){
		//obtenermos el id del rol
		var name_mod = $("#nameModulo").val();
		//funcion ajax
		$.ajax({
            url:BASE_PATH + 'configuracion/Modulos/updateMod',
            type:'POST',
            dataType:'json',
            data:{
            	nameMod : name_mod,
                idMod : id_mod,
                tipo : 'C'
            },
            success:function(json) {
                if(json.response_code === "200"){
                    //vaciamos la tabla
                    $("#table_modulos tbody").html("");
                    //recorremos los registros para rellenar la tabla
                    $.each(json.newRoles, function(i,m){
                        var newRow = "<tr id='tr-"+m.Id_Modulo+"'>"
                                        +"<td>"+m.Id_Modulo+"</td>"
                                        +"<td>"+m.Nombre+"</td>"
                                        +"<td>"
                                            +"<button type='button' class='btn btn-danger delete-mod' data-id='"+m.Id_Modulo+"' data-toggle='tooltip' data-placement='top' title='Eliminar Modulo'>"
                                                +"<i class='fa fa-trash-o'></i>"
                                            +"</button>"
                                            +"<button type='button' class='btn btn-warning edit-mod' style='margin-left: 4px;' data-id='"+m.Id_Modulo+"' data-toggle='tooltip' data-placement='top' title='Editar Modulo'>"
                                                +"<i class='fa fa-pencil-square-o'></i>"
                                            +"</button>"
                                        +"</td>"
                                +"</tr>";
                        $(newRow).appendTo("#table_modulos tbody");
                    });
                    //ocultamos modal
                    $("#modalModulosEdit").modal('hide');
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