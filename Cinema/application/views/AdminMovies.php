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
			<h3 class="text-center">Movie Details</h3><br>
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
			<?php echo form_open_multipart('admin/movies'); ?>
				<?php
					if(isset($_SESSION['MovieID'])){
						echo "<h4>Movie ID: ". $_SESSION['MovieID'] ."</h4><br>";
					}
				?>
				<div class="form-group">
                    <label for="title">Title:</label>
					<input type="text" class="form-control" id="title" name="title" value="<?php if(isset($_SESSION['MovieID'])) echo $_SESSION['Title']?>">
				</div>
				<?php if(!isset($_SESSION['MovieID'])) { ?>
                <div class="form-group">
					<label for="poster">Poster:</label>
                    <input type="file" class="form-control-file" id="poster" name="poster" value="">
                </div>
				<?php }else{?>
					<label>Poster:</label>
					<div class="row justify-content-center">
						
						<img src="<?php echo 'http://localhost/FINALS/uploads/'.$_SESSION['Poster']; ?>" alt="<?php base_url('uploads/'.$_SESSION['Poster']); ?>" height = 200px width=100px/>
					</div>
				<?php } ?>
				<div class="form-group">
                    <label for="description">Description:</label>
					<textarea class="form-control" id="description" name="description" rows="3"><?php if(isset($_SESSION['MovieID'])) echo $_SESSION['Description']?></textarea>
				</div>
                <div class="form-group">
                    <label for="date">Date:</label>
					<input type="date" class="form-control" id="date" name="date" value="<?php if(isset($_SESSION['MovieID'])) echo $_SESSION['Date']?>">
				</div>
                <div class="form-group">
                    <label for="cost">Cost:</label>
					<input type="number" class="form-control" id="cost" name="cost" value="<?php if(isset($_SESSION['MovieID'])) echo $_SESSION['Cost']?>">
				</div>
				<?php if(!isset($_SESSION['MovieID'])) { ?>
                <div class="row justify-content-center">
				    <button type="submit" name="action" value="add" class="btn btn-secondary">Add Movie</button>
                </div><br>
				<?php }else{?>
				<div class="row justify-content-center">
                    <button type="submit" name="action" value="clear" class="btn btn-secondary">Clear</button>
                </div><br>
                <div class="row justify-content-center">
                    <button type="submit" name="action" value="update" class="btn btn-secondary">Update Movie</button>
                </div><br>
                <div class="row justify-content-center">
                    <button type="submit" name="action" value="delete" class="btn btn-secondary">Delete Movie</button>
                </div>
				<?php } ?>
			</form>
		</div>
		<div class="col-sm-8">
			<h3 class="text-center">Movies</h3><br>
			<form action="<?php echo base_url()?>admin/movies/view" method="post">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Row</th>
						<th>Movie ID</th>
						<th>Title</th>
						<th>Date</th>
                        <th>Cost</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($movies as $row){
						?>
						<tr>
							<td><input type="radio" name="id" value="<?php echo $row->MovieID; ?>" required></td>
							<td><?php echo $row->MovieID; ?></td>
							<td><?php echo $row->Title; ?></td>
							<td><?php echo $row->Date; ?></td>
							<td><?php echo $row->Cost; ?></td>
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
				<button type="submit" class="btn btn-secondary">View Movie</button>
			</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>