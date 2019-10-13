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
		$("#form_submit").dialog("open");
	});
	
	$("#form_data").submit(function(){
		var mode = $("#submit").val();
		var nok = $("#no_posisi").val();
		var max = nok.length;
		if(max!=2){
			alert('Karakter harus 2 !!');
		}else{
			if(mode=='Simpan'){
				save();
			}else{
				update();
			}
		}
		return false;
	});
	
	$("#refresh").click(function(event){
		window.location.href = url+'posisi';
	});
	
	$(".hapus").click(function(event){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'posisi/delete?id='+id,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	$('.edit').click(function(){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'posisi/edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$('#no_posisi').val(list[0].no_posisi);
				$('#nama').val(list[0].nama);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
	});
	
	function save(){
		$.ajax({
			url : url+'posisi/save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'posisi';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'posisi/update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'posisi';
			}
		});
	}
	
	function Clear(){
		$("#no_posisi,#posisi,#keterangan").val('');
	}

	
});