
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
			
			//Gets the machineTitle from the link
			var machineTitle = getMachineTitleFromLink();
		
			//Loads the description from the Machine Title
			loadDescription(machineTitle);	

			//Load Contact Details
			loadContactDetails();
		},
    // If error.
		error:function(errorData) {
			console.log("There seems to be an error fetching the data." + errorData.error);
		}
	});
});


function renderData (movies) {
  // Loop to add stuff from JSON-data (movies variable) to the DOM.
	for (var i = 0;i < movies.length;i++) {
		
		// Add only the thumbnail (not the actuall movie) to our div with class bxslider.
		$('.bxslider').append(
			
			// We give the thumbnail img a #id that is the same as the Youtube ID.
			'<li class="slide"><img id="' + movies[i].link + '" class="video-thumbnail" src="http://img.youtube.com/vi/' + movies[i].link + '/maxresdefault.jpg"></li>'
		);
		
		//When the thumbnail is clicked...
		//The thumbnails id looks like this after concatenation: #4Vvd875V (hashtag + YouTube ID)
		$('#' + movies[i].link).click(function(){
			
			//The movies variable in renderData() is no longer available when this thumbnail is clicked.
			//So we get the Youtube video ID from the ID Hashtag instead of the movie variable! 
			var videoID = $(this).attr('id');
			
			//(this). returns the <img> that was clicked. We cant put the video into the image....
			//So we replace the content in the parent of <img> ie the <li>!
			$(this).parent().html('<iframe width="100%" height="400px" src="//www.youtube.com/embed/'+ videoID +'?modestbranding=1;autoplay=1" frameborder="0" allowfullscreen></iframe>');
			
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
	console.log('loadDescription got param data: ' + machineTitle )

	var description = '<p>Ingen beskrivning hittades</p>';		

	$.ajax({
		// Get all movies from our database.
	    url:"movies/getmovie/" + machineTitle,
			dataType:"json",
			cache: false,
		// If successfull, run our renderData function and send the data (a JSON-object) to it.
	    success:function (data) {
	    	//If ajax call was successfull but no/wrong data was returned show error
	    	if(typeof data[0] === 'undefined' || !data[0]){
		    	$('#information > p').fadeOut(function(){
					$('#information > p').html('<p style="display:none">Ingen beskrivning hittades</p>');
					$('#information > p').fadeIn();		    		
		    	})	
	    	//Everything good! Show description
	    	}else{
		    	$('#information > p').fadeOut(function(){
					$('#information').html('<p style="display:none">' + data[0]['description'] + '</p>');
					$('#information > p').fadeIn();		    		
		    	})
	    	}	
		},
	    // If error.
		error:function(errorData) {
			console.log("There seems to be an error fetching the description. " + errorData.error);
	    	$('#information > p').fadeOut(function(){
				$('#information > p').html('<p style="display:none">Ingen beskrivning hittades</p>');
				$('#information > p').fadeIn();		    		
	    	})			
		}
	});	
}

function loadContactDetails(){
	$.ajax({
		// Get all movies from our database.
	    url:"http://gdata.youtube.com/feeds/api/playlists/9tY0BWXOZFvWi6WNdcokF_YvXUxyESRW?v=2&alt=json",
			dataType:"json",
			cache: false,
		// If successfull, run our renderData function and send the data (a JSON-object) to it.
	    success:function (data) {
	    	//If ajax call was successfull but no/wrong data was returned show error
	    	if(typeof data['feed']['media$group']['media$description']['$t'] === 'undefined' || !data['feed']['media$group']['media$description']['$t']){
		    	$('#contact > p').fadeOut(function(){
					$('#contact > p').text('Ingen kontaktinformation hittades');
					$('#contact > p').fadeIn();		    		
		    	})	
	    	//Everything good! Show Contact Details
	    	}else{
		    	$('#contact > p').fadeOut(function(){
					$('#contact > p').text(data['feed']['media$group']['media$description']['$t']);
					$('#contact > p').fadeIn();		    		
		    	})
	    	}	
		},
	    // If error.
		error:function(errorData) {
			console.log("There seems to be an error fetching the contact details. " + errorData.error);
	    	$('#contact > p').fadeOut(function(){
				$('#contact > p').text('Ingen kontaktinformation hittades');
				$('#contact > p').fadeIn();		    		
	    	})			
		}
	});	
}


//Returns the YoutubeID of the video currently visible in the slider. 
function getMachineTitleFromLink(){
	/*Broken since link no longer get the .active class*/
	return $('#bx-pager > a.active').attr('id');
}
