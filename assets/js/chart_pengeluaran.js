$(document).ready(function(){

	$("input[type='number']").css({'height':'35px'});
	var today=new Date();
	var thn = today.getFullYear();
	var plot2;
	
	$("#tahun").val(thn);
	$("#tahun").attr('max',thn);
	$("#tahun").attr('min',2010);
	
	$("#chart").css({
		'width':'95%',
		'height':'75%'
	});
	
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
	
	$('form').submit(function(){
		var value = $("#tahun").val();
		ShowChart(value);
		return false;
	});
	
	
	function TotalPembelian(tahun){
		var hasil;
		$.ajax({
			url: url+'index.php/chart/Total?tahun='+tahun+'&&table=pembelian&&key=total_bayar',
			type : 'json',
			async : false,
			success : function(data){
				hasil = data;
			}
		});
		return hasil;
	}
	
	function TotalBayarLain(tahun){
		var hasil;
		$.ajax({
			url: url+'index.php/chart/Total?tahun='+tahun+'&&table=pembayaran&&key=total_bayar',
			type : 'json',
			async : false,
			success : function(data){
				hasil = data;
			}
		});
		return hasil;
	}
	
	function ShowChart(tahun){
		
		if(plot2){
			plot2.destroy();
		 }
		var t = TotalPembelian(tahun);
		var t2 = TotalBayarLain(tahun);
		t = eval(t);
		t2 = eval(t2);
		var data = Array();
			for(i=0;i<t.length;i++){
				data[i] = parseInt(t[i])+parseInt(t2[i]);
			}
		$.jqplot.config.enablePlugins = true;
     
        plot2 = $.jqplot('chart', [data], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
			title: 'Grafik Pengeluaran Pada Tahun '+tahun,
			axesDefaults: {
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			},
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
					label: "Bulan Januari - Desember "+tahun,
                    ticks: bulan,
					pad: 0
                },
				yaxis: {
					label: "Total Pengeluaran",
					tickOptions: {
						formatString: "Rp %'d"
					}
				}
            },
            highlighter: { show: false },
			legend: {
                show: true,
                location: 'e',
                placement: 'inside'
            },
			series: [{
                fill: true,
                label: 'Pengeluaran'
            }]
        });
	 }
	
	 ShowChart(thn);
	
});