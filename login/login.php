<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="login.css">
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
                <b style="font-size:4vmin;">Login</b>
                <div style="
                    margin-top: 4vmin;
                    position: relative;
                    width: 100%;
                    ">
                    <form method="post">
                        <div style="display: flex;flex-direction: column;align-items: center;">
                            <input name="id" type="text" placeholder="username"value="<?php echo $_POST['id'] ?? '' ?>">
                            <input name="pass" type="text" placeholder="Password" value="<?php echo $_POST['pass'] ?? '' ?>">
                            <input type="submit" class="login-button" value="Login" name="login">
                            <?php
                                function validate($data) {
                                    $data = trim($data);
                                    $data = stripslashes($data);
                                    $data = htmlspecialchars($data);
                                    return $data;
                                }

                                if(isset($_POST['login'])) {
                                    $username = validate($_POST['id']);
                                    $pass = validate($_POST['pass']);
                                    if(empty($username)) {
                                        echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Username is required</div>";
                                    } else if (empty($pass)) {
                                        echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Password is required</div>";
                                    } else {
                                        include '../common/db.php';
                                        $sql = "SELECT * FROM $users_table WHERE user_name='$username' AND password='$pass'";
                                        $result = mysqli_query($connection, $sql);
                                        if(mysqli_num_rows($result)) {
                                            $data = mysqli_fetch_array($result);
                                            session_start();
                                            $_SESSION['username'] = $data['user_name'];
                                            $_SESSION['img'] = $data['img_path'] . $data['img_name'];
                                            header("Location:../profile/profile.php");
                                        } else {
                                            echo "<div style='padding-bottom:10px;color:red;font-size:2vmin'>Invalid login</div>";
                                        }
                                    }
                                }
                            ?>
                            <div style="width:90%; display: flex;flex-direction: row-reverse; margin-top: 5px;">
                                <button formaction="../signup/signup.php" class="signup-button">Signup</button>
                                <label id="label">Dont have an account?</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> 
