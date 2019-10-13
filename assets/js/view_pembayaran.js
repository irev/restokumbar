$(document).ready(function(){

	$("#form_report_sales").dialog({
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
	$("#form_report_sales input").css({'height':'35px'});
	
	$("#report").click(function(){
		var today=new Date();
		var thn = today.getFullYear();
		$("#tahun_report").val(thn);
		$("#tahun_report").attr('max',thn);
		$("#form_report_sales").dialog("open");
	});
	
	$("#view_sales").click(function(){
		var tahun = $("#tahun_report").val();
		var link = url+'pembayaran/LaporanPertahun?tahun='+tahun;
		if(tahun==''){
			alert("Tahun Kosong !!");
		}else{
			 window.open(link, 'cetak', 'window settings'); 
		}
	});
	
	
	$(".date").datepicker({ dateFormat : "yy-mm-dd" });
	
	$(".hapus").click(function(event){
		var no_struk = $(this).attr('id');
		$.ajax({
			url: url+'pembayaran/Delete?no_struk='+no_struk,
			success: function(data){
				$(event.target ).closest("tr").remove();
			}
		});
	});
	
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
	
	$(".detail").click(function(){
		var no_struk = $(this).attr('id');
		ShowDetail(no_struk);
	});
	
	$("#refresh").click(function(){
		window.location.href = url+'pembayaran';
	});
	
	$("#daftar").click(function(){
		var awal = $("#awal").val();
		var akhir = $("#akhir").val();
		var link = url+'pembayaran/LaporanPerdaftar?awal='+awal+'&&akhir='+akhir;
		if(awal==''||akhir==''){
			alert('Tanggal ada yang kosong !!');
		}else{
			window.open(link, 'cetak', 'window settings'); 
		}
	});
	
	$("#periode").click(function(){
		var awal = $("#awal").val();
		var akhir = $("#akhir").val();
		var link = url+'pembayaran/LaporanPerperiode?awal='+awal+'&&akhir='+akhir;
		if(awal==''||akhir==''){
			alert('Tanggal ada yang kosong !!');
		}else{
			window.open(link, 'cetak', 'window settings'); 
		}
	});
	
	
	function ShowDetail(no_struk){
		$.ajax({
			url: url+'pembayaran/ShowDetail?no_struk='+no_struk,
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