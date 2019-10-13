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
	
	 
	$('#last_no_menu').hide();
	$("#cari").append(LoadPencarian());
	
	
	$("#tambah").click(function(){
		Clear();
		$("#submit").val("Simpan");
		$("#kategori").empty();
		$("#kategori").append(LoadKategori());
		$("#form_submit").dialog("open");
	});
	
	$("#cetak").click(function(){
		 window.open(url+'menu/cetak', 'cetak', 'window settings');
	});
	
	$("#form_data").submit(function(){
		var mode = $("#submit").val();
		var last_id = $('#last_no_menu').val();
		var new_id = $('#id_menu').val();
		if(mode=='Simpan'){
			save();
		}else{
			if(last_id==new_id){
				update();
			}else{
				do_delete(last_id);
				do_save();
			}
		}
		return false;
	});
	
	$("#refresh").click(function(event){
		window.location.href = url+'menu';
	});
	
	// Bikin ID
	
	 
	$("#kategori").change(function(){
		  var value = $(this).val();
		  if(value==''){
			   $('#no_menu').val("");
		  }else{
			 $.ajax({
				url : url+'menu/CreateID?kategori='+value,
					success : function(data){
					$('#id_menu').val(data);
				}
			});
		  }
	});
	
	
	
	$(".hapus").click(function(event){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'menu/delete?no_menu='+id,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	
	
	
	$('.edit').click(function(){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'menu/edit?no_menu='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$("#kategori").empty();
				$("#kategori").append(LoadKategori());
				$('#id_menu').val(list[0].no_menu);
				$('#last_no_menu').val(list[0].no_menu);
				$('#nama').val(list[0].nama);
				$('#kategori').val(list[0].kategori);
				$('#harga').val(list[0].harga);
				$('#rekomendasi').val(list[0].rekomendasi);
				$("#submit").val("Update");
				$("#form_submit").dialog("open");
			}
		})
	});
	
	function do_delete(id){
		$.ajax({
			url : url+'menu/delete?no_menu='+id,
			success: function(data){
			}
		}) 
	}
	
	function do_save(){
		$.ajax({
			url : url+'menu/save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'menu';
			}
		});
	}
	
	function save(){
		$.ajax({
			url : url+'menu/save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'menu';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'menu/update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'menu';
			}
		});
	}
	
	function LoadKategori(){
		var hasil;
		$.ajax({
			url: url+'menu/ListKategori',
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
			url: url+'menu/ListPencarian',
			type : 'html',
			async : false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}	
	
	function Clear(){
		$("#no_menu,#id_menu,#last_no_menu,#nama,#harga,#kategori,#rekomendasi,#keteragan").val('');
	}

	
});