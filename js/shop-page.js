$(document).ready(function(){
	$('.add').click(function(){
		var this_element = $(this);
		if(!($('.buy-cart').length == 0 && $('.remove-cart').length == 0)){
			var id = $(this).attr('id');
			id = id.substring(id.indexOf('-')+1);
			var index_space = $('.project-count-'+id).first().text().indexOf(' '); 
			var max_elem = $('.project-count-'+id).first().text().substring(0,index_space);
			var number = parseInt(this_element.parent().children(".number-items").first().text().trim());
			if(number < max_elem){
				//alert(number);
				this_element.parent().children(".number-items").text(" "+(number+1)+" ");
			}
		}

	});
	$('.minus').click(function(){
		var this_element = $(this);
		if(!($('.buy-cart').length == 0 && $('.remove-cart').length == 0)){
			var number = parseInt(this_element.parent().children(".number-items").first().text().trim());
			if(number > 1){
				this_element.parent().children(".number-items").text(" "+(number-1)+" ");
			}
		}

	});
	$('.university').click(function(){
		if(!$(this).hasClass('active')){
			$(this).parent().children().removeClass('active');
			$(this).addClass('active');
			$('.lead-course').show();
			showCourses($(this).text());
			showProjects($(this).text(),null);
		}
	});
	$('.course').click(function(){
		if(!$(this).hasClass('active')){
			$('.courses').children().removeClass('active');
			$(this).addClass('active');
			showProjects($('#universities').children('.active').text(),$(this).text());
		}
	});
	$('#logout-link').click(function(){
		$.get( "../../actions/logout-user.php", function( data ) {
			$('#li-cart').replaceWith(data);
			$('#li-logout').remove();
			$('#li-profile').remove();
			$('.alerts').children().remove();
	        $('.alerts').append('<div class="alert alert-success" style="text-align: -webkit-center;" role="alert"> logged out successfully</div>');
			// var tag = document.createElement("script");
			// tag.src = "../../js/shop-page.js";
			// document.getElementsByTagName("head")[0].appendChild(tag);
			refresh_scripts();
		});
	});
	$('.remove-cart').click(function(){
		var this_element = $(this); 
		var id = $(this).parent().parent().attr('id');
		id = id.substring(id.indexOf('-')+1);
		$.ajax({
        	type:'post',
        	url: "../../actions/remove_from_cart.php", //sumbits it to the given url of the form
        	data: 'id='+id
        }).success(function(data){
        	if(data[0]=="success"){
        		this_element.parent().children('.buy-cart').remove();
        		if(this_element.parent().parent().children('.add')){
        			this_element.parent().parent().children('.add').remove();
        		}
        		if(this_element.parent().parent().children('.minus')){
        			this_element.parent().parent().children('.minus').remove();
        		}
        		this_element.parent().children().replaceWith('<div class="alert-danger" style="text-align: -webkit-center;" role="alert"> Deleted Successfully </div>');
        		$('#cart-count').text(data[1]);
        		update_buy_all();
        	}else{
        		this_element.parent().children()[1].remove();
        		this_element.parent().children().replaceWith('<div class="alert-danger" style="text-align: -webkit-center;" role="alert"> Error</div>');
        	}
        });
        update_buy_all();
        return false;
	})
	$('.buy-all-cart').click(function(){
		$(this).text('loading...');
		$(this).prop('disabled',true);
		var child = $('#modal-cart-body').children();
		$(child).each(function(i, obj) {
			if($(obj).children().children('.buy-cart').first().attr('class')){
				var this_element =$(obj).children().children('.buy-cart').first();
				var number = parseInt(this_element.parent().parent().children(".number-items").first().text().trim());
				buy_element(this_element,number);
			}
        });
		$('#modal-cart-body').children().remove();
		$('#modal-cart-body').append('<h3 class="form col-md-12 center-block text-decore" id="no-elements"> No elements in cart</h3>');
		$('#cart-modal').modal('toggle');
		$('.modal-backdrop').remove();
		$('.buy-all-cart').remove();
		$('.alerts').children().remove();
	    $('.alerts').append('<div class="alert alert-success" style="text-align: -webkit-center;" role="alert"> Projects have been Bought successfully</div>');    		
		return false;
	})
	function buy_element(element,number){
		var this_element = element; 
		var id = element.parent().parent().attr('id');
		id = id.substring(id.indexOf('-')+1);
		$.ajax({
        	type:'post',
        	url: "../../actions/buy_item.php", //sumbits it to the given url of the form
        	data: {id: id, number: number}
        }).success(function(data){
        	if(data[0]=="success"){
        		this_element.parent().children('.remove-cart').remove();
        		if(this_element.parent().parent().children('.add')){
        			this_element.parent().parent().children('.add').remove();
        		}
        		if(this_element.parent().parent().children('.minus')){
        			this_element.parent().parent().children('.minus').remove();
        		}
        		this_element.parent().children().replaceWith('<div class="alert-success" style="text-align: -webkit-center;" role="alert"> Bought Successfully Enjoy cheatting :)</div>');
        		$('#cart-count').text(data[1]);
        		if(parseInt(data[2]) == 0){
					$('.project-count-'+data[3]).text("Sold Out");
        		}else{
        			$('.project-count-'+data[3]).text(data[2] + " Available");
        		}

        		update_buy_all();
        	}else{
        		this_element.parent().children()[1].remove();
        		this_element.parent().children().replaceWith('<div class="alert-danger" style="text-align: -webkit-center;" role="alert"> Error</div>');
        	}
        });
        update_buy_all();
        return false;
	}
	$('.buy-cart').click(function() {
		var this_element =$(this);
		var number = parseInt(this_element.parent().parent().children(".number-items").first().text().trim());
		buy_element(this_element,number);
        return false;
	});
	$('form').submit(function() {
		if($(this).hasClass('cart') && !$('#project-'+$(this).attr('id')).hasClass('done')){
			$(this).parent().append("<img src= 'http://s11.postimg.org/wiw0ijxk3/loadinng.gif' class='image-load' style='margin-left: 30%;' >");
			var valuesToSubmit = $(this).serialize();
			$(this).hide();
			$.ajax({
	        	type:$(this).attr('method'),
	        	url: "../../actions/add_to_cart.php", //sumbits it to the given url of the form
	        	data: valuesToSubmit
	        }).success(function(data){
	        	if(data[0] == "success"){
	        		$('#cart-count').text(data[1]);
	        		$('.alerts').children().remove();
	        		$('.alerts').append('<div class="alert alert-success" style="text-align: -webkit-center;" role="alert"> Project has been added successfully to cart</div>');
	        		if($('#no-elements')){
	        			$('#no-elements').remove();
	        			$('#modal-cart-body').append(add_cart_element(data[2],data[3],data[4], data[5]));
	        			if(!$('#cart-footer').children().first().hasClass('buy-all-cart')){
	        				$('#cart-footer').prepend('<button class="btn btn-success btn-sm buy-all-cart" aria-hidden="true">Buy All</button>');
	        			}
	     //    			var tag = document.createElement("script");
						// tag.src = "../../js/shop-page.js";
						// document.getElementsByTagName("head")[0].appendChild(tag);
						refresh_scripts();
	        		}
	        	}else if(data[0] == "failure"){
	        		$('.alerts').children().remove();
	        		$('.alerts').append('<div class="alert alert-danger" style="text-align: -webkit-center;" role="alert"> You have already added the project to your cart </div>');
	        	}else{
	        		$('#login-alerts').children().remove();
	        		$('#login-alerts').append('<div class="alert alert-danger" style="text-align: -webkit-center;" role="alert"> Please Login First</div>');
	        		$('#login-dropdown').addClass('open');
	        	}
	        	
	        });
			//$.modal.close();
	        $('#project-'+$(this).attr('id')).hide();
	        $('#project-'+$(this).attr('id')).addClass('done');
	        // $(this).parent().parent().parent().parent().modal('toggle');
	        $('.image-load').remove();
	        $(this).show();
	        $('.modal-backdrop').remove();
	        refresh_scripts();
	  //       var tag = document.createElement("script");
			// tag.src = "../../js/shop-page.js";
			// document.getElementsByTagName("head")[0].appendChild(tag);
	        return false;
	        
		}else if($(this).attr('id') == 'login-nav'){
			$(this).parent().children().hide();
			$(this).parent().prepend("<img src= 'http://s11.postimg.org/wiw0ijxk3/loadinng.gif' class= 'login-load'>");
			var valuesToSubmit = $(this).serialize();
			$.ajax({
	        	type:$(this).attr('method'),
	        	url: "../../actions/login-user.php", //sumbits it to the given url of the form
	        	data: valuesToSubmit
	        }).success(function(data){
	        	if(data[0] == "success"){
	        		$('.alerts').children().remove();
	        		$('.alerts').append('<div class="alert alert-success" style="text-align: -webkit-center;" role="alert"> logged in successfully</div>');
	        		$('#login-list').replaceWith('<li id = "li-profile"><p class="navbar-text"><a href="../users/" >Profile</a></p></li><li id= "li-cart"><p class="navbar-text"><a href="#" data-toggle="modal" data-target="#cart-modal">Cart <span class="badge" id="cart-count">'+data[1]+'</span> </a></p></li>'+'<li id = "li-logout"><p class="navbar-text"><a href = "#" id = "logout-link" ><span class = "glyphicon glyphicon-log-out"> logout </span> </a></p></li>');
	        		$('#modal-cart-body').children().remove();
	        		if(data[1]>0){
	        			for(var i = 0; i<data[2].length;  i++){
	        				$('#modal-cart-body').append(add_cart_element(data[2][i]['cart_id'],data[2][i]['name'],data[2][i]['price'],data[2][i]['id']));
	        			}
	        		}else{
	        			$('#modal-cart-body').append('<h3 class="form col-md-12 center-block text-decore" id="no-elements"> No elements in cart</h3>');
	        		}
	        		$('#login-nav').parent().removeClass('open');
	        	}else{
	        		$('.login-load').remove();
	        		$('#login-alerts').children().remove();
	        		$('#login-alerts').append('<div class="alert alert-danger" style="text-align: -webkit-center;" role="alert"> Wrong Email or password</div>');
	        		$('#login-nav').parent().children().show();
	        	}
	        	refresh_scripts();
	   //      	var tag = document.createElement("script");
				// tag.src = "../../js/shop-page.js";
				// document.getElementsByTagName("head")[0].appendChild(tag);
		        return false;
	        });
	        return false;
		}

		
	})
	function showCourses(name){
		$('.courses').children().remove();
		$('.courses').append("<img src= 'http://s11.postimg.org/wiw0ijxk3/loadinng.gif' >");
		$.get( "../../actions/list_course.php?name="+name, function( data ) {
			$('.courses').children().remove();
			for(var i = 0; i<data.length; i++){
				$('.courses').append("<a href='#' class='course list-group-item'>"+data[i]['name']+"</a>");
			}
			// var tag = document.createElement("script");
			// tag.src = "../../js/shop-page.js";
			// document.getElementsByTagName("head")[0].appendChild(tag);
			refresh_scripts();
			
		});
	}
	function showProjects(university_name, course_name){
		var found = false;
		$('.projects').children().remove();
		$('.projects').append("<img src= 'http://s11.postimg.org/wiw0ijxk3/loadinng.gif' style='margin-left: 30%;' >");
		$.get( "../../actions/list_projects.php?university_name="+university_name+"&course_name="+course_name, function( data ) {
			if((data[0] === 0) && (data[1] === 0)){
				$('.projects').append("<h3 style='text-align: -webkit-center;'>No Projects here at this moment but we will post soon :) </h3>");
			}else{
				if(data[0] != 0){
					for(var i = 0; i<data[0].length; i++){
						if(data[0][i]['name'] == null){
							break;
						}else{
							found = true;
							var modal2 = "<div id='project-"+data[0][i]['id']+"' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button><h1 class='text-center'>"+data[0][i]['name']+"</h1></div><div class='modal-body'><span class='pull-right'><a href='#'>$ "+data[0][i]['price']+"</a></span><span><a href='#'>"+data[0][i]['count']+" Available</a></span><h3 class='form col-md-12 center-block text-decore'>"+data[0][i]['description']+"</h3><form  method='post' remote= 'true' class='cart' id="+data[0][i]['id']+"><input type='hidden' name='project_id' value="+data[0][i]['id']+"><input type='submit' name = 'submit' class='btn btn-primary btn-lg btn-block' value='Add To Cart'></form></div><div class='modal-footer'><div class='col-md-12'></div></div></div></div></div>"
							if(data[0][i]['image_link'] == null){
						 		$('.projects').append("<div class='col-sm-4 col-lg-4 col-md-4'><div class='thumbnail'><img src='http://placehold.it/320x150' alt=''><div class='caption'><h4 class='pull-right'> $"+data[0][i]['price']+"</h4><h4><a href='#' data-toggle='modal' data-target='#project-"+data[0][i]['id']+"'>"+data[0][i]['name'].substring(0,12)+"..."+"</a></h4><p>"+data[0][i]['description'].substring(0,63)+"..."+"</p></div><div class='ratings'><p class='pull-right'>"+data[0][i]['count'] +" Availabe</p><p><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span></p></div></div></div>"+modal2);
						 	}else{
						 		$('.projects').append("<div class='col-sm-4 col-lg-4 col-md-4'><div class='thumbnail'><img src='"+data[0][i]['image_link']+"' alt=''><div class='caption'><h4 class='pull-right'> $"+data[0][i]['price']+"</h4><h4><a href='#'data-toggle='modal' data-target='#project-"+data[0][i]['id']+"'>"+data[0][i]['name'].substring(0,12)+"..."+"</a></h4><p>"+data[0][i]['description'].substring(0,63)+"..."+"</p></div><div class='ratings'><p class='pull-right'>"+data[0][i]['count'] +" Availabe</p><p><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span></p></div></div></div>"+modal2);

						 	}
						}
						
					}
				}
				if(data[1] != 0){
					for(var i = 0; i<data[1].length; i++){
						if(data[1][i]['name'] == null){
							break;
						}else{
							found = true;
							var modal2 = "<div id='project-"+data[1][i]['id']+"' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button><h1 class='text-center'>"+data[1][i]['name']+"</h1></div><div class='modal-body'><span class='pull-right'><a href='#'>$ "+data[1][i]['price']+"</a></span><span><a href='#'>"+" Sold Out</a></span><h3 class='form col-md-12 center-block text-decore'>"+data[1][i]['description']+"</h3></div><div class='modal-footer'><div class='col-md-12'></div></div></div></div></div>"
							if(data[1][i]['image_link'] == null){
						 		$('.projects').append("<div class='col-sm-4 col-lg-4 col-md-4'><div class='thumbnail'><img src='http://placehold.it/320x150' alt=''><div class='caption'><h4 class='pull-right'> $"+data[1][i]['price']+"</h4><h4><a href='#' data-toggle='modal' data-target='#project-"+data[1][i]['id']+"'>"+data[1][i]['name'].substring(0,12)+"..."+"</a></h4><p>"+data[1][i]['description'].substring(0,63)+"..."+"</p></div><div class='ratings'><p class='pull-right'>"+" Sold Out</p><p><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span></p></div></div></div>"+modal2);
						 	}else{
						 		$('.projects').append("<div class='col-sm-4 col-lg-4 col-md-4'><div class='thumbnail'><img src='"+data[1][i]['image_link']+"' alt=''><div class='caption'><h4 class='pull-right'> $"+data[1][i]['price']+"</h4><h4><a href='#'data-toggle='modal' data-target='#project-"+data[1][i]['id']+"'>"+data[1][i]['name'].substring(0,12)+"..."+"</a></h4><p>"+data[1][i]['description'].substring(0,63)+"..."+"</p></div><div class='ratings'><p class='pull-right'>"+" Sold Out</p><p><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span></p></div></div></div>"+modal2);

						 	}
						}
						
					}
				}
				if(!found){
					$('.projects').append("<h3 style='text-align: -webkit-center;'>No Projects here at this moment but we will post soon :) </h3>");
				}
				
			}
			$('.projects').children().first().remove();
			// var tag = document.createElement("script");
			// tag.src = "../../js/shop-page.js";
			// document.getElementsByTagName("head")[0].appendChild(tag);
			refresh_scripts();
			
		});
	}
	function update_buy_all(){
		if(($('.buy-cart').length == 0 && $('.remove-cart').length == 0)){
			$('.buy-all-cart').remove();
		}
	}
	function refresh_scripts(){
		var tag = document.createElement("script");
		tag.src = "../../js/shop-page.js";
		document.getElementById("scripts-shops").appendChild(tag);
		$('#scripts-shops').children().first().remove();
	}
	function add_cart_element(cart_id,cart_name,cart_price, project_id){
		return '<li class="list-group-item" style="text-align: -webkit-center;" id ="cart-'+cart_id+'">'+cart_name+'( ' + cart_price+'$)<a href="#" class= "add" id = "add-'+project_id+'"><span class="glyphicon glyphicon-plus-sign pull-left" aria-hidden="true"></span></a><a href="#" class= "minus"><span class="glyphicon glyphicon-minus-sign pull-left" aria-hidden="true"></span></a><span class="badge pull-left number-items"> 1 </span>'+'<div class="btn-group pull-right" style="margin-top: -1%;"><button class="btn btn-success btn-sm buy-cart">BUY</button><button class="btn btn-danger btn-sm remove-cart">REMOVE</button></div></li>';
	}
});

