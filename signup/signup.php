<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="signup.css">
        <script src="../main.js"></script>
    </head>
    <body class="grey">
        <div style=
            "display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            ">
            <div style="
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                text-align: center;
                border-radius: 1vmin;
                font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                color: rgb(140, 186, 239);
                padding: 2vmin;
                background-color: rgb(78, 87, 133);
                width: min(90vw,300px);
                ">
                <b style="font-size:4vmin;">Signup</b>
                <div style="
                    margin-top: 4vmin;
                    position: relative;
                    width: 100%;
                    ">
                    <form method="post">
                        <div style="display: flex;flex-direction: column;align-items: center;">
                            <input name="id" type="text" placeholder="username"value="<?php echo $_POST['id'] ?? '' ?>" required>
                            <input name="pass" type="text" placeholder="Password" value="<?php echo $_POST['pass'] ?? '' ?>" required>
                            <?php
                                function validate($data) {
                                    $data = trim($data);
                                    $data = stripslashes($data);
                                    $data = htmlspecialchars($data);
                                    return $data;
                                }

                                if(isset($_POST['signup'])) {
                                    $username = validate($_POST['id']);
                                    $pass = validate($_POST['pass']);
                                    if(empty($username)) {
                                        echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Username is required</div>";
                                    } else if (empty($pass)) {
                                        echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Password is required</div>";
                                    } else if (strlen($pass) < 6) {
                                        echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Password must be at least 6 characters</div>";
                                    } else {
                                        include '../common/db.php';
                                        $query= "INSERT INTO $users_table VALUES ('$username','$pass','','')";
                                        try {
                                            $result = mysqli_query($connection, $query);
                                            if($result) {
                                                session_start();
                                                $_SESSION['username'] = $username;
                                                $_SESSION['password'] = $pass;
                                                $_SESSION['is_signup'] = true;
                                                header("Location:../edit_profile/edit_profile.php");
                                            }
                                        } catch(Exception $e) {
                                            echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Username already exists</div>";
                                        }
                                    }
                                }
                            ?>
                            <input type="submit" class="login-button" value="Signup" name="signup">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> 
