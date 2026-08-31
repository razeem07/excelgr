jQuery(function ($) {
	'use strict';

	$(document).on('click', '.bleizure-select-image', function (e) {
		e.preventDefault();
		var $wrap = $(this).closest('.bleizure-image-field');
		var $input = $wrap.find('input[type="hidden"]');
		var $preview = $wrap.find('.bleizure-preview');
		var $remove = $wrap.find('.bleizure-remove-image');

		var frame = wp.media({
			title: 'Select Image',
			multiple: false,
			library: { type: 'image' },
		});

		frame.on('select', function () {
			var attachment = frame.state().get('selection').first().toJSON();
			$input.val(attachment.id);
			var thumb = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;
			$preview.html('<img src="' + thumb + '" style="max-width:120px;height:auto;display:block;" />');
			$remove.show();
		});

		frame.open();
	});

	$(document).on('click', '.bleizure-remove-image', function (e) {
		e.preventDefault();
		var $wrap = $(this).closest('.bleizure-image-field');
		$wrap.find('input[type="hidden"]').val('');
		$wrap.find('.bleizure-preview').empty();
		$(this).hide();
	});
});
