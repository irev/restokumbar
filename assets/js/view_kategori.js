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
		var nok = $("#no_kategori").val();
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
		window.location.href = url+'kategori';
	});
	
	$(".hapus").click(function(event){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'kategori/delete?id='+id,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	$('.edit').click(function(){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'kategori/edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$('#no_kategori').val(list[0].no_kategori);
				$('#kategori').val(list[0].kategori);
				$('#keterangan').val(list[0].keterangan);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
	});
	
	function save(){
		$.ajax({
			url : url+'kategori/save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'kategori';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'kategori/update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'kategori';
			}
		});
	}
	
	function Clear(){
		$("#no_kategori,#kategori,#keterangan").val('');
	}

	
});