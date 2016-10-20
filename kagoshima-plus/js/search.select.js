jQuery(document).ready(function($){
	$(".box-select").on("click", function() {
        $(this).next().slideToggle();
        $(this).toggleClass("search-on");
    });
});