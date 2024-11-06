<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Movies</title>
    </head>
    <body>
        <div class="container">
            <br><br>
            <?php foreach($movies as $row){ ?>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                        <img class="card-img-right flex-auto d-none d-md-block" alt="<?php echo 'http://localhost/FINALS/uploads/'.$row->Poster ?>" src="<?php echo 'http://localhost/FINALS/uploads/'.$row->Poster ?>" style="width: 300px; height: 375px;">
                        <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary">₱<?php echo $row->Cost ?></strong>
                            <h3 class="mb-0">
                            <a class="text-dark"><?php echo $row->Title ?></a>
                            </h3>
                        <div class="mb-1 text-muted"><?php echo $row->Date ?></div>
                            <p class="card-text mb-auto"><?php echo $row->Description ?></p>
                            <br>
                            <div class="input-group mb-1">
                            <div class="w-75">
                            </div>
                            <form action="buy" method="post">
                            <div class="input-group-append">
                                <input type="number" class="form-control" name="quantity"  placeholder="Quantity" required>
                                <button type="submit" name="movieid" class="btn btn-secondary" value="<?php echo $row->MovieID?>">Buy</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row justify-content-center">
				<p><?php echo $links; ?></p>
            </div>
        </div>
    </body>
</html>