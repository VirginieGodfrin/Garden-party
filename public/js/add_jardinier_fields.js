$(document).ready(function(){
	console.log("hello add_jardinier_fields");
	var $addJardinier = $('.js-add-jardinier');
	var $jardinierFieldTarget = $('.js-jardinier-field-target');
	var $mangeurButton = $('.js-add-mangeur-button');
	console.log($addJardinier);
	console.log($jardinierFieldTarget);
	console.log($mangeurButton);

	$addJardinier.change(function() {
		console.log("addJardinnier change action ");
		var $form = $(this).closest('form');
		var url = $(this).data('url');
		var type = $form.attr('method');
		var data = {};
		data[$(this).attr('name')] = $(this).val();
		console.log($form);
		console.log(url);
		console.log(type);
		console.log(data);
		
		$.ajax({
			url : url,
			type: type,
			data : data,
			success: function(html) {
				console.log("succes");
				console.log(html);
				if (!html) {
					$jardinierFieldTarget.find('select').remove(); 
					return; 
				}
				$jardinierFieldTarget.html(html);
				$bandButton.hide(1000);
			}
		});
	});
});