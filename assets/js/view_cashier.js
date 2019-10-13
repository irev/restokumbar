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
	$(".table_data table tfoot input[type='number']").css({
		'height':'30px'
	});
	
	
	// Hide OBject
	$("#in_sub_total,#in_diskon,#in_potongan,#in_grand_total,#in_kembalian").hide();
	$("#tanggal,#waktu,#no_struk,#no_check").hide();
	
	$(".table_data table tbody").on('click','.BRemove',function(event){
		 $(event.target ).closest("tr").remove();
		 TotalBayar();
		 ClearBayar();
	});
	
	$("#tambah").click(function(){
		AddRow();
		ClearBayar();
	});
	
	$(".table_data table tbody").on('change','#nama',function(event){
		 var nama = $(this).val();
		 if(nama==''){
			$(event.target ).closest("tr").remove();
		 }else if(CekMenu()){
			alert(nama+' sudah ada !!');
			$(event.target ).closest("tr").remove();
		 }else{
			$.ajax({
				url: url+'cashier/HargaMenu?menu='+nama,
				success : function(data){
					$(event.target ).closest("tr").find("#harga").val(Format(data));
					$(event.target ).closest("tr").find("#in_harga").val(data);
					$(event.target ).closest("tr").find("#jumlah").val(0);
					$(event.target ).closest("tr").find("#total").val(0);
					$(event.target ).closest("tr").find("#in_total").val(0);
					TotalBayar();
					ClearBayar();
				}
			});
		 } 
		 
	});
	
	$(".table_data table tbody").on('propertychange keyup input paste','#jumlah',function(event){	
		   var jumlah = $(this).val();
		   var harga = $(event.target ).closest("tr").find("#in_harga").val();
		   var total = jumlah*harga;
		   var nama_menu = $(event.target ).closest("tr").find("#nama").val();
		   if(nama_menu==''){
				alert('Pilih Menu');
				$(this).val('');
		   }else{
				$(event.target ).closest("tr").find("#total").val(Format(total));
				$(event.target ).closest("tr").find("#in_total").val(total);
				TotalBayar();
				ClearBayar();
		   }
		   
	});
	
	$(".table_data table tfoot").on('propertychange keyup input paste','#cash',function(event){	
		  var cash = $(this).val();
		  var tobar = $("#in_grand_total").val();
		  var kembali = cash - tobar;
		  if(kembali<0||tobar==0){
			  $("#in_kembalian").val(0);
			  $("#kembalian").val(Format(0));
		  }else{
			  $("#in_kembalian").val(kembali);
			  $("#kembalian").val(Format(kembali));
		  }
		 
	});
	
	$('form').submit(function(){
		var grand = $("#in_grand_total").val();
		var cash =  $("#cash").val();
		grand = parseInt(grand);
		cash = parseInt(cash);
		if(cash<grand){
			alert('CASH MINIMAL '+Format(grand));
		}else{
			SaveDetail();	
			SaveData();
		}	
		return false;
	});
	
	$('#header,.up').hide();
	$('.up').click(function(){
		$('#header,.up').hide();
		$('.down').show();
	});
	
	$('.down').click(function(){
		$('.down').hide();
		$('.up,#header').show();
	});
	
	function SaveData(){
		var id = $("#no_struk").val();
		$.ajax({
			url : url+'cashier/SaveData',
			type: 'POST',
			data : $('form').serialize(),
			success: function(){
				 window.open(url+'penjualan/struk?no_struk='+id, 'Struk Pembayaran', 'window settings');
				 window.location.href = url+'cashier/';
			}
		});
	}
	
	function SaveDetail(){
		var row = $(".table_data table tbody tr").length;
		var no_struk = $("#no_struk").val();
		var tanggal = $("#tanggal").val();
		var item =  $("select[id='nama']").map(function(){return $(this).val();}).get();
		var harga = $("input[id='in_harga']").map(function(){return $(this).val();}).get();
		var jumlah = $("input[id='jumlah']").map(function(){return $(this).val();}).get();
		var total =  $("input[id='in_total']").map(function(){return $(this).val();}).get();
		for(i=0;i<row;i++){
			Do_SaveDetail(no_struk,tanggal,item[i],harga[i],jumlah[i],total[i]);
		}
	}
	
	function Do_SaveDetail(no_struk,tanggal,item,harga,jumlah,total){
		var l1 = 'no_struk='+no_struk;
		var l2 = '&&tanggal='+tanggal;
		var l3 = '&&item='+item;
		var l4 = '&&harga='+harga;
		var l5 = '&&jumlah='+jumlah;
		var l6 = '&&total='+total;
		var link = l1+l2+l3+l4+l5+l6;
		$.ajax({
			url : url+'cashier/SaveDetail?'+link,
			success : function(data){}
		});
	}
	
	
	function AddRow(){
		var nama = "<td><select id='nama' required>"+LoadKategori()+"</select></td>";
		var harga = "<td><input type='text' readonly='true' id='harga' required /><input type='text' id='in_harga' readonly='true' /></td>";
		var jumlah = "<td align='center'><input type='number' id='jumlah' min='1' required/></td>";
		var total = "<td><input type='text' id='total' readonly='true' required /><input type='text' id='in_total' readonly='true' /></td>";
		var action = '<td><a href="javascript:void(0)" class="btn BRemove">Hapus Item</a></td>';
		var list = nama+harga+jumlah+total+action;
		$('.table_data table tbody').append('<tr>'+list+'</tr>');
		$("input[type='text']").css({
			'height':'30px'
		});
		$(".table_data table tbody input[type='number']").css({
			'width':'55px',
			'height':'30px'
		});
		$("#in_harga,#in_total").hide();
		
	}
	
	function LoadKategori(){
		var value;
			$.ajax({
				url: url+'cashier/ListKategori',
				type : 'html',
				async : false,
				success : function(data){
					value = data;
				}
			});
		return value;
	}
	
	function CekMenu(){
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
		$("#sub_total").val(Format(tb));
		$("#in_sub_total").val(tb);
		var disk = 0;
		if(tb>300000){
			disk = 0.05;
		}
		if(tb>500000){
			disk = 0.1;
		}
		var potongan = tb*disk;
		
		$("#in_diskon").val(disk);
		$("#diskon").val( (disk*100)+" %");
		
		$("#in_potongan").val(potongan);
		$("#potongan").val(Format(potongan));
		
		var grand = tb - potongan;
		$("#in_grand_total").val(grand);
		$("#grand_total").val(Format(grand));
		
	}
	
	function Format(number){
		return "Rp."+numeral(number).format('0,0');
    }
	
	function ClearBayar(){
		$("#cash").val('');
		$("#kembalian").val('');
		$("#kembalian").val('');
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
	
	AddRow();
	Time();
	
});