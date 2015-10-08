$(document).ready(function(){
	$('.university').first().addClass('active');
	showCourses($('.active').text());
	function showCourses(name){
		$('.courses').children().remove();
		$('.courses').append("<img src= 'http://s11.postimg.org/wiw0ijxk3/loadinng.gif' >");
		$.get( "../../actions/list_course.php?name="+name, function( data ) {
			$('.courses').children().remove();
			for(var i = 0; i<data.length; i++){
				if ( i== 0){
					$('.courses').append("<a href='#' class='course list-group-item active'>"+data[i]['name']+"</a>");
				}else{
					$('.courses').append("<a href='#' class='course list-group-item'>"+data[i]['name']+"</a>");
				}
				
			}
			var tag = document.createElement("script");
			tag.src = "../../js/shop-page.js";
			document.getElementsByTagName("head")[0].appendChild(tag);
			
		});
	}
});