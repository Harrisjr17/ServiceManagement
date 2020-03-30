<?php
include '../conn.php';
session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
    
} else {
    header("Location:../index.php");
}
$username = $_SESSION['username'];
$userid = $_SESSION['user_Id'];
?>
<html>
    <head>
        <title></title>

        <!--Custom CSS-->
        <link rel="stylesheet" type="text/css" href="../css/global.css">
        <!--Bootstrap CSS-->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!--Script-->
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav style="background-color: #17A2B8; border-color:#17A2B8; " class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a style="color: #fff;" class="navbar-brand" href="#">Manja Service Management</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a class="btn btn-sm"style="background: #2C3E50; margin-right: 4px; margin-bottom: 3px;margin-top: 3px;"href="#">Spares</a></li>
                        <li><a class="btn btn-sm"style="background: #2C3E50; margin-right: 4px; margin-bottom: 3px;margin-top: 3px;"href="#">Car Service</a></li>
                        <li><a class="btn btn-sm"style="background: #2C3E50; margin-right: 4px; margin-bottom: 3px;margin-top: 3px;" href="#">Forum</a></li>                 
                    </ul>
                </div>
            </div>
        </nav>

        <div class="col-sm-2">

            <ul class="nav nav-pills nav-stacked">
                <li style="background: #2C3E50;" class="nav-link btn btn-success"><a href="../../profile.php">Customer Account</a></li>

                <li><div class="dropdown">
                        <button style="width: 100%; background: #2C3E50;background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">spares Purchased
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li> <a class="dropdown-item" href="customers.php"><i class="fa fa-users"></i> Customers</a></li>
                            <li><a class="dropdown-item" href="employees.php"><i class="fa fa-users"></i> Employees</a> </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Request service
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../employee/calendar_of_events.php">Service Bookings</a></li>
                            <li><a class="dropdown-item" href="../employee/servicerequest.php">Vehicle service request</a></li>                     
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Spare management
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"href="spares.php">Spares</a></li>
                            <li><a class="dropdown-item" href="viewbuyspareparts.php">Spares Orders</a></li>                      
                        </ul>
                    </div>
                </li>

                <li><a style="width: 100%; background: #2C3E50; background-color: #2C3E50;" class="nav-link btn btn-success" href="logout.php">Logout</a></li>
            </ul> 

        </div>
        <div class="col-sm-10">
            <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Service Maintenance</h3>
                    </div> 
                    <div class="panel-body">
                        <?php
                        include "../functions/db.php";
                        $id = $_GET['post_id'];


                        $sql = mysql_query("SELECT * from tblpost as tp join category as c on tp.cat_id=c.cat_id where tp.post_Id='$id' ");
                        if ($sql == true) {
                            while ($row = mysql_fetch_assoc($sql)) {
                                extract($row);
                                if ($user_Id == 009) {
                                    echo "<label>Topic Title: </label> " . $title . "<br>";
                                    echo "<label>Topic Category: </label> " . $category . "<br>";
                                    echo "<label>Date time posted: </label> " . $datetime;
                                    echo "<p class='well'>" . $content . "</p>";
                                    echo "<label>Posted By: </label> Admin";
                                } else {
                                    $sel = mysql_query("SELECT * from tbluser where user_Id='$user_Id' ");
                                    while ($row = mysql_fetch_assoc($sel)) {
                                        extract($row);
                                        echo "<label>Topic Title: </label> " . $title . "<br>";
                                        echo "<label>Topic Category: </label> " . $category . "<br>";
                                        echo "<label>Date time posted: </label> " . $datetime;
                                        echo "<p class='well'>" . $content . "</p>";
                                        echo '<label>Posted By: </label>' . $fname . ' ' . $lname;
                                    }
                                }
                            }
                        }
                        ?>

                        <br><label>Comments</label><br>
                        <div id="comments">
                        <?php
                        $postid = $_GET['post_id'];
                        $sql = mysql_query("SELECT * from tblcomment as c join tbluser as u on c.user_Id=u.user_Id where post_Id='$postid' order by datetime");
                        $num = mysql_num_rows($sql);
                        if ($num > 0) {
                            while ($row = mysql_fetch_assoc($sql)) {
                                echo "<label>Comment by: </label> " . $row['fname'] . " " . $row['lname'] . "<br>";
                                echo '<label class="pull-right">' . $row['datetime'] . '</label>';
                                echo "<p class='well'>" . $row['comment'] . "</p>";
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-sm-5 col-md-5 sidebar">
                    <h3>Comment</h3>
                    <form method="POST">
                        <textarea type="text" class="form-control" id="commenttxt"></textarea><br>
                        <input type="hidden" id="postid" value="<?php echo $_GET['post_id']; ?>">
                        <input type="hidden" id="userid" value="<?php echo $_SESSION['user_Id']; ?>">
                        <input type="submit" id="save" class="btn btn-success pull-right" value="Comment">
                    </form>
                </div>
        </div>
    </body>
    <script>

        $("#save").click(function () {
            var postid = $("#postid").val();
            var userid = $("#userid").val();
            var comment = $("#commenttxt").val();
            var datastring = 'postid=' + postid + '&userid=' + userid + '&comment=' + comment;
            if (!comment) {
                alert("Please enter some text comment");
            } else {
                $.ajax({
                    type: "POST",
                    url: "../functions/addcomment.php",
                    data: datastring,
                    cache: false,
                    success: function (result) {
                        document.getElementById("commenttxt").value = ' ';
                        $("#comments").append(result);
                    }
                });
            }
            return false;
        })

    </script>
</html>