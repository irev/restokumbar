$(document).ready(function(){

	$("#form_submit").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 650,
		show: {
			effect: "blind",
			duration: 500
		},
		hide: {
			effect: "blind",
			duration: 500
		}
	});
	
	
	$("#cari").append(LoadPencarian());
	
	$("#tambah").click(function(){
		Clear();
		$("#submit").val("Simpan");
		$("#no_supplier").val(CreateID());
		$("#kategori").append(LoadKategori());
		$("#form_submit").dialog("open");
	});
	
	$("#cetak").click(function(){
		 window.open(url+'supplier/cetak', 'cetak', 'window settings');
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
		window.location.href = url+'supplier';
	});
	
	$(".hapus").click(function(event){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'supplier/delete?id='+id,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	$('.edit').click(function(){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'supplier/edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$("#kategori").append(LoadKategori());
				$('#no_supplier').val(list[0].no_supplier);
				$('#nama').val(list[0].nama);
				$('#telp').val(list[0].telp);
				$('#alamat').val(list[0].alamat);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
	});
	
	function save(){
		$.ajax({
			url : url+'supplier/save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'supplier';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'supplier/update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'supplier';
			}
		});
	}
	
	function LoadKategori(){
		var hasil;
		$.ajax({
			url: url+'supplier/ListKategori',
			type : 'html',
			async : false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}
	
	function LoadPencarian(){
		var hasil;
		$.ajax({
			url: url+'supplier/ListPencarian',
			type : 'html',
			async : false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}	
	
	function CreateID(){
		var hasil;
		$.ajax({
			url: url+'supplier/CreateID',
			async: false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}	
	
	function Clear(){
		$("#no_supplier,#nama,#telp,#alamat").val('');
	}

	
});