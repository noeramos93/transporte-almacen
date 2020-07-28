


$(function(){

    $('#passUsu').on('keyup',function(event){
        var valueInputPass = $(this).val().length;
        if(valueInputPass > 8 || valueInputPass === 8){
            $('#passUsu').removeClass("is-invalid");
            $('#passUsu').addClass("is-valid");
        }else{
            $('#passUsu').addClass("is-invalid");
        }
    });

	$("#form_usuario").submit(function(){
		var form_valid = true; 
		if($("#usuName").val() === "" || $("#usuName").val() === null){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El usuario no puede estar vacio!' });
		}else if($("#appUsu").val() === "" || $("#appUsu").val() === null){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El apellido paterno del usuario no puede estar vacio!' });
		}else if($("#apmUsu").val() === "" || $("#apmUsu").val() === null){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El apellido materno del usuario no puede estar vacio!' });
		}else if($("#nameUsu").val() === "" || $("#nameUsu").val() === null){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del usuario no puede estar vacio!' });
		}else if($("#emailUsu").val() === "" || $("#emailUsu").val() === null){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El email del usuario no puede estar vacio!' });
		}else if($("#passUsu").val() === "" || $("#passUsu").val() === null){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'El password del usuario no puede estar vacio!' });
		}else if($("#rol").val() === '0' || $("#rol").val() === ""){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar almenos un rol!' });
		}else if($("#departamento").val() === '0' || $("#departamento").val() === ""){
			form_valid = false;
			Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar almenos un departamento!' });
		}

		if(form_valid){
			//funcion ajax para el guardado de los usuarios
			$.ajax({
            	url:BASE_PATH + 'configuracion/Usuarios/saveInfoUsu',
            	type:'POST',
            	dataType:'json',
            	data:{
            		tipo_action : 'S',
                	id_usu : '0',
                	usu_name : $("#usuName").val(),
                	app_usu : $("#appUsu").val(),
                	apm_usu : $("#apmUsu").val(),
                	name_usu : $("#nameUsu").val(),
                	email_usu : $("#emailUsu").val(),
                	pass_usu : $("#passUsu").val(),
                	rol_usu : $("#rol").val(),
                	depa_usu : $("#departamento").val()
            	},
            	success:function(json) {
                	if(json.response_code === "200"){
                		fillTableUsu(json);
                		$("#usuName").val("");
                		$("#appUsu").val("");
                		$("#apmUsu").val("");
                		$("#nameUsu").val("");
                		$("#emailUsu").val("");
                		$("#passUsu").val("");
                		$("#rol").val('0');
                		$("#departamento").val('0');
                		Swal.fire({ type: 'success', title: 'Registro Exitoso!', text: "Se guardo la informacion Correctamente!" });
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
* funcion para llenar la tabla de los usuarios una vez que se
* actualzo o se guardo la informacion del mismo. 
* @param json
*/
function fillTableUsu(json){
	if(json.usuarios !== null){

    	$("#tabla_usuarios tbody").html("");
    	//recorremos los registros para rellenar la tabla
    	$.each(json.usuarios, function(i,s){
            var newRow = "<tr id='tr-"+s.Id_Usuario+"'>"
                +"<td>"+s.Id_Usuario+"</td>"
                +"<td>"+s.Usuario+"</td>"
                +"<td>"+s.Name+"</td>"
                +"<td>"+s.email+"</td>"
                +"<td>"+s.Rol+"</td>"
                +"<td>"+s.Departamento+"</td>"
                +"<td>"
                    +"<button type='button' class='btn btn-danger delete-usu' data-id='"+s.Id_Usuario+"' data-toggle='tooltip' data-placement='top' title='Eliminar Usuario'>"
                        +"<i class='fa fa-trash-o'></i>"
                    +"</button>"
                    +"<button type='button' class='btn btn-warning edit-usu' style='margin-left: 4px;' data-id='"+s.Id_Usuario+"' data-toggle='tooltip' data-placement='top' title='Editar Usuario'>"
                        +"<i class='fa fa-pencil-square-o'></i>"
                    +"</button>"
                +"</td>"
            +"</tr>";
            $(newRow).appendTo("#tabla_usuarios tbody");
        });
    }
}


$(function(){
    $("#tabla_usuarios").on('click','.edit-usu',function(){
        id_usu = $(this).attr('data-id');

        $.ajax({
            url:BASE_PATH + 'configuracion/Usuarios/getInfoUsu',
            type:'POST',
            dataType:'json',
            data:{
                idUsuario : id_usu
            },
            success:function(json) {
                if(json.response_code === "200"){
                    $("#usuId").val(json.informacion.Id_Usuario);
                    $("#usuNameEdt").val(json.informacion.Usuario);
                    $("#nameUsuEdt").val(json.informacion.Nombre);
                    $("#emailUsuEdt").val(json.informacion.email);
                    $("#passUsuEdt").val("");
                    $("#rolEdt").val(json.informacion.Id_Rol);
                    $("#departamentoEdt").val(json.informacion.Id_Departamento);

                    $("#modalEditUsuario").modal('show');
                }
            },
            error : function(xhr, status) {
                console.log("algo salio mal");
            }
        });

    });

    $("#tabla_usuarios").on('click','.delete-usu',function(){
        id_usu = $(this).attr('data-id');
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
                    url:BASE_PATH + 'configuracion/Usuarios/deleteUsuario',
                    type:'POST',
                    dataType:'json',
                    data:{
                        idUsuario : id_usu
                    },
                    success:function(json) {
                        if(json.response_code === "200"){
                            $("#tr-"+id_usu).remove();
                            Swal.fire( 'Borrado!', 'El usuaro fue eliminado con exito!', 'success');
                        }
                    },
                    error : function(xhr, status) {
                        console.log("algo salio mal");
                    }
                });
            }
        });

    });
});


$(function(){

    $("#cancelEditUsu").click(function(){
        $("#usuNameEdt").val("");
        $("#nameUsuEdt").val("");
        $("#emailUsuEdt").val("");
        $("#passUsuEdt").val("");
        $("#rolEdt").val('0');
        $("#departamentoEdt").val('0');
        $('#passUsuEdt').removeClass("is-invalid");
        $('#passUsuEdt').removeClass("is-valid");
    });

    $('#passUsuEdt').on('keyup',function(event){
        var valueInputPassEdt = $(this).val().length;
        if(valueInputPassEdt > 8 || valueInputPassEdt === 8){
            $('#passUsuEdt').removeClass("is-invalid");
            $('#passUsuEdt').addClass("is-valid");
        }else{
            $('#passUsuEdt').addClass("is-invalid");
        }
    });

    $("#editUsuInfo").click(function(){
        var form_valid = true; 
        if($("#usuNameEdt").val() === "" || $("#usuNameEdt").val() === null){
            form_valid = false;
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El usuario no puede estar vacio!' });
        }else if($("#nameUsuEdt").val() === "" || $("#nameUsuEdt").val() === null){
            form_valid = false;
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El nombre del usuario no puede estar vacio!' });
        }else if($("#emailUsuEdt").val() === "" || $("#emailUsuEdt").val() === null){
            form_valid = false;
            Swal.fire({ type: 'error', title: 'Oops...', text: 'El email del usuario no puede estar vacio!' });
        }else if($("#rolEdt").val() === '0' || $("#rolEdt").val() === ""){
            form_valid = false;
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar almenos un rol!' });
        }else if($("#departamentoEdt").val() === '0' || $("#departamentoEdt").val() === ""){
            form_valid = false;
            Swal.fire({ type: 'error', title: 'Oops...', text: 'Debe de seleccionar almenos un departamento!' });
        }

        if(form_valid){
            //funcion ajax para el guardado de los usuarios
            $.ajax({
                url:BASE_PATH + 'configuracion/Usuarios/saveInfoUsu',
                type:'POST',
                dataType:'json',
                data:{
                    tipo_action : 'A',
                    id_usu : $("#usuId").val(),
                    usu_name : $("#usuNameEdt").val(),
                    name_usu : $("#nameUsuEdt").val(),
                    email_usu : $("#emailUsuEdt").val(),
                    pass_usu : $("#passUsuEdt").val(),
                    rol_usu : $("#rolEdt").val(),
                    depa_usu : $("#departamentoEdt").val()
                },
                success:function(json) {
                    if(json.response_code === "200"){
                        //llenamos la tabla con los cambios
                        fillTableUsu(json);
                        //vaciamos los campos
                        $("#usuId").val("");
                        $("#usuNameEdt").val("");
                        $("#nameUsuEdt").val("");
                        $("#emailUsuEdt").val("");
                        $("#passUsuEdt").val("");
                        $("#rolEdt").val('0');
                        $("#departamentoEdt").val('0');
                        //ocultamos el modal
                        $("#modalEditUsuario").modal('hide');
                        //mostramos mensaje de exito
                        Swal.fire({ type: 'success', title: 'Registro Exitoso!', text: "Se guardo la informacion Correctamente!" });
                    }
                },
                error : function(xhr, status) {
                    console.log("algo salio mal");
                }
            });
        }
    });
});