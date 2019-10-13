$(document).ready(function(){

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
	
	
	$("#cari").append(ListPencarian());
	
	$("#refresh").click(function(){
		window.location.href = url+'extra';
	});
	
	$("#tambah").click(function(){
		Clear();
		$("#submit").val("Simpan");
		$("#no_extra").val(CreateID());
		$("#form_submit").dialog("open");
	});
	
	$("#cetak").click(function(){
		 window.open(url+'extra/cetak', 'cetak', 'window settings');
	});
	
	$('.edit').click(function(){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'extra/Edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$('#no_extra').val(list[0].no_extra);
				$('#nama').val(list[0].nama);
				$('#harga').val(list[0].harga);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
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
	
	function save(){
		$.ajax({
			url : url+'extra/Save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'extra';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'extra/Update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'extra';
			}
		});
	}
	
	$(".hapus").click(function(event){
		var no_extra = $(this).attr('id');
		$.ajax({
			url : url+'extra/Delete?no_extra='+no_extra,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	
	function Clear(){
		$("#no_extra,#nama,#harga,#supplier,#stok,#satuan").val('');
	}
	
	
	function ListPencarian(){
		var hasil;
		$.ajax({
			url: url+'extra/ListPencarian',
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
			url: url+'extra/CreateID',
			async : false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}
	
	

});