$(document).ready(function(){
	load_categories();
	load_videos();
	function load_categories(page){
		$.ajax({
			url:'adminactions.php',
			type:'POST',
			data:{
				load_table:'load_table',
				page:page
			},
			success:function(tabledata){
				$('#categoriestable').html(tabledata);
			}

		})
	}
	$(document).on('click','.categories_pagination_link',function(){
			var page=$(this).attr("id");
			load_categories(page);
	});
	function load_videos(page){
		$.ajax({
			url:'adminactions.php',
			type:'POST',
			data:{
				load_video_table:'load_video_table',
				page:page
			},
			success:function(tabledata){
				$('#videostable').html(tabledata);
			}

		})
	}
	$(document).on('click','.videos_pagination_link',function(){
		var page=$(this).attr("id");
		load_videos(page);
	});
	$(document).on('click','a[data-role=update_video]',function(){
		var id = $(this).attr('id');
		$.ajax({
			url:'adminactions.php',
			type:'POST',
			dataType:'json',
			data:{
				load_video_data:'load_video_data',
				id:id
			},
			success:function(response){
				$('.selected_video_name').val(response.zujji_type);
				$('.selected_video_category').val(response.zujji_category);
				$('.selected_videoId').val(response.id);
				$('.selected_embed_url').val(response.video_link);
				$('.video_preview').html(response.video_link);
				$('#UpdateVideoModal').modal('toggle');
			}
		})
	});
	$(document).on('click','a[data-role=update_category]',function(){
		var id = $(this).attr('id');
		$.ajax({
			url:'adminactions.php',
			type:'POST',
			dataType:'json',
			data:{
				load_category_data:'load_category_data',
				id:id
			},
			success:function(response){
				$('.selected_category_name').val(response.category_name);
				$('.updatecategoryId').val(id);
				$('#UpdateCategoryModal').modal('toggle');
			}
		})

	});
	$(document).on('click','a[data-role=delete_category]',function(){
		var id = $(this).attr('id');
		$('#deletecategoryId').val(id);
		$('#DeleteCategoryModal').modal('toggle');
	});
	$(document).on('click','.update_existing_video',function(){
		var video_name = $('.selected_video_name').val();
		var video_category = $('.selected_video_category').val();
		var video_id = $('.selected_videoId').val();
		var embed_url = $('.selected_embed_url').val();
		$.ajax({
			url:'adminactions.php',
			type:'POST',
			dataType:'json',
			data:{
				update_existing_video:'update_existing_video',
				video_name:video_name,
				video_category:video_category,
				video_id:video_id,
				embed_url:embed_url
			},
			success:function(response){
				location.reload();
			}

		});
	});
	$(document).on('click','.delete_video_btn',function(){
		var id = $("#videoId").val();
		// alert(id);
		$.ajax({
			url:"adminactions.php",
			type:"post",
			dataType:"json",
			data:{
				delete_video_data:'delete_video_data',
				id:id
			},
			success:function(response){
				location.reload();
			}
		})
	});
	$(document).on('click','.delete_category_btn',function(){
		var id = $("#deletecategoryId").val();
		$.ajax({
			url:"adminactions.php",
			type:"POST",
			dataType:"json",
			data:{
				delete_category_data:"delete_category_data",
				id:id
			},
			success:function(){
				location.reload()
			}
		})
	});
	$(document).on('click','.update_category_btn',function(){
		var id = $(".updatecategoryId").val();
		var category_name = $(".selected_category_name").val();
		$.ajax({
			url:"adminactions.php",
			type:"POST",
			dataType:"json",
			data:{
				update_selected_category:"update_selected_category",
				id:id,
				category_name:category_name
			},
			success:function(response){
				location.reload();
			}
		})
	})
});
