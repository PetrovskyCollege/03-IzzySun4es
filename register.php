<?php
include_once 'class.php';
$user = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$trn_date = date("Y-m-d H:i:s");
$register = $user->register($trn_date,$_REQUEST['name'],$_REQUEST['username'],$_REQUEST['email'],$_REQUEST['password']);
if($register){
echo "Registration Successful!";
      }
else
      {  
echo "Entered email already exist!";
      }  
   }  
?>  
<html>
  
<head>
<title>Registration</title>
<link rel="stylesheet" href="style.css" />
</head>
  
<body>
<div class="form">
<h1>Регистрация</h1>
<form action="" method="post">
<input type="text" name="name" placeholder="Имя" required/><br/>
<input type="text" name="username" placeholder="Никнейм" required/><br/>  
<input type="text" name="email" placeholder="E-mail" required/><br/>  
<input type="password" name="password" placeholder="Пароль" required/><br/>  
<input type="submit" name="submit" value="Зарегистрироваться"/>
</form>
<p>Уже зарегистрированы?<a href="login.php">Войти здесь</a></p>
</div>

</body>
</html>