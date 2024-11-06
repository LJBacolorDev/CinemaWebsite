<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <br><br><br>
	<div class="row">
		<div class="col-sm-4">
			<h3 class="text-center">User Details</h3><br>
			<?php
		    	if(validation_errors()){
		    		?>
		    		<div class="alert alert-info text-center">
		    			<?php echo validation_errors(); ?>
		    		</div>
		    		<?php
		    	}
 
				if($this->session->flashdata('message')){
					?>
					<div class="alert alert-info text-center">
						<?php echo $this->session->flashdata('message'); ?>
					</div>
					<?php
					unset($_SESSION['message']);
				}	
		    ?>
			<?php echo form_open_multipart('admin/users'); ?>
				<?php
					if(isset($_SESSION['user'])){
						echo "<h4>USER ID: ". $_SESSION['user']['UserID'] ."</h4><br>";
					}
				?>
				<div class="form-group">
                    <label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_SESSION['user'])) echo $_SESSION['user']['Email']?>">
				</div>
                <div class="form-group">
                    <label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" value="<?php if(isset($_SESSION['user'])) echo $_SESSION['user']['Password']?>">
				</div>
                <div class="form-group">
                    <label for="name">Name:</label>
					<input type="text" class="form-control" id="name" name="name" value="<?php if(isset($_SESSION['user'])) echo $_SESSION['user']['Name']?>">
				</div>
                <label>Position:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="position" id="position" value="user" <?php if(isset($_SESSION['user'])){if($_SESSION['user']['Position'] == 'user'){echo 'checked';}} ?>>
                    <label class="form-check-label">
                        User
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="position" id="position" value="admin" <?php if(isset($_SESSION['user'])){if($_SESSION['user']['Position'] == 'admin'){echo 'checked';}} ?>>
                    <label class="form-check-label">
                        Admin
                    </label>
                </div>
                <br>

				<?php if(!isset($_SESSION['user'])) { ?>
                <div class="row justify-content-center">
				    <button type="submit" name="action" value="add" class="btn btn-secondary">Add User</button>
                </div><br>
				<?php }else{?>
				<div class="row justify-content-center">
                    <button type="submit" name="action" value="clear" class="btn btn-secondary">Clear</button>
                </div><br>
                <div class="row justify-content-center">
                    <button type="submit" name="action" value="update" class="btn btn-secondary">Update User</button>
                </div><br>
                <div class="row justify-content-center">
                    <button type="submit" name="action" value="delete" class="btn btn-secondary">Delete User</button>
                </div>
				<?php } ?>
			</form>
		</div>
		<div class="col-sm-8">
			<h3 class="text-center">Users</h3><br>
			<form action="<?php echo base_url()?>admin/users/view" method="post">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Row</th>
						<th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
						<th>Position</th>
                        <th>Code</th>
                        <th>Active</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($users as $row){
						?>
						<tr>
							<td><input type="radio" name="id" value="<?php echo $row->UserID; ?>" required></td>
							<td><?php echo $row->UserID; ?></td>
                            <td><?php echo $row->Name; ?></td>
							<td><?php echo $row->Email; ?></td>
							<td><?php echo $row->Position; ?></td>
							<td><?php echo $row->VerificationCode; ?></td>
                            <td><?php echo $row->Active ? 'True' : 'False'; ?></td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>
			<div class="row justify-content-center">
				<p><?php echo $links; ?></p>
            </div><br>
			<div class="row justify-content-center">
				<button type="submit" class="btn btn-secondary">View User</button>
			</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>