<?php
    session_start();
    if(isset($_SESSION['admin']))
    {
        header("Location:admin.php");
    }
    else if(isset($_SESSION['user']))
    {
        header("Location:user.php");
    }
    $uname="";
    $err_uname="";
    $pass="";
    $err_pass="";

    if(isset($_POST['register']))
    {
        header("Location:reg.php");
    }

    if(isset($_POST['submit']))
    {
        
        $got=0;
        if(empty($_POST['uname']))
        {
            $err_uname = "Username can not be empty";
        }
        else
        {
            $unamet = htmlspecialchars($_POST['uname']);
            $users = simplexml_load_file("users.xml");
            foreach($users as $user)
            {
                $un = $user->uname;
                if($un==$unamet)
                {
                    $got = 1;
                }

            }
            if($got==1)
            {
                $uname= $unamet;
            }
            else
            {
                $err_uname = "Username not valid";
            }
        }
        $gotp=0;
        if(empty($_POST['pass']))
        {
            $err_pass = "pass can not be empty";
        }
        else
        {
            //echo "dddddd";
            $passt = htmlspecialchars($_POST['pass']);
            $users = simplexml_load_file("users.xml");
            foreach($users as $user)
            {
                $un = $user->uname;
                $p = $user->pass;
                $t=$user->level;

                if($un==$uname)
                {
                    //echo "eeeee";
                    if($p!=$passt)
                    {
                        $err_pass = "pass did not match";
                        //echo "this";
                    }
                    else
                    {
                        if($t=="admin")
                        {
                            $_SESSION['admin']=$uname;
                            header("Location:admin.php");
                        }
                        if($t=="user")
                        {
                            $_SESSION['user']=$uname;
                            header("Location:user.php");
                        }
                        

                    }
                    break;
                }

            }
            

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        tr{
            vertical-align:top;
        }
        .container{
            box-sizing:border-box;
            background-color: #feeeee;
            width:400px;
            min-width:400px;
            height:200px;
            margin: 0 auto;
            padding:20px;
            border-radius:7px;
            
        }
        table{
            margin:0 auto;
        }
        input[type="text"],input[type="password"]{
            font-size:1.2em;
            height:30px;
            box-sizing:border-box;
            padding-left:5px;

        }
        input[type="submit"]{
            border:0px solid black;
            border-radius:5px;
            /* width:80px;
            height:40px; */
            background-color:firebrick;
            color:white;
            padding:9px 15px;
            margin-top:10px;
            
        }
        .btn{
            margin:0 auto;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <table>
                <tr>
                    <td>username</td>
                    <td>
                        <input type="text" name="uname" value="<?php echo $uname;?>">
                        <br>
                    <?php echo $err_uname;?>
                    </td>
                    
                </tr>
                
                <tr>
                    <td>password</td>
                    <td>
                        <input type="password" name="pass" value="<?php echo $pass;?>">
                        <br>
                    <?php echo $err_pass;?>
                    </td>
                    
                </tr>
                
            </table>
            <div class="btn" align="center">
                <input type="submit" value="login" name="submit">
            </div>
            <div class="btn" align="center">
                <input type="submit" value="Sign Up" name="register">
            </div>
        </form>
    </div>
</body>
</html>