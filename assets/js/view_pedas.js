$(document).ready(function(){

	$("#button_list").css({
		'margin-top':'20px'
	});
	$("#form_submit").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 620,
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
		$("#no_level").val(CreateID());
		$("#form_submit").dialog("open");
	});
	
	$("#form_data").submit(function(){
		var mode = $("#submit").val();
		if(mode=='Simpan'){
			save();
		}else{
			update();
		}
		return false;
	});
	
	$("#refresh").click(function(event){
		window.location.href = url+'pedas';
	});
	
	$(".hapus").click(function(event){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'pedas/delete?id='+id,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	$('.edit').click(function(){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'pedas/edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$('#no_level').val(list[0].no_level);
				$('#nama').val(list[0].nama);
				$('#harga').val(list[0].harga);
				$('#cabe').val(list[0].cabe);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
	});
	
	function save(){
		$.ajax({
			url : url+'pedas/save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'pedas';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'pedas/update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'pedas';
			}
		});
	}
	
	function CreateID(){
		var value;
		$.ajax({
			url: url+'pedas/CreateID',
			async : false,
			success : function(data){
				value = data;
			}
		});
		return value;
	}
	
	function Clear(){
		$("#no_level,#nama,#harga,#cabe").val('');
	}

	
});