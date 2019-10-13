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
	
	$('.stok').css({
		'height':'35px',
		'width':'50px',
		'background':'linear-gradient(silver,#eee)',
		'color':'#000',
		'font-weight':'bold'
	});
	$('.stok').attr('min','0');
	
	
	$("#cari").append(ListPencarian());
	
	$("#refresh").click(function(){
		window.location.href = url+'bahan';
	});
	
	$("#tambah").click(function(){
		Clear();
		$("#satuan,#supplier").empty();
		$("#submit").val("Simpan");
		$("#no_bahan").val(CreateID());
		$("#satuan").append(Satuan());
		$("#supplier").append(Supplier());
		$("#form_submit").dialog("open");
	});
	
	$("#cetak").click(function(){
		 window.open(url+'bahan/cetak', 'cetak', 'window settings');
	});
	
	$('.edit').click(function(){
		var id = $(this).attr('id');
		$.ajax({
			url : url+'bahan/Edit?id='+id,
			type : 'json',
			success: function(data){
				var list  = eval(data);
				Clear();
				$("#satuan,#supplier").empty();
				$("#satuan").append(Satuan());
				$("#supplier").append(Supplier());
				$('#no_bahan').val(list[0].no_bahan);
				$('#nama').val(list[0].nama);
				$('#harga').val(list[0].harga);
				$('#stok').val(list[0].stok);
				$('#satuan').val(list[0].satuan);
				$('#supplier').val(list[0].supplier);
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
	
	$(".table_data table tbody").on('propertychange keyup input paste','.stok',function(event){	
		   var id = $(this).attr('id');
		   $.ajax({
				url: url+'bahan/UpdateStok?id='+id,
				success: function(data){}
		   });
	});
	
	function save(){
		$.ajax({
			url : url+'bahan/Save',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'bahan';
			}
		});
	}
	
	function update(){
		$.ajax({
			url : url+'bahan/Update',
			type : 'POST',
			data : $("#form_data").serialize(),
			success : function(data){
				window.location.href = url+'bahan';
			}
		});
	}
	
	$(".hapus").click(function(event){
		var no_bahan = $(this).attr('id');
		$.ajax({
			url : url+'bahan/Delete?no_bahan='+no_bahan,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		}) 
	});
	
	
	function Clear(){
		$("#no_bahan,#nama,#harga,#supplier,#stok,#satuan").val('');
	}
	
	function Satuan(){
		var hasil;
		$.ajax({
			url: url+'bahan/Satuan',
			type : 'html',
			async : false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}
	
	function Supplier(){
		var hasil;
		$.ajax({
			url: url+'bahan/Supplier',
			type : 'html',
			async : false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}
	
	function ListPencarian(){
		var hasil;
		$.ajax({
			url: url+'bahan/ListPencarian',
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
			url: url+'bahan/CreateID',
			async : false,
			success : function(data){
				hasil = data;
			}
		})
		return hasil;
	}
	
	

});