$(document).ready(function(){

	$("#container,#header,#toolbar").css({
		'width':'200%'
	});
	
	$("#cari").append(ListPencarian());
	$("#tgl_lahir").datepicker({ 
		dateFormat : "yy-mm-dd",
		changeMonth: true,
		changeYear: true
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
	
	$("#refresh").click(function(){
		window.location.href = url+'member';
	});
	
	$("#tambah").click(function(){
		Clear();
		$("#tgl_register").val($(".tanggal").text());
		$("#id").val(CreateID());
		$("#submit").val("Simpan");
		$("#form_submit").dialog("open");
	});
	
	$(".hapus").click(function(event){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'member/Delete?id='+id,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	
	function CreateID(){
		var hasil;
		$.ajax({
			url : url+'member/CreateID',
			async : false,
			success : function(data){
				hasil = data;
			}
		});
		return hasil;
	}
	
	function Clear(){
		$("#id").val('');
		$("#tgl_register").val('');
		$("#nama_lengkap").val('');
		$("#tempat_lahir").val('');
		$("#gender").val('');
		$("#alamat").val('');
		$("#telp").val('');
		$("#email").val('');
		$("#facebook").val('');
		$("#twitter").val('');
		$("#tgl_lahir").val('');
	}
	
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
		var id = $(this).attr('id');
		$.ajax({
			url : url+'member/Edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$("#id").val(list[0].id);
				$("#tgl_register").val(list[0].tgl_register);
				$("#nama_lengkap").val(list[0].nama_lengkap);
				$("#tempat_lahir").val(list[0].tempat_lahir);
				$("#gender").val(list[0].gender);
				$("#alamat").val(list[0].alamat);
				$("#telp").val(list[0].telp);
				$("#email").val(list[0].email);
				$("#facebook").val(list[0].facebook);
				$("#twitter").val(list[0].twitter);
				$("#tgl_lahir").val(list[0].tgl_lahir);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
	});
	
	function save(){
		$.ajax({
			url : url+'member/Save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'member';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'member/Update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'member';
			}
		});
	}
	
	function ListPencarian(){
		var hasil;
		$.ajax({
			url : url+'member/ListPencarian',
			async : false,
			success : function(data){
				hasil = data;
			}
		});
		return hasil;
	}

});