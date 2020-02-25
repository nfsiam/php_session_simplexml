<?php
    session_start();
    if(isset($_SESSION['admin']))
    {
        session_destroy();
    }
    else if(isset($_SESSION['user']))
    {
        session_destroy();
    }
    
    $uname="";
    $err_uname="";
    $pass="";
    $err_pass="";
    $level="";
    $err_level="";
    $op=array("","");
    

    
    if(isset($_POST['submit']))
    {
        
        $wait=0;
        if(empty($_POST['uname']))
        {
            $err_uname = "Username can not be empty";
            $wait=1;
        }
        else
        {
            $uname = htmlspecialchars($_POST['uname']);
        }
        
        if(empty($_POST['pass']))
        {
            $err_pass = "pass can not be empty";
            $wait=1;
        }
        else
        {
            $pass = htmlspecialchars($_POST['pass']);
        }
        if(empty($_POST['level']))
        {
            $err_level = "Select level";
            $wait=1;
            //echo "oh";
        }
        else
        {       
            $level = htmlspecialchars($_POST['level']);
            //echo $_POST['level'];
            if($level=="user")
            {
                $op[0]="selected='true'";
                //echo $op[0];
            }
            else
            {
                $op[1]="selected='true'";
            }

        }

        if($wait==0)
        {
            //echo "dhuksi";
            $users = simplexml_load_file("users.xml");

            $user = $users->addChild('user');

            $uname = $user->addChild('uname',"$uname");
            $pass = $user->addChild('pass',"$pass");
            $lvl = $user->addChild('level', "$level");
            

            $dom = new DOMDocument('1.0');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($users->asXML());

            

            $file = fopen("users.xml","w");
            fwrite($file, $dom->saveXML());

            $uname = "";
            $pass = "";
            $op[0] = $op[1] = "";

            $_SESSION["$level"] = $uname;
            header("Location:$level.php");
            
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
            height:250px;
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
               
                
                <tr>
                    <td>level</td>
                    <td>
                        <select name="level" id="">
                            <option></option>
                            <option value="user" <?php echo $op[0];?>>user</option>
                            <option value="admin" <?php echo $op[1];?>>admin</option>
                            
                        </select>

                        <br>
                    <?php echo $err_level;?>
                    </td>
                    
                </tr>
                
            </table>
            <div class="btn" align="center">
                <input type="submit" value="Submit" name="submit">
            </div>
            
        </form>
    </div>
</body>
</html>