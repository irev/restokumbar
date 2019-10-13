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
	
	function Total(tahun){
		var hasil;
		$.ajax({
			url: url+'index.php/chart/Total?tahun='+tahun+'&&table=pembayaran&&key=total',
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
		  var t = Total(tahun);
		  t = eval(t);
		  var data = Array();
		  for(i=0;i<t.length;i++){
			  data[i] = parseInt(t[i]);
		  }
		  plot2 = $.jqplot ('chart', [data], {
		  // Give the plot a title.
		  animate: true,
		  title: 'Grafik Pembayaran Lain - Lain Pada Tahun '+tahun,
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
			  }
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
			  label: "Total Pembayaran Lain - Lain",
			  tickOptions: {
                    formatString: "Rp%'d"
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