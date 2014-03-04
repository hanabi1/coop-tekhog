
$(document).ready(function(){
	/*$.getJSON ("application/controller/movies.php", processData);
	function processData (data){
		console.log(data);

	};*/
	
	$.ajax({
		url:"movies/getallmovies",
		dataType:"json",
		cache: false,
		success:function (data) {
			renderData(data);
		},
		error:function() {
			console.log('feeeeeeeeeeeeeeeeeeeeeeeeeeel');
		}
	})



});

function renderData (movies) {
	for (var i = 0;i < movies.length;i++) {
		console.log(movies[i].id)
		$('.bxslider').append(
			'<li class="slide"><iframe width="560" height="315" src="'+movies[i].link+'"frameborder="0" allowfullscreen></iframe></li>'
		)
		$('#bx-pager').append(
			'<a data-slide-index="'+i+'" href=""><p>'+ movies[i].title+'</p> </a>'
		)
	};
	videoSlider();
}

function videoSlider(){
	$('.bxslider').bxSlider({
		video: true,
		useCSS: false,
		pagerCustom: '#bx-pager'
	});
}