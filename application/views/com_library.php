<?php 

function Format($harga){
	return "Rp. ".number_format($harga,0,"",".");
}
	
function Get($value,$table,$key,$id){
	$query = mysql_query("SELECT ".$value." FROM ".$table." WHERE ".$key." = '".$id."' ");
	while($row = mysql_fetch_array($query)){
		return $row[$value];
	}
}
	
?>

<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/menu.png" />	
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/themes/eggplant/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.jqplot.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css"/>
<script type="text/javascript"> var url = '<?php echo base_url();?>';</script>
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.key.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/numeral.js"></script>
<script src="<?php echo base_url();?>assets/js/globalize.js"></script>
<script src="<?php echo base_url();?>assets/js/globalize.culture.de-DE.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.accordion.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.button.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.menu.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.mouse.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.draggable.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.position.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.resizable.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.dialog.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.autocomplete.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-blind.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-bounce.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-clip.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-drop.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-explode.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-fade.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-fold.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-highlight.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-pulsate.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-scale.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-shake.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-slide.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.effect-transfer.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.spinner.js"></script>
<script src="<?php echo base_url();?>assets/ui/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script src="<?php echo base_url();?>assets/js/global.js"></script>