<?php
require_once 'class/users.php';
$u =new users;

?>

<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title> Login </title>
	<link rel="stylesheet" href= "CSS/estilo.css">

</head>
<body>
	<div id="register">
	<h1> Register </h1>
	<form method="POST"> <!-- use POST for send informations for any places and GET for recivie informations -->
        <input type="text" name="name" placeholder="your full name" maxlength="30">
        <input type="email" name="email" placeholder="your registred email" maxlength="32">
        <input type="password" name="password" placeholder="your password"maxlength="32" >
        <input type="password" name="conf_password" placeholder="confirm your password" maxlength="32"> <!-- put the additional field for confirm the same password putted in the above field -->
        <input type="text" name="date_of_birthday" placeholder="your date of birthday" maxlength="12">
        <input type="text" name="phone" placeholder="your phone name" maxlength="20">
        <input type="text" name="address" placeholder="your address" maxlength="30">
        <input type="text" name="gender" placeholder="male/female/non Binary" maxlength="20" >
		<input type="text" name="question" placeholder="your security question" maxlength="100">
        <input type="text" name="answer_question" placeholder="your security answer" maxlength="100">
		<input type="submit" value="register">
</form>
</div>
<?php
// verify if click in the button
ifisset($_POST['name'])
{
	$name = addslashes($_POST['name']);
    $email = addslashes($_POST['email']);
    $pass = addslashes($_POST['password']);
    $conf_pass = addslashes($_POST['conf_password']);
    $date_of_birthday = addslashes($_POST['date_of_birthday']);
    $phone = addslashes($_POST['phone']);
    $address = addslashes($_POST['address']);
    $gender = addslashes($_POST['gender']);
    $question = addslashes($_POST['question']);
    $answer_question = addslashes($_POST['answer_question']);
    //verify if fields isn't empty
    if(!empty($name) && !empty($email) && !empty($password) &&!empty($conf_password) && !empty($date_of_birthday)&& !empty($address)&& !empty($gender)&& !empty($question)&& !empty($answer_question))
    {
        $u->conectar ("teste_register12","localhost:3000","root","");
        if($u->msgErro == "") //all ok
        {
            if($pass == $conf_pass)
            {
                if($u->register($name,$email,$pass,$conf_pass, $date_of_birthday,$address,$gender,$question,$answer_question));
                {
                    echo "Registred suscessfully";
                }
            }
            else
            {
                echo "Email already registred!";
            }
        else
        {
            echo "Missmatch password";
        }
        else
        {      
            echo "Erro" $u->msgErro;

         }
        }
        } else
        {
            echo "Complete all informations";
        }
       
}
?>
</body>
</html>