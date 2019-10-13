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
	$("#tanggal,#waktu,#no_pembelian,#no_check").hide();
	
	
	// Object Event
	
	$(".table_data table tbody").on('click','.BRemove',function(event){
		 $(event.target ).closest("tr").remove();
		  TotalBayar();
	});
	
	$("#tambah").click(function(){
		AddRow();
	});
	
	
	
	$(".table_data table tbody").on('change','#nama',function(event){
		 var nama = $(this).val();
		 if(nama==''){
			$(event.target ).closest("tr").remove();
		 }else if(Cek()){
			alert(nama+' sudah ada !!');
			$(event.target ).closest("tr").remove();
		 }else{
			$.ajax({
				url: url+'pembelian/Harga?nama='+nama,
				success : function(data){
					$(event.target ).closest("tr").find("#harga").val(Format(data));
					$(event.target ).closest("tr").find("#in_harga").val(data);
					$(event.target ).closest("tr").find("#jumlah").val(0);
					$(event.target ).closest("tr").find("#total").val(0);
					$(event.target ).closest("tr").find("#in_total").val(0);
					TotalBayar();
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
		   }
		   
	});
	
	$('form').submit(function(){
		SaveDetail();	
		SaveData();
		return false;
	});
	
	
	function SaveDetail(){
		var row = $(".table_data table tbody tr").length;
		var no_pembelian = $("#no_pembelian").val();
		var tanggal = $("#tanggal").val();
		var item =  $("select[id='nama']").map(function(){return $(this).val();}).get();
		var harga = $("input[id='in_harga']").map(function(){return $(this).val();}).get();
		var jumlah = $("input[id='jumlah']").map(function(){return $(this).val();}).get();
		var total =  $("input[id='in_total']").map(function(){return $(this).val();}).get();
		for(i=0;i<row;i++){
			Do_SaveDetail(no_pembelian,tanggal,item[i],harga[i],jumlah[i],total[i]);
		}
	}
	
	function Do_SaveDetail(no_pembelian,tanggal,item,harga,jumlah,total){
		var l1 = 'no_pembelian='+no_pembelian;
		var l2 = '&&tanggal='+tanggal;
		var l3 = '&&item='+item;
		var l4 = '&&harga='+harga;
		var l5 = '&&jumlah='+jumlah;
		var l6 = '&&total='+total;
		var link = l1+l2+l3+l4+l5+l6;
		$.ajax({
			url : url+'pembelian/SaveDetail?'+link,
			success : function(data){}
		});
	}
	
	function SaveData(){
		var id = $("#no_pembelian").val();
		$.ajax({
			url : url+'pembelian/SaveData',
			type: 'POST',
			data : $('form').serialize(),
			success: function(){
				 window.open(url+'pembelian/CetakFaktur?id='+id, 'Faktur', 'window settings');
				 window.location.href = url+'pembelian/add';
			}
		});
	}
	
	function LoadSupplier(){
		$.ajax({
			url: url+'pembelian/supplier',
			type: 'json',
			async: false,
			success: function(data){
				var isi = eval(data);
				for(i=0;i<isi.length;i++){
					$("#supplier").append("<option value='"+isi[i].nama+"'>"+isi[i].nama+"</option>");
				}
			}
		});
	}
	
	function AddRow(){
		var nama = "<td><select id='nama' required>"+LoadBahan()+"</select></td>";
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
	
	function LoadBahan(){
		var value;
			$.ajax({
				url: url+'pembelian/Bahan',
				type : 'html',
				async : false,
				success : function(data){
					value = data;
				}
			});
		return value;
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
	
	LoadSupplier();
	AddRow();
	Time();

});