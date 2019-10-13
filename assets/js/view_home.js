$(document).ready(function(){

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
	
	$("#button_list").css({
		'margin-top':'20px'
	});
	
	$("#refresh").click(function(){
		window.location.href = url+'home';
	})
	
	$("#cetak").click(function(){
		var awal = $(".tanggal").text();
		var akhir = $(".tanggal").text();
		var link = url+'penjualan/daily?awal='+awal+'&&akhir='+akhir;
		 window.open(link, 'cetak', 'window settings');
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
	
	$(".detail").click(function(){
		var no_struk = $(this).attr('id');
		ShowDetail(no_struk);
	});
	
	$(".struk").click(function(){
		var no_struk = $(this).attr('id');
		var link = url+'penjualan/struk?no_struk='+no_struk;
		window.open(link, 'cetak', 'window settings');
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
	
	var today=new Date();
	var thn = today.getFullYear();
	var plot2;
	
	var bulan  = new Array();
	bulan[0] = "Januari";
	bulan[1] = "Februari";
	bulan[2] = "Maret";
	bulan[3] = "April";
	bulan[4] = "Mei";
	bulan[5] = "Juni";
	bulan[6] = "Juli";
	bulan[7] = "Agustus";
	bulan[8] = "September";
	bulan[9] = "Oktober";
	bulan[10] = "November";
	bulan[11] = "Desember";
	
	function TotalPenjualan(tahun){
		var hasil;
		$.ajax({
			url: url+'chart/Total?tahun='+tahun+'&&table=penjualan&&key=total_bayar',
			type : 'json',
			async : false,
			success : function(data){
				hasil = data;
			}
		});
		return hasil;
	}
	
	$('#chart').css({
		'width':'94%',
		'height':'50%',
		'margin-bottom':'20px'
	});
	
	function ShowChart(tahun){
		  if(plot2){
			plot2.destroy();
		  }
		  var t = TotalPenjualan(tahun);
		  t = eval(t);
		  var data = Array();
		  for(i=0;i<t.length;i++){
			  data[i] = parseInt(t[i]);
		  }
		  plot2 = $.jqplot ('chart', [data], {
		  // Give the plot a title.
		  animate: true,
		  title: 'Grafik Penjualan Tahun Ini',
		  // You can specify options for all axes on the plot at once with
		  // the axesDefaults object.  Here, we're using a canvas renderer
		  // to draw the axis label which allows rotated text.
		  axesDefaults: {
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer
		  },
		  // Likewise, seriesDefaults specifies default options for all
		  // series in a plot.  Options specified in seriesDefaults or
		  // axesDefaults can be overridden by individual series or
		  // axes options.
		  // Here we turn on smoothing for the line.
		  seriesDefaults: {
			  rendererOptions: {
				  smooth: true
			  },
			  pointLabels: { show: true }
		  },
		  // An axes object holds options for all axes.
		  // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
		  // Up to 9 y axes are supported.
		  axes: {
			// options for each axis are specified in seperate option objects.
			xaxis: {
			  renderer: $.jqplot.CategoryAxisRenderer,
			  label: "Bulan Januari - Desember "+tahun,
			  ticks: bulan,
			  // Turn off "padding".  This will allow data point to lie on the
			  // edges of the grid.  Default padding is 1.2 and will keep all
			  // points inside the bounds of the grid.
			  pad: 0
			},
			yaxis: {
			  label: "Total Penjualan",
			  tickOptions: {
                    formatString: "Rp %'d"
                },
			}
		  }
		});
	}
	
	function Format(number){
		return "Rp."+numeral(number).format('0,0');
    }
	
	ShowChart(thn);

});