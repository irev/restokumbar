$(document).ready(function(){
	
	$("#button_list").css({
		'margin-top':'10px'
	});
	$("#form_submit").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 400,
		show: {
			effect: "blind",
			duration: 500
		},
		hide: {
			effect: "blind",
			duration: 500
		}
	});
	
	$("#tambah").click(function(){
		Clear();
		$("#submit").val("Simpan");
		$("#form_submit").dialog("open");
	});
	
	$("#id").hide();
	
	
	$("#form_data").submit(function(){
		var mode = $("#submit").val();
		if(mode=='Simpan'){
			save();
		}else{
			update();
		}
		return false;
	});
	
	$('.edit').click(function(){
		Clear();
		var id = $(this).attr('id');
		$.ajax({
			url : url+'meja/Edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				$("#no_meja").val(list[0].no_meja);
				$("#kapasitas").val(list[0].kapasitas);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
	});
	
	$(".hapus").click(function(event){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'meja/Delete?id='+id,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	$("#refresh").click(function(){
		window.location.href = url+'meja';
	});
	
	function save(){
		$.ajax({
			url : url+'meja/Save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'meja';
			}
		});
	}
	
	
	function update(){
		$.ajax({
			url : url+'meja/Update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'meja';
			}
		});
	}
	
	function Clear(){
		$("#no_meja,#kapasitas").val('');
	}

});