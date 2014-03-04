
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
			console.log(data,'ajaaaaaaaaaaaxanrop');
		},
		error:function() {
			console.log('feeeeeeeeeeeeeeeeeeeeeeeeeeel');
		}
	})




  $('.bxslider').bxSlider({
	video: true,
	useCSS: false,
	pagerCustom: '#bx-pager'
  });
});
