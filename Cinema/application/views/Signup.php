<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
        <style>
            .page-holder {
                min-height: 100vh;
            }

            .bg-cover {
                background-size: cover !important;
            }

            #login .container #login-row #login-column #login-box {
                margin-top: 120px;
                max-width: 600px;
                height: 320px;
                border: 1px solid #9C9C9C;
                background-color: #EAEAEA;
            }
            #login .container #login-row #login-column #login-box #login-form {
                padding: 20px;
            }
            #login .container #login-row #login-column #login-box #login-form #register-link {
                margin-top: -85px;
            }
        </style>
    </head>
    <body>
        <div style="background: url(http://localhost/FINALS/assets/MainBG.jpg)" class="page-holder bg-cover">
            <br> <br> <br>
            <div class="container py-5">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

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

                            <form id="login-form" class="form" action="signup" method="post">
                                <h1 class="display-4 font-weight-bold mb-4 text-center text-light">Sign Up</h1>
                                <div class="form-group">
                                    <label for="Name" class="text-info text-light">Name:</label><br>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="email" class="text-info text-light">Email:</label><br>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="password" class="text-info text-light">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="password" class="text-info text-light">Confirm Password:</label><br>
                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                                </div>
                                <br>
                                <div class="form-group text-center">
                                    <input type="submit" name="submit" class="btn btn-info btn-md text-dark bg-white" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>