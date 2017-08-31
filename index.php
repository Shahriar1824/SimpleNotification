<?php
session_start();
if(isset($_SESSION['userSession'])!= ""){
    header("Location: home.php");
}

require_once 'DbConnect.php';

/* /Registration Portion PHP Code */
if(isset($_POST['btn-signup'])) {
    $uname = strip_tags($_POST['username']);
    $email = strip_tags($_POST['email']);
    $upass = strip_tags($_POST['password']);

    $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

    $check_email = $dbConn->query("SELECT email FROM tbl_users WHERE email='$email'");
    $count = $check_email->num_rows;

    if($count == 0){
        $query = "INSERT INTO tbl_users(username,email,password) VALUES('$uname','$email','$hashed_password')";

        if($dbConn->query($query)){
            $msg = "<div class='alert alert-success'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
                    </div>";
        }
        else{
            $msg = "<div class='alert alert-danger'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
                    </div>";
        }
    }

    else{
        $msg = "<div class='alert alert-danger'>
                    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
                </div>";
    }

    $dbConn->close();
}
/* /Registration Portion PHP Code */

/* LogIn Portion PHP Code */
if(isset($_POST['btn-login'])){

    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    $email = $dbConn->real_escape_string($email);
    $password = $dbConn->real_escape_string($password);

    $query = $dbConn->query("SELECT user_id, email, password FROM tbl_users WHERE email='$email'");
    $row=$query->fetch_array();

    // if email/password are correct returns must be 1 row
    $count = $query->num_rows;

    if(password_verify($password, $row['password']) && $count==1){
        $_SESSION['userSession'] = $row['user_id'];
        header("Location: home.php");
    }
    else{
        $msg = "<div class='alert alert-danger'>
                    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
                </div>";
    }

    $dbConn->close();
}
/* /LogIn Portion PHP Code  */
?>



<!Doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>LiveNotification</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="assets/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/style.css" type="text/css" />
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 pull-left">
                <form class="form-horizontal" action='' method="POST">
                    <fieldset>
                        <div id="legend">
                            <legend class="">LogIn</legend>
                        </div>
                        <?php
                            if(isset($msg)){
                                echo $msg;
                            }
                        ?>
                        <div class="control-group">
                            <!-- Username -->
                            <label class="control-label"  for="email">Username</label>
                            <div class="controls">
                                <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- Password-->
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                            </div>
                        </div>

                        <br />

                        <div class="control-group">
                            <!-- Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">Sign In</button>
                            </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-md-6 pull-right">
                <form class="form-horizontal" method="post" id="register-form">
                    <fieldset>
                        <div id="legend">
                            <legend class="">Sign Up</legend>
                        </div>
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <div class="control-group">
                            <!-- Username -->
                            <label class="control-label"  for="username">Username</label>
                            <div class="controls">
                                <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
                                <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- E-mail -->
                            <label class="control-label" for="email">E-mail</label>
                            <div class="controls">
                                <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
                                <p class="help-block">Please provide your E-mail</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- Password-->
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                                <p class="help-block">Password should be at least 4 characters</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- Button -->
                            <div class="controls">
                                <button type="submit" class="btn btn-success" name="btn-signup">Create Account </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>