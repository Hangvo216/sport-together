var Html = new Object();

Html.switchAccount = function(id){
	$('body .loading').css('z-index','4');
	// Make the switch, dumping output into #null.
	$('#null').load("drivers/load.php?d=switch-account&i="+id,function(){
		$('#null').html('');
		window.location.hash= ("#/data/foresight");
		location.reload();
	});
}
