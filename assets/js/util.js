$(document).ready(function() {

	$("#cupon-created").delay(5000).fadeOut("slow");

	$('#eliminar').on('shown.bs.modal', function(e) {
		var id_cupon = $(e.relatedTarget).data('id');
		$('.delete-cupon').attr('data-id', id_cupon);
	});

	$('.delete-cupon').on('click', function(e) {
		var id = $(this).attr("data-id");
		
		$.ajax({
            type: 'POST',
            url: location.pathname+'/delete',
            data: {
            	'id_cupon' : id	
            },
            success: function (response) {
            	location.reload();
            }
        });
	});

	$('#edit').on('shown.bs.modal', function(e) {
		var id = $(e.relatedTarget).data('id');
		
		$.ajax({
            type: 'POST',
            url: location.pathname+'/getCuponById',
            data: {
            	'id_cupon' : id	
            },
            success: function (response) {
            	var cupon = JSON.parse(response);
            	$('#edit-id-modal').val(cupon['id']); 
            	$('#edit-code-modal').val(cupon['codigo']); 
            	$('#edit-name-modal').val(cupon['descripcion']); 
            	$('#edit-descuento-modal').val(cupon['porc_desc']); 
            	
            	$('input:radio[name=edit-estado-modal]').attr('checked',false);
            	if(cupon['status']=='0'){
            		$('input:radio[name=edit-estado-modal]')[1].checked = true;
            	} else {
            		$('input:radio[name=edit-estado-modal]')[0].checked = true;
            	}
			}
        });
	});

	$('.cupon-update').on('click', function(e) {
		$.ajax({
            type: 'POST',
            url: location.pathname+'/edit',
            data: {
            	'id' : $('#edit-id-modal').val(),
            	'codigo' : $('#edit-code-modal').val(),
            	'descripcion' : $('#edit-name-modal').val(),
            	'porc_desc' : $('#edit-descuento-modal').val(),
            	'status' : $('input:radio[name=edit-estado-modal]:checked').val()
            },
            success: function (response) {
            	console.log(response);
            	location.reload();
            	
			}
        });


	});

});
