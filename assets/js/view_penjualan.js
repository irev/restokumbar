$(document).ready(function(){

	$("#container,#header,#toolbar").css({
		'width':'120%'
	});	
	
	$(".date").datepicker({ dateFormat : "yy-mm-dd" });
	
	$("#refresh").click(function(){
		window.location.href = url+'penjualan';
	})
	
	$("#detail").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 550,
		show: {
			effect: "blind",
			duration: 1000
		},
		hide: {
			effect: "explode",
			duration: 1000
		}
	});
	
	$("#form_report,#form_report_sales").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 400,
		show: {
			effect: "blind",
			duration: 1000
		},
		hide: {
			effect: "explode",
			duration: 1000
		}
	});
	$("#form_report input,#form_report_sales input[type='number']").css({'height':'35px'});
	
	
	$("#cetak").click(function(){
		var tgl = $(".tanggal").text();
		$("#tgl_awal,#tgl_akhir").val(tgl);
		$("#form_report").dialog("open");
	});
	
	$("#report").click(function(){
		var today=new Date();
		var thn = today.getFullYear();
		$("#tahun_report").val(thn);
		$("#tahun_report").attr('max',thn);
		$("#form_report_sales").dialog("open");
	});
	
	$("#view").click(function(){
		var awal = $("#tgl_awal").val();
		var akhir = $("#tgl_akhir").val();
		var link = url+'penjualan/cetak?awal='+awal+'&&akhir='+akhir;
		if(awal==''||akhir==''){
			alert("Tanggal ada yang kosong !!");
		}else{
			 window.open(link, 'cetak', 'window settings');
		}
	});
	
	$("#view_sales").click(function(){
		var tahun = $("#tahun_report").val();
		var link = url+'penjualan/LaporanPenjualan?tahun='+tahun;
		if(tahun==''){
			alert("Tahun Kosong !!");
		}else{
			 window.open(link, 'cetak', 'window settings'); 
		}
	});
	
	$(".detail").click(function(){
		var no_struk = $(this).attr('id');
		ShowDetail(no_struk);
	});
	
	$("#periode").click(function(){
		var awal = $("#awal").val();
		var akhir = $("#akhir").val();
		var link = url+'penjualan/LaporanPeriode?awal='+awal+'&&akhir='+akhir;
		if(awal==''||akhir==''){
			alert('Tanggal ada yang kosong !!');
		}else{
			window.open(link, 'cetak', 'window settings'); 
		}
	});
	
	$("#daftar").click(function(){
		var awal = $("#awal").val();
		var akhir = $("#akhir").val();
		var link = url+'penjualan/LaporanPerdaftar?awal='+awal+'&&akhir='+akhir;
		if(awal==''||akhir==''){
			alert('Tanggal ada yang kosong !!');
		}else{
			window.open(link, 'cetak', 'window settings'); 
		}
	});
	
	$(".hapus").click(function(event){
		var no_struk = $(this).attr('id');
		$.ajax({
			url: url+'penjualan/Delete?no_struk='+no_struk,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		});
	});
	
	
	function ShowDetail(no_struk){
		$.ajax({
			url: url+'penjualan/ShowDetail?no_struk='+no_struk,
			type: 'json',
			success: function(data){
				$("#tobar").text('');
				var list = eval(data);
				var tb = 0;
				$('.table_detail tbody').empty();
				for(i=0;i<list.length;i++){
					var no = '<td>'+(i+1)+'</td>';
					var item = '<td>'+list[i].item+'</td>';
					var harga = '<td>'+Format(list[i].harga)+'</td>';
					var jumlah = '<td>'+list[i].jumlah+'</td>';
					var total = '<td>'+Format(list[i].total)+'</td>';
					var row = no+item+harga+jumlah+total;
					$('.table_detail tbody').append("<tr>"+row+"</tr>");
					tb = tb+=parseInt(list[i].total);
				}
				$("#tobar").text(Format(tb));
				$("#detail").dialog("open");
			}
		});
	}
	
	function Format(number){
		return "Rp."+numeral(number).format('0,0');
    }

});