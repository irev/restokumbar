$(document).ready(function(){

	$("#navigasi").hide();
	$("body").css({
		'background-color':'#eee'
	});
	$("#content").css('margin-top','20px');
	$("#container,#header,#toolbar").css({
		'width':'100%'
	});	
	$('.table_data table tbody').css({
		'background': 'none'
	});
	$(".table_data table tfoot input").css({
		'height':'30px'
	});
	
	
	// Hide OBject
	$("#in_tobar").hide();
	$("#tanggal,#waktu,#no_pembayaran,#no_check").hide();
	
	
	// Object Event
	
	$(".table_data table tbody").on('click','.BRemove',function(event){
		 $(event.target ).closest("tr").remove();
		  TotalBayar();
	});
	
	$("#tambah").click(function(){
		AddRow();
	});
	
	
	
	$(".table_data table tbody").on('propertychange keyup input paste','#jumlah',function(event){	
		   var jumlah = $(this).val();
		   var harga = $(event.target ).closest("tr").find("#harga").val();
		   var total = jumlah*harga;
		   var nama_menu = $(event.target ).closest("tr").find("#nama").val();
		   if(nama_menu==''){
				alert('Isi kan keteranfan dan harga ');
				$(this).val('');
		   }else{
				$(event.target ).closest("tr").find("#total").val(Format(total));
				$(event.target ).closest("tr").find("#in_total").val(total);
				TotalBayar();
		   }
		   
	});
	
	$('form').submit(function(){
		SaveDetail();	
		SaveData();
		return false;
	});
	
	
	function SaveDetail(){
		var row = $(".table_data table tbody tr").length;
		var no_pembayaran = $("#no_pembayaran").val();
		var tanggal = $("#tanggal").val();
		var item =  $("input[id='nama']").map(function(){return $(this).val();}).get();
		var harga = $("input[id='harga']").map(function(){return $(this).val();}).get();
		var jumlah = $("input[id='jumlah']").map(function(){return $(this).val();}).get();
		var total =  $("input[id='in_total']").map(function(){return $(this).val();}).get();
		for(i=0;i<row;i++){
			Do_SaveDetail(no_pembayaran,tanggal,item[i],harga[i],jumlah[i],total[i]);
		}
	}
	
	function Do_SaveDetail(no_pembayaran,tanggal,item,harga,jumlah,total){
		var l1 = 'no_pembayaran='+no_pembayaran;
		var l2 = '&&tanggal='+tanggal;
		var l3 = '&&item='+item;
		var l4 = '&&harga='+harga;
		var l5 = '&&jumlah='+jumlah;
		var l6 = '&&total='+total;
		var link = l1+l2+l3+l4+l5+l6;
		$.ajax({
			url : url+'pembayaran/SaveDetail?'+link,
			success : function(data){}
		});
	}
	
	function SaveData(){
		var id = $("#no_pembayaran").val();
		$.ajax({
			url : url+'pembayaran/SaveData',
			type: 'POST',
			data : $('form').serialize(),
			success: function(){
				 window.open(url+'pembayaran/CetakFaktur?id='+id, 'Faktur', 'window settings');
				 window.location.href = url+'pembayaran/add';
			}
		});
	}
	
	
	function AddRow(){
		var nama = "<td><input type='text' id='nama' required/></td>";
		var harga = "<td><input type='number' id='harga' required /></td>";
		var jumlah = "<td align='center'><input type='number' id='jumlah' min='1' max='1' required/></td>";
		var total = "<td><input type='text' id='total' readonly='true' required /><input type='text' id='in_total' class='in_total' readonly='true' /></td>";
		var action = '<td><a href="javascript:void(0)" class="btn BRemove">Hapus Item</a></td>';
		var list = nama+harga+jumlah+total+action;
		$('.table_data table tbody').append('<tr>'+list+'</tr>');
		$("input[type='text']").css({
			'height':'30px'
		});
		$(".table_data table tbody #jumlah").css({
			'width':'55px',
			'height':'30px'
		});
		$(".table_data table tbody #harga").css({
			'height':'30px'
		});
		$(".in_total").hide();
		
	}
	
	
	function Format(number){
		return "Rp."+numeral(number).format('0,0');
    }
	
	function Cek(){
		var contents = {}, duplicates = false;
		$(".table_data table tbody tr").each(function(){
			var name = $(this).closest("tr").find("#nama").val();
			if (contents[name]) {
				duplicates = true;
				return false;
			}
			contents[name] = true;
		});
		if (duplicates){
			return true;
		}
	}
	
	
	
	function TotalBayar(){
		var dt = $("input[id='in_total']").map(function(){return $(this).val();}).get();
		var tb = 0;
		for(i=0;i<dt.length;i++){
			tb = tb + parseInt(dt[i]);	
		}
		$("#tobar").val(Format(tb));
		$("#in_tobar").val(tb);
	}
	
	
	function Time(){
		var today=new Date();
		var h=today.getHours();
		var m=today.getMinutes();
		var s=today.getSeconds();
		// add a zero in front of numbers<10
		h = checkTime(h);
		m=checkTime(m);
		s=checkTime(s);
		setTimeout(Time,500);
		$("#waktu").val(h+":"+m+":"+s);
		
		var tgl = today.getDate();
		var bln = (today.getMonth()+1);
		var thn = today.getFullYear();
		
		tgl = checkTime(tgl);
		bln = checkTime(bln);
		$("#tanggal").val(thn+'-'+bln+'-'+tgl);
	}
	
	function checkTime(i){
		if (i<10){
			i="0" + i;
		}
		return i;
	}
	
	
	//
	
	$('.supp').css({
		'background-color': '#eee',
		'color':'#000',
		'font-size':'18px'
	});
	
	
	AddRow();
	Time();

});