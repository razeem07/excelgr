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

	function galleryIds($wrap) {
		var raw = $wrap.find('input[type="hidden"]').val();
		return raw ? raw.split(',').filter(function (v) { return v !== ''; }) : [];
	}

	$(document).on('click', '.bleizure-select-gallery', function (e) {
		e.preventDefault();
		var $wrap = $(this).closest('.bleizure-gallery-field');
		var $input = $wrap.find('input[type="hidden"]');
		var $preview = $wrap.find('.bleizure-gallery-preview');

		var frame = wp.media({
			title: 'Add Images',
			multiple: true,
			library: { type: 'image' },
		});

		frame.on('select', function () {
			var selected = frame.state().get('selection').toJSON();
			var ids = galleryIds($wrap);

			selected.forEach(function (attachment) {
				var id = String(attachment.id);
				if (ids.indexOf(id) !== -1) {
					return; // already in the gallery, skip duplicate
				}
				ids.push(id);
				var thumb = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;
				$preview.append(
					'<div class="bleizure-gallery-item" data-id="' + id + '" style="position:relative;display:inline-block;">' +
						'<img src="' + thumb + '" style="width:80px;height:80px;object-fit:cover;" />' +
						'<button type="button" class="button-link bleizure-gallery-remove-item" style="position:absolute;top:-8px;right:-8px;background:#dc3232;color:#fff;border-radius:50%;width:20px;height:20px;line-height:18px;text-align:center;text-decoration:none;">&times;</button>' +
					'</div>'
				);
			});

			$input.val(ids.join(','));
		});

		frame.open();
	});

	$(document).on('click', '.bleizure-gallery-remove-item', function (e) {
		e.preventDefault();
		var $item = $(this).closest('.bleizure-gallery-item');
		var $wrap = $(this).closest('.bleizure-gallery-field');
		var id = String($item.data('id'));
		var ids = galleryIds($wrap).filter(function (v) { return v !== id; });
		$wrap.find('input[type="hidden"]').val(ids.join(','));
		$item.remove();
	});
});
