<!DOCTYPE html>
<html>
    <?php include('header.php');?>
    <body>
        <div id="content_wrapper">
            <div class="wrapper grid">
                <div class="row row-cols-2 justify-content-md-center">
                    <div class="hidden-xs col-md-5">
                        <div id="img-container">
                            <img src="/assets/images/registernow.jpg" class="img-fluid mx-auto"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-7">
                        <div id="form-container">
                            <form id="form-login" class="form-control form-control-md" method="POST">
                                <h1 class="text-center mb-4">Sign In</h1>
                                <div class="alert alert-danger alert-dismissible hidden">
                                    <span id="alert-text"></span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="row row-cols-2 align-items-center mb-3">
                                    <div class="col-xs-1 col-md-1">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="col-xs-11 col-md-11">
                                        <input type="text" class="form-control" placeholder="Username" name="username" aria-label="username" aria-describedby="username">
                                        <div class="error text-danger"></div>
                                    </div>
                                </div>
                                <div class="row row-cols-2 align-items-center mb-3">
                                    <div class="col-xs-1 col-md-1">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <div class="col-xs-11 col-md-11">
                                        <input type="password" class="form-control" placeholder="Password" name="password" aria-label="password" aria-describedby="password">
                                        <div class="error text-danger"></div>
                                    </div>
                                </div>
                                <div class="row row-cols-2 align-items-center mb-3">
                                    <div class="col-xs-12 col-md-4 offset-md-1 d-grid">
                                        <button type="submit" class="btn btn-md btn-full btn-primary">SIGN IN</button>
                                    </div>
                                    <div class="col-xs-12 col-md-7">
                                        Didn't have account?
                                        <a href="/">Register</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php include('footer.php');?>   
</html>