<!DOCTYPE html>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="../main.js"></script>
        <link rel="stylesheet" href="signup.css">
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
        <div class="header grey">
            <h2 style="margin-left: 3vmin;font-size:5vmin">
                <?php
                    if(array_key_exists('is_signup', $_SESSION) && $_SESSION['is_signup']) {
                        echo "Welcome ". $_SESSION['username']."!";
                    } else {
                        echo "Edit Profile";
                    }
                ?>
            </h2>
        </div>
        <div style="margin-top:calc(min(20vmin,50px) + 30px);text-align:center;display: flex;justify-content: center;">
            <form enctype=multipart/form-data style="text-align:center;width: 70%;" method="post">
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;width: 100%">
                    <img  id="pic" src="
                    <?php
                        if(array_key_exists('img', $_SESSION)) {
                        echo '../../'.$_SESSION['img']; 
                        } else {
                            echo 'nothing';
                        }
                    ?>
                    " onerror="this.src = '../app_images/profile.png'"
                        style="
                        border: 1px solid black;
                        height: 50vmin;
                        width: 50vmin;
                        border-radius: 50vmin;
                        object-fit: cover; 
                        ">
                    <button onclick="remove_photo()" id="remove-photo-btn" class="remove-photo-btn">
                        Remove profile photo
                    </button> 
                    <div class='div'>
                        Choose a profile photo
                        <input name="img_file" id="img_file" title="" onchange="select_img(this)" class='file' type='file'>
                    </div>
                    <input name="ok" type="submit" class="save-button" value="Ok">
                    <input name="skip" type="submit" class="skip-button" value="Skip">
                </div>
                <?php
                    function validate($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    if(isset($_POST['skip'])) {
                        $_SESSION['is_signup'] = false;
                        header("Location:../profile/profile.php");
                    }

                    if(isset($_POST['ok'])) {
                        $img_name = '';
                        $img_path = '';
                        $username = $_SESSION['username'];
                        if(isset($_FILES["img_file"]) && $_FILES["img_file"]['name'] != '') { 
                            $img_info = pathinfo($_FILES["img_file"]["name"])['extension'];
                            $img_path = "/project/images/$username/";
                            $img_name = "profile.$img_info";
                        }
                        include '../common/db.php';
                        $query= "UPDATE `$users_table` SET `img_name` = '$img_name', `img_path` = '$img_path' WHERE `$users_table`.`user_name` = '$username';";
                        echo $query.'<br>';
                        try {
                            $result = mysqli_query($connection, $query);
                            if($result) {
                                if(isset($_FILES["img_file"]) & $_FILES["img_file"]['name'] != '') { 
                                    if(!is_dir("../images/$username/")) {
                                        mkdir("../images/$username/");
                                    }
                                    $filepath = "../images/$username/$img_name";
                                    move_uploaded_file($_FILES["img_file"]["tmp_name"], $filepath);
                                }
                                $_SESSION['username'] = $username;
                                $_SESSION['img'] = $img_path . $img_name;
                                $_SESSION['is_signup'] = false;
                                header("Location:../profile/profile.php");
                            }
                        } catch(Exception $e) {
                            echo $e;
                            echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Username already exists</div>";
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html> 

