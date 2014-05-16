
// Wait for DOM to be ready!
$(document).ready(function(){
	$.ajax({
		// Get all movies from our database.
    url:"movies/getallmovies",
		dataType:"json",
		cache: false,
		// If successfull, run our renderData function and send the data (a JSON-object) to it.
    success:function (data) {
			renderData(data);
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
			'<li class="slide"><img id="' + movies[i].link + '" src="http://img.youtube.com/vi/' + movies[i].link + '/maxresdefault.jpg" width="100%" height="400px"></li>'
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
		$('#bx-pager').append(
			'<a id="' + movies[i].machinetitle + '" data-slide-index="'+i+'" href=""><p class="title">'+ movies[i].title +' <span class="author">Av '+movies[i].author+'</p> </a>'
		);

		//When link is clicked load description
		loadDescriptionOnLinkClick(movies[i].machinetitle);
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
		$('html, body').animate({
			scrollTop: $( $(this).attr('href') ).offset().top
		}, 600);
		return false;
	});
}

function loadDescriptionOnLinkClick(machineTitle){

	$('#' + machineTitle).click(function(){

		var description = 'Den här filmen har en beskrivning. Punkt.';		
		var movieTitle = $(this).attr('id');

		$.ajax({
			// Get all movies from our database.
		    url:"movies/getmovie/" + movieTitle,
				dataType:"json",
				cache: false,
			// If successfull, run our renderData function and send the data (a JSON-object) to it.
		    success:function (data) {
				console.log(data);
				$('#information').html('<p>' + data[0]['description'] + '</p>');
			},
		    // If error.
			error:function(errorData) {
				console.log("There seems to be an error fetching the data." + errorData.error);
				$('#information').html('<p>Ingen beskrivning hittades</p>');
			}
		});	
	});
}