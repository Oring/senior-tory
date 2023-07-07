jQuery(document).ready(function($){

	var delSidebar = '<div class="delete-sidebar">delete</div>';

	jQuery('.sidebar-hometory_custom_sidebar').find('.sidebar-name-arrow').before(delSidebar);

	jQuery('.delete-sidebar').click(function(){

		var confirmIt = confirm('Are you sure?');

		if(!confirmIt) return;

		var widgetBlock = jQuery(this).parent().parent();

		var data =  {
			'action':'hometory_delete_sidebar',
			'hometory_sidebar_name': jQuery(this).parent().find('h2').text()
		};

		widgetBlock.hide();

		jQuery.ajax({
			url: ajaxurl,
			data: data,
			success: function(response){
				widgetBlock.remove();
			},
			error: function(data) {
				alert('Error while deleting sidebar');
				widgetBlock.show();
			}
		});
	});

});