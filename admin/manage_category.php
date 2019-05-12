<?php
require_once('admin_navbar.php');
?>

<div class="container">
	<h2>Manage Categories</h2>
	<?php
        if(isset($_SESSION['successmsg'])){
            echo $_SESSION['successmsg'];
            unset($_SESSION['successmsg']);
        }
        elseif (isset($_SESSION['errormsg'])) {
            echo $_SESSION['errormsg'];
            unset($_SESSION['errormsg']);
        }
    ?>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">Search</span>
			<input type="text" name="search" id="search" class="form-control" placeholder="Enter Name To Search">
		</div>
	</div>
	<div class="modal fade" id="DeleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-product-title">Delete Category</h4>
				</div>
				<div class="modal-body">
					<form id="form-dinminder" method="post" action="adminactions.php">
						<div class="form-group">
								Are you sure, want to delete this Category?
						</div>
						<input type="hidden" id="deletecategoryId" name="videoId">
					</form>
				</div>
				<div class="modal-footer">
					<button id="btn-update-product " type="submit" id="update" class="btn btn-danger delete_category_btn">Delete Category</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="UpdateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-product-title">Update Category</h4>
				</div>
				<div class="modal-body">
					<form id="form-dinminder" >
						<div class="row">
							<div class="col-md-3 col-lg-3">Category Name</div>
							<div class="col-md-9 col-lg-9"><input type="text" placeholder="Enter Category Name" class="form-control selected_category_name"></div>
						</div>
						<input type="hidden" class="updatecategoryId" name="categoryId">
					</form>
				</div>
				<div class="modal-footer">
					<button id="btn-update-product " type="submit" id="update" class="btn btn-warning update_category_btn">Update Category</button>
				</div>
			</div>
		</div>
	</div>
	

	<div id="categoriestable">
	</div>
</div>
</div>
</body>
</html>