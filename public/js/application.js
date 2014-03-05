
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
		console.log(movies[i].id);
		// Add the movie links to our div with class bxslider.

		$('.bxslider').append(
			'<li class="slide"><iframe width="560" height="315" src="'+ movies[i].link +'"frameborder="0" allowfullscreen></iframe></li>'
		);
		// Add the titles+author to div with ID bx-pager.
		$('#bx-pager').append(
			'<a data-slide-index="'+i+'" href=""><p class="title">'+ movies[i].title +' <span class="author">Av '+movies[i].author+'</p> </a>'
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
		$('html, body').animate({
			scrollTop: $( $(this).attr('href') ).offset().top
		}, 600);
		return false;
	});
}