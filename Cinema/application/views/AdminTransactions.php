<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <br><br><br>
	<div class="justify-content-center">
			<h3 class="text-center">Transactions</h3><br>
			<form action="view" method="post">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>User ID</th>
						<th>Name</th>
						<th>Movie</th>
                        <th>Movie Date</th>
                        <th>Quantity</th>
                        <th>Total Cost</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($transactions as $row){
						?>
						<tr>
							<td><?php echo $row->UserID; ?></td>
							<td><?php echo $row->Name; ?></td>
                            <td><?php echo $row->Title; ?></td>
                            <td><?php echo $row->Date; ?></td>
							<td><?php echo $row->Quantity; ?></td>
							<td><?php echo $row->Totalcost; ?></td>
						</tr>
						<?php
					}
				?>
				</tbody>
			</table>
			<div class="row justify-content-center">
				<p><?php echo $links; ?></p>
            </div><br>
			</form>
	</div>
</div>
</body>
</html>