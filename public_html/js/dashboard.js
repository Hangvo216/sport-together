var Dashboard = new Object();
Dashboard.loadDashboard = function(){
		
	$('#dashboard .label.drop-down').off('click');
	$('#dashboard .label.drop-down').click(function(){
		if($(this).hasClass('clicked')){
			$(this).removeClass('clicked');
		}
		else{
			$(this).addClass('clicked');
		}
	});
	
	$('#dashboard .label.drop-down .menu .item').off('click');
	$('#dashboard .label.drop-down .menu .item').click(function(){
		
		val = $.number($(this).attr('val'));
		chg = $(this).attr('chg');
		name = $(this).html();
		
		tar = $(this).parent();
		tar.children('.item').each(function(){
			$(this).removeClass('selected');
		});
		$(this).addClass('selected');
		
		tar = tar.parent();
		tar.children('.text').children('.c').html(name);
		tar.children('.text').attr('title',name);
		tar = tar.parent();
		tar.children('.num').html(val);

		if(chg > 0){
			chng = tar.children('.chng');
			chng.removeClass('up');
			chng.removeClass('down');
			chng.addClass('up');
			chng.html('(+'+$.number(chg)+') <div class="up m"></div>');
		}
		else{
			chng = tar.children('.chng');
			chng.removeClass('up');
			chng.removeClass('down');
			chng.addClass('down');
			chng.html('('+$.number(chg)+') <div class="down m"></div>');
		}
	});
};