$(document).ready(function(){
	
	ajax_enable = true;
	$(document).on('click', 'a', function(event) {
		if( ajax_enable){
			ajax_enable = false;
			// change styling for navigation links
			if($(this).hasClass('qa-nav-main-link')){
				$('.qa-nav-main-selected').toggleClass( 'qa-nav-main-selected' );
				$(this).toggleClass('qa-nav-main-selected');
			}else if($(this).hasClass('qa-nav-sub-link')){ 
				$('.qa-nav-sub-selected').toggleClass( 'qa-nav-sub-selected' );
				$(this).toggleClass('qa-nav-sub-selected');
			}
			
			var a_href = $(this).attr('href');
			// Check is link is internal
			if(a_href.match("^./") || a_href.match("^../")){
				// Check if page can be loaded using ajax - normal redirect for links like social login,...
				parts = a_href.split('/'); 
				
				var clean_parts = parts.filter(function(elem){
					return (!(elem == '..' || elem == '.'));
				});
				
				p_url = clean_parts.join('/');

				$( apl_container ).css( "opacity", "0.19" );
				// get page content
				$.ajax({
					url: apl_url + 'ajax-main.php',
					data: { url: p_url, qa_root:qa_root },
					type: "POST"
				}).done(function(data) {
					$(apl_container).html( data );
					ajax_enable = true;
					$( apl_container ).css( "opacity", "1" );
					// set browser url bar
					if(p_url!=window.location){
						window.history.pushState({path:apl_home_url+p_url},'',apl_home_url+p_url);
					}

				}).fail(function(ajaxContext ) {
					// in case of error, redirect to page
					window.location = a_href;
				});
				event.preventDefault();
			}
		}
	});
	
	// back & forward buttons
	window.addEventListener("popstate", function(e) {
		// URL location
		var location = String(document.location);
		// if it was internal page
		if( location.substring(0, apl_home_url.length) == apl_home_url){
			a_href = location.substring(apl_home_url.length, location.length);
			// ajax load internal page
			parts = a_href.split('/'); 
			var clean_parts = parts.filter(function(elem){
				return (!(elem == '..' || elem == '.'));
			});
			
			p_url = clean_parts.join('/');

			$( apl_container ).css( "opacity", "0.19" );
			// get page content
			$.ajax({
				url: apl_url + 'ajax-main.php',
				data: { url: p_url, qa_root:qa_root },
				type: "POST"
			}).done(function(data) {
				$(apl_container).html( data );
				ajax_enable = true;
				$( apl_container ).css( "opacity", "1" );
				// selecting active item in navigation menu  
					// because class name for some pages is different
					if(p_url=='tags')
						p_url='tag';
					else if(p_url=='users')
						p_url='user';
				if($('.qa-nav-main-'+p_url).length){
					$('.qa-nav-main-selected').toggleClass( 'qa-nav-main-selected' );
					$('.qa-nav-main-'+p_url).toggleClass('qa-nav-main-selected');
				}else if($('.qa-nav-sub-'+p_url).length){ 
					$('.qa-nav-sub-selected').toggleClass( 'qa-nav-sub-selected' );
					$('.qa-nav-sub-'+p_url).toggleClass('qa-nav-main-selected');
				}

			}).fail(function(ajaxContext ) {
				// in case of error, redirect to page
				window.location.replace(a_href);
			});
		}else{
			// go back/forward to an external page
			window.location.replace(location);
		}	
	});

});