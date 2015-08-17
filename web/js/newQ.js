
	$(function() {

		$('#modalButton').click(function() {
			$('#modal').modal('show')
				.find('#modalContent')
				.load($(this).attr('value'));
		})

		/*$('#grafic tr[class]').each(function() {
			$(this).find('td:first').append(
				$('<div class="icon '+$(this).attr('class')+'Icon"></div>').css({opacity: 0}).animate({opacity: 1}, 750)
			)
		})*/

	})