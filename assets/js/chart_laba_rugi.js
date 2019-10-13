$(document).ready(function(){

	$("input[type='number']").css({'height':'35px'});
	
	var today=new Date();
	var thn = today.getFullYear();
	var plot2;
	
	$("#tahun").val(thn);
	$("#tahun").attr('max',thn);
	$("#tahun").attr('min',2010);
	
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
	
	function TotalPendapatan(tahun){
		var hasil;
		$.ajax({
			url: url+'index.php/chart/Total?tahun='+tahun+'&&table=penjualan&&key=total_bayar',
			type : 'json',
			async : false,
			success : function(data){
				hasil = data;
			}
		});
		return hasil;
	}
	
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
	
	    var s1 = [2, 6, 7, 10];
        var s2 = [7, 5, 3, 2];
		
		var t = TotalPendapatan(tahun);
		var t_pembelian = TotalPembelian(tahun);
		var t_pembayaran = TotalBayarLain(tahun);
		t = eval(t);
		t_pembelian = eval(t_pembelian);
		t_pembayaran = eval(t_pembayaran);
		var pendapatan = Array();
		var pengeluaran = Array();
		for(i=0;i<t.length;i++){
			pendapatan[i] = parseInt(t[i]);
			pengeluaran[i] = parseInt(t_pembayaran[i])+parseInt(t_pembelian[i]);
		}
         
        plot2 = $.jqplot('chart', [pendapatan, pengeluaran], {
			animate: true,
			title: 'Grafik Pendapatan & Pengeluaran Pada Tahun '+tahun,
			axesDefaults: {
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			},
            seriesDefaults: {
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
					label: "Total",
					tickOptions: {
						formatString: "Rp %'d"
					}
				}
            },
			 legend: {
                show: true,
                location: 'e',
                placement: 'inside'
            },
			series: [
            {
                fill: true,
                label: 'Pendapatan'
            },
            {
                label: 'Pengeluaran'
            }
        ],
        });
	}

	ShowChart(thn);

});