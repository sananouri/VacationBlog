<!DOCTYPE html>
<html>
    
    <head>
        <script src="../main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            function OnConfirm() {
                var confirmBox = $("#confirm");
                confirmBox.find(".no").unbind().click(function () {
                    confirmBox.hide();
                });
                // confirmBox.find(".yes").click(myYes);
                confirmBox.show();
            }
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="profile.css">
    </head>
    <body class="grey" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
        <?php
            session_start();
            if (!array_key_exists('username', $_SESSION) || !isset($_SESSION['username'])) {
                echo "
                <div style='width:100%;height:50vh;text-align:center;color:red'>Access Denied</div>
                ";
                exit();
            }
        ?>
        <div id="confirm">
            <div>Do you want to logout?</div>
            <br/>
            <a href="logout.php"><button class="yes" onclick="">Yes</button></a>
            <button class="no">No</button>
        </div>
        <div class="header grey">
            <img class="pic" onclick="OnConfirm()"src="
                <?php
                    if(array_key_exists('img', $_SESSION)) {
                       echo '../../'.$_SESSION['img']; 
                    } else {
                        echo 'nothing';
                    }
                ?>"
                onerror="this.src = '../app_images/profile.png'"
            >
            <b style="font-size: min(3vmin,14px);width: 100%;">
                <?php
                    echo $_SESSION['username'];
                ?>
            </b>
            <button onclick="edit_profile()" class="header-button" data-placement="bottom" title="Edit Profile">
                <i class="fa fa-edit" style="font-size: min(3vmin,16px);"></i>
            </button>
            <button onclick="add_post()" class="header-button" data-placement="bottom" title="Add post">
                <i class="fa fa-plus-square" style="font-size: min(3vmin,16px);"></i>
            </button>
        </div>
        
        <div style="
            text-align: center;
            width: 100%;
            margin-top: calc(min(20vmin,50px) + 30px);
            ">
            <?php include 'action.php'?>
        </div>
        <button onclick="go_home()" name="home"style="height:7vmin; width: 7vmin;position: fixed;bottom:2vmin; right:2vmin; border-radius:7vmin">
            <i class="fa fa-home" style="font-size: 4vmin"></i>
        </button>
    </body>
</html> 

