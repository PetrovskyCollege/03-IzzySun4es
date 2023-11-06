<?php
session_start();
include_once 'class.php';
$user = new User();
if ($user->session())
   {  
header("location:index.php");
   }  
  
   $user = new User();  
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$login = $user->login($_REQUEST['email'],$_REQUEST['password']);
if($login){
         header("location:index.php");  
      }
else
      {  
echo "Login Failed!";
      }  
   }  
?>  
<html>
  
<head>
<title>Log In</title>
<link rel="stylesheet" href="style.css" />
</head>
  
<body>
<div class="form">
<h1>Вход</h1>
<form action="" method="post">
<input type="text" name="email" placeholder="E-mail" required />
<br />
<input type="password" name="password" placeholder="Пароль" required />
                <br />  
<input type="submit" name="submit" value="Войти" />
</form>
<p>Ещё не зарегистрировались<a href="register.php"> Зарегистрироваться здесь</a></p>
</div>
</body>
  
</html>