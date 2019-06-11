jQuery(document).ready(function($){
	
	// On load, get value in chooser and show only those cards
	showCardsOfType($('#shop_type_current').data('acfname'));

	$(function() {

		$('.shop_directory_option').click(function() {
			// Do nothing if we're already looking at this shop type
			if ($(this).html() == $('#shop_type_current').html()) {return false;}

			// Else hide all shop types and turn on only the selected type
			else {
				// Shared function for hiding, then displaying cards
				showCardsOfType($(this).data('acfname'));
				
				// Removed selected state from all drop-down options and add it to chosen
				$('.shop_directory_option').removeClass('shop_directory_selected');
				$(this).addClass('shop_directory_selected');
				
				// Change the Section Heading
				$('#shop_type_current').html($(this).html());

				// Now Hide the Drop-down
				$('#shop_directory_options').toggle();
			}
		})
		
		$('#shop_directory_dropdown').click(function() {
			// Hide/Unhide drop-down if touched
			$('#shop_directory_options').toggle();
		})
		
		$('.shop_directory_container').click(function() {
			// Go to this shop
			location.href=$(this).data('link')
		})
		
	});

	function showCardsOfType(tag) {
		if (tag == 'all') {
			// Remove hidden class from all cards
			$('.shop_directory_container').removeClass('shop_card_hidden');
		}
		else {
			// Hide all cards and then show cards that are of the selected type
			$('.shop_directory_container').addClass('shop_card_hidden');
			$('.shop_card_'+tag).removeClass('shop_card_hidden');
		}
	}

});

