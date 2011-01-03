(function ($) {
	$(document).ready(function () {	
		$('body').prepend('<div id="fb-root"></div>');
	
		window.fbAsyncInit = function() {
			FB.init({
				appId: FACEBOOK_APP_ID, 
				status: true, 
				cookie: true,
		       	xfbml: true
		  	});
		};
	
		(function() {
			var e = document.createElement('script'); e.async = true;
	    	e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
	    	document.getElementById('fb-root').appendChild(e);
	  	}());
	});  	
}(jQuery));	