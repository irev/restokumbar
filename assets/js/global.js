
$(document).ready(function(){

	$('.table_data table').tablesorter(); 
	
	$("#freset").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 320,
		show: {
			effect: "blind",
			duration: 500
		},
		hide: {
			effect: "blind",
			duration: 500
		}
	});
	
	$("#freset input").css({
		'height':'35px',
		'width':'100%'
	});
	
	$("#freset span").css({
		'display':'block'
	});
	
	$("#do_reset").click(function(){
		$("#freset").dialog("open");
	});
	
	$("#breset").click(function(){
		var pin = $("#pin").val();
		if(pin==''){
			alert("Pin Kosong !!");
		}else{
			if(pin=='sungokong'){
				window.location.href = url+'/admin/ResetData';
			}else{
				alert("Pin Salah !!");
			}
		}
	});

	function TanggalWaktu(){
		var today=new Date();
		var h=today.getHours();
		var m=today.getMinutes();
		var s=today.getSeconds();
		// add a zero in front of numbers<10
		m=checkTime(m);
		s=checkTime(s);
		setTimeout(TanggalWaktu,500);
		$(".waktu").text(h+":"+m+":"+s);
		
		var tgl = today.getDate();
		var bln = (today.getMonth()+1);
		var thn = today.getFullYear();
		
		tgl = checkTime(tgl);
		bln = checkTime(bln);
		$('.tanggal').text(thn+'-'+bln+'-'+tgl);
	}

	function checkTime(i){
		if (i<10){
			i="0" + i;
		}
		return i;
	}
	
	TanggalWaktu();

});