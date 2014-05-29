
// Wait for DOM to be ready!
$(document).ready(function(){
	$.ajax({
		// Get all movies from our database.
    url:"movies/getallmovies",
		dataType:"json",
		cache: false,
		// If successfull, run our renderData function and send the data (a JSON-object) to it.
    success:function (data) {
    		//Adds the movies to the slider
    		//Adds the links
			renderData(data);
			
			//Load Contact Details
			loadProjectInformation();

			//Loads the facebook page events
			loadEvents();
		},
    // If error.
		error:function(errorData) {
			console.log("There seems to be an error fetching the data." + errorData.error);
		}
	});
});


function renderData (movies) {
  // Loop to add stuff from JSON-data (movies variable) to the DOM.

	//Loads the description from the Machine Title
	loadDescription(movies[0]['machinetitle']);

	for (var i = 0;i < movies.length;i++) {
		
		// Add only the thumbnail (not the actuall movie) to our div with class bxslider.
		$('.bxslider').append(
			
			// We give the thumbnail img a #id that is the same as the Youtube ID.
			'<li class="slide"><img id="' + movies[i].link + '" class="video-thumbnail" src="http://img.youtube.com/vi/' + movies[i].link + '/maxresdefault.jpg" onload="checkAndFixMissingImg(this)"></li>'

		);
		
		//When the thumbnail is clicked...
		//The thumbnails id looks like this after concatenation: #4Vvd875V (hashtag + YouTube ID)
		$('#' + movies[i].link).click(function(){
			
			//The movies variable in renderData() is no longer available when this thumbnail is clicked.
			//So we get the Youtube video ID from the ID Hashtag instead of the movie variable! 
			var videoID = $(this).attr('id');
			
			//(this). returns the <img> that was clicked. We cant put the video into the image....
			//So we replace the content in the parent of <img> ie the <li>!
			$(this).parent().html('<iframe id="' + videoID +'"class="video-player" width="100%" height="600px" src="//www.youtube.com/embed/'+ videoID +'?modestbranding=1;autoplay=1" frameborder="0" allowfullscreen></iframe>');
			
		});
		// Add the titles+author to div with ID bx-pager.
		/* The best solution but the jQuery slider doesn't allow us to change the DOM structure links live in
		if(i < 5) {

			$('.left-column').append(
				'<a id="' + movies[i].machinetitle + '" data-slide-index="'+i+'" href=""><p class="title">'+ movies[i].title +' <span class="author">Av '+movies[i].author+'</p> </a>'
			);
     	}else{ 
     
			$('.right-column').append(
				'<a id="' + movies[i].machinetitle + '" data-slide-index="'+i+'" href=""><p class="title">'+ movies[i].title +' <span class="author">Av '+movies[i].author+'</p> </a>'
			);
    	}
    	*/

    	/*So were forced to work in a single div instead of a two column div system*/
    	$('#bx-pager').append(
			'<a id="' + movies[i].machinetitle + '" data-slide-index="'+i+'" href=""><p class="title">'+ movies[i].title +' <span class="author">Av '+movies[i].author+'</p> </a>'
		);

	};

	videoSlider();
	clickhandler();
}

// Activate the videoslider. This has to be done after the videos has been added to our DOM.
function videoSlider(){
	$('.bxslider').bxSlider({
		video: true,
		useCSS: false,
		pagerCustom: '#bx-pager'
	});
}
// makes the anchor scroll on the page smooth as silk
function clickhandler () {
	$('a').click(function(){
		
		//Get the movie title from the links ID and call loadDescription()
		var machineTitle = $(this).attr('id')
		loadDescription(machineTitle);
		
		//Reset all playing movies on slide change
		resetVideoPlayersToThumbnails();
		
		//Slide the correct movie into place
		$('html, body').animate({
			scrollTop: $( $(this).attr('href') ).offset().top
		}, 600);

		

		return false;
	});
}

//Loads the correct description and fades it in
function loadDescription(machineTitle){

	if(typeof machineTitle === 'undefined' || !machineTitle){
		return false;
	}

	$.ajax({
		// Get all movies from our database.
	    url:"movies/getmovie/" + machineTitle,
			dataType:"json",
			cache: false,
		// If successfull, run our renderData function and send the data (a JSON-object) to it.
	    success:function (data) {
	    	//If ajax call was successfull but no/wrong data was returned show error
	    	if(typeof data[0]['description'] === 'undefined' || !data[0]['description']){
		    	$('#moviedescription > p').fadeOut(function(){
					$('#moviedescription > p').text('Ingen info finns');
					$('#moviedescription > p').fadeIn();		    		
		    	})	
	    	//Everything good! Show description
	    	}else{
		    	$('#moviedescription > p').fadeOut(function(){
					$('#moviedescription > p').text(data[0]['description']);
					$('#moviedescription > p').fadeIn();		    		
		    	})
	    	}	
		},
	    // If error.
		error:function(errorData) {
			console.log("There seems to be an error fetching the description. " + errorData.error);
	    	$('#moviedescription > p').fadeOut(function(){
				$('#moviedescription > p').text('Ingen beskrivning hittades');
				$('#moviedescription > p').fadeIn();		    		
	    	})			
		}
	});	
}

//Loads the correct description and fades it in
function loadEvents(){

	$.ajax({
		// Get all movies from our database.
	    url:"movies/getmovieevents/",
			dataType:"json",
			cache: false,
		// If successfull, run our renderData function and send the data (a JSON-object) to it.
	    success:function (data) {
	    	//If ajax call was successfull but no/wrong data was returned show error
	    	if(typeof data === 'undefined' || !data){
		    	$('#eventbox').fadeOut(function(){
					$('#eventbox > p').text('Evenemangen kommer snart');
					$('#eventbox > p').fadeIn();		    		
		    	})	
	    	//Everything good! Show description
	    	}else{

				//If we have more then one event we need to create rows with two columns
				//and place the events divs in them.
				if(data.length > 1){
					var rowNbr = 0;
					for(var i=0;i<data.length;i++){
						
						//If there is a end_time add a little formatting to it
						if(data[i]['end_time']){
							data[i]['end_time'] = ' - ' + data[i]['end_time'];
						}

						var paragraph = '<h4><a href="http://www.facebook.com/events/' + data[i]['eid'] +'" title="' +data[i]['name'] + '">' + data[i]['name'] + '</a></h4><br>' + 
										'<small>' + data[i]['start_date'] + ' ' + data[i]['start_time'] + data[i]['end_time'] + '</small><br>' +
										'<small>' + data[i]['location'] + '</small><br><br>' +
										'<br><p><a href="http://www.facebook.com/events/' + data[i]['eid'] +'" title="' + data[i]['name'] + '"><strong>Länk till Eventet</strong>' + '</a></p>'

						var alignment = '';

						//when i is even send the div to the right
						//when i is odd send it to the left			
						if(i % 2 == 0){
							
							alignment = 'event-left';
							
							rowNbr += 1;
							
							//Create a new row for two events
							$('#eventbox').append('<div class="row-' + rowNbr +'" style="display:none;"></div>');
						
						}else{
							alignment = 'event-right';
						}
						
						//Create the eventdiv with the proper allignment and the event paragraph
						var eventDiv = '<div class="' + alignment + '">' + paragraph + '</div>';

				




						//Appends the eventdiv the the current row
						$('#eventbox > .row-' + rowNbr).append(eventDiv).fadeIn();
					}

				//We only have one event so we just center it. Easy =)
				}else{
						//If there is a end_time add a little formatting to it
						if(data[0]['end_time']){
							data[0]['end_time'] = ' - ' + data[0]['end_time'];
						}
	
						var paragraph = '<h4><a href="http://www.facebook.com/events/' + data[0]['eid'] +'" title="' +data[0]['name'] + '">' + data[0]['name'] + '</a></h4><br>' + 
										'<small>' + data[0]['start_date'] + ' ' + data[0]['start_time'] + data[0]['end_time'] + '</small><br>' +
										'<small>' + data[0]['location'] + '</small><br><br>' +
										'<br><p><a href="http://www.facebook.com/events/' + data[0]['eid'] +'" title="' + data[0]['name'] + '"><strong>Länk till Eventet</strong>' + '</a></p>'					
					
					$('#eventbox').append('<div style="display:none;"></div')
					$('#eventbox > div').append(paragraph).fadeIn();
				}   		

	    	}	
		},
	    // If error.
		error:function(errorData) {
			console.log("There seems to be an error fetching the event list. " + errorData.error);
	    	$('#eventbox > p').fadeOut(function(){
				$('#eventbox > p').text('Evenemangen kommer snart');
				$('#eventbox > p').fadeIn();		    		
	    	})			
		}
	});	
}

function loadProjectInformation(){
	$.ajax({
		// Get all movies from our database.
	    url:"http://gdata.youtube.com/feeds/api/playlists/SwXUlPkaY_FZ7R9AsTo1yJi7wRthcBtx?v=2&alt=json",
			dataType:"json",
			cache: false,
		// If successfull, run our renderData function and send the data (a JSON-object) to it.
	    success:function (data) {
	    	//If ajax call was successfull but no/wrong data was returned show error
	    	if(typeof data['feed']['media$group']['media$description']['$t'] === 'undefined' || !data['feed']['media$group']['media$description']['$t']){
		    	$('#information > p').fadeOut(function(){
					$('#information > p').text('Ingen beskrivning hittades');
					$('#information > p').fadeIn();		    		
		    	})	
	    	//Everything good! Show Contact Details
	    	}else{
		    	$('#information > p').fadeOut(function(){
					$('#information > p').html(data['feed']['media$group']['media$description']['$t']);
					$('#information > p').fadeIn();		    		
		    	})
	    	}	
		},
	    // If error.
		error:function(errorData) {
			console.log("There seems to be an error fetching the project details. " + errorData.error);
	    	$('#information > p').fadeOut(function(){
				$('#information > p').text('Ingen beskrivning hittades');
				$('#information > p').fadeIn();		    		
	    	})			
		}
	});	
}


//Returns the YoutubeID of the video currently visible in the slider. 
function getMachineTitleFromLink(){
	/*Broken since link no longer get the .active class*/
	return $('#bx-pager > a.active').attr('id');
}

function resetVideoPlayersToThumbnails(){


	//If we find any iframes with the class .videolpayer then we switch 'em to images again!
	var videoID = $('.video-player').attr('id');
	
	if(videoID){

		//Transform our youtubevideo into a thumbnail image again
		$('.video-player').parent().html('<img id="' + videoID + '" class="video-thumbnail" src="http://img.youtube.com/vi/' + videoID + '/maxresdefault.jpg" onload="checkAndFixMissingImg(this)">');
		
		//Rebind the clickhandler so that if we click on our thumbnail again. It will be a youtube movie
		$('#' + videoID).click(function(){
		
			//The movies variable in renderData() is no longer available when this thumbnail is clicked.
			//So we get the Youtube video ID from the ID Hashtag instead of the movie variable! 
			var videoID = $(this).attr('id');
			
			//(this). returns the <img> that was clicked. We cant put the video into the image....
			//So we replace the content in the parent of <img> ie the <li>!
			$(this).parent().html('<iframe id="' + videoID +'"class="video-player" width="100%" height="600px" src="//www.youtube.com/embed/'+ videoID +'?modestbranding=1&autoplay=1&enablejsapi=1&playerapiid=ytplayer" frameborder="0" allowfullscreen></iframe>');
		});
	}
}

function checkAndFixMissingImg(img){
	if(!img){
		console.log('Nothing passed to checkAndFixMissingImg');
		return;
	}
	//the 404 image size is 120*40. If we find one try a lower resolution 
	img.onload = '';
	if(img.naturalHeight == 90 && img.naturalWidth == 120){
		console.log(img.id + 'didnt have the specified thumbnail resolution, trying with lower res version');
		img.src = 'http://img.youtube.com/vi/' + img.id + '/hqdefault.jpg';
		img.className = 'small-thumbnail';
	}
}