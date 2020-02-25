<?php
    session_start();
    $uname = "";

    if(isset($_SESSION['user']))
    {
        $uname = $_SESSION['user'];
    }
    else
    {
        header("Location:index.php");
    }
    if(isset($_POST['submit']))
    {
        session_destroy();
        header("Location:index.php");
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
            <div align="center">
                Welcome precious user <?php echo $uname;?>
            </div>
            <div class="btn" align="center">
                <input type="submit" value="logout" name="submit">
            </div>
        </form>
    </div>
</body>
</html>