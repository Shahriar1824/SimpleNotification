<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
}

$query = $dbConn->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$dbConn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome - <?php echo $userRow['email']; ?></title>

    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="assets/bootstrap-theme.min.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="assets/style.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Isrm</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Menu 1</a></li>
                <li><a href="#">Menu 2</a></li>
                <li><a href="#">Coming Soon</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><?php echo $userRow['username']; ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                        <span class="glyphicon glyphicon-envelope" style="font-size: 18px;"></span>
                    </a>
                    <ul class="dropdown-menu"></ul>
                </li>
                <li><a href="logout.php?logout">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container" style="margin-top:150px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:20px;">
    <a href="#">Hello World!</a><br /><br />
    <p>This is a simple notification system using PHP-MySql and Ajax</p>
    <form method="post" id="comment_form">
        <fieldset>
            <div class="form-group">
                <label>Enter Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter Comment</label>
                <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
            </div>
        </fieldset>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="assets/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        /*Notification and Count the unseen notification*/
        function load_unseen_notification(view = '')
        {
            $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{view:view},
                dataType:"json",
                success:function(data)
                {
                    $('.dropdown-menu').html(data.notification);
                    if(data.unseen_notification > 0)
                    {
                        $('.count').html(data.unseen_notification);
                    }
                }
            });
        }

        load_unseen_notification();

        /*Inserting the form data via ajax*/
        $('#comment_form').on('submit', function(event){
            event.preventDefault();
            if($('#subject').val() != '' && $('#comment').val() != '')
            {
                var form_data = $(this).serialize();
                $.ajax({
                    url:"insert.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        $('#comment_form')[0].reset();
                        load_unseen_notification();
                    }
                });
            }
            else
            {
                alert("Both Fields are Required");
            }
        });

        /*Loading Notification Data From Drop Down*/
        $(document).on('click', '.dropdown-toggle', function(){
            $('.count').html('');
            load_unseen_notification('yes');
        });

        /*Setting a timer to reaload the data from a certaing amount a time. This method will be usefull when
         * you are accessing from another pc show the notification counter for new notification.
          * */
        setInterval(function(){
            load_unseen_notification();;
        }, 5000);

    });
</script>
</body>
</html>