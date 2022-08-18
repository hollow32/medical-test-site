<?php

class usuario
{
    private $pdo; 
    public $msgErro = ""; //ok
    public function conect ($name,$host,$user,$pass)
    {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO ("mysql:dbname=".$name.";host=".$host,$user,$pass);

        } catch (PDOException $e) {
            $msgErro = $e-> getMessage();
        }
        
    }

    public function register ($name, $email, $pass, $conf_pass, $date_of_birthday, $phone, $address, $gender, $question, $answer_question)
     {
        global $pdo;
        $sql = $pdo ->prepare ("SELECT id_usuario FROM table usuarios WHERE email = :e"); //verify if have email already registred
        $sql->bindValue (":e",$email);
        $sql->execute();

        if($sql->rowCount() > 0 )
        {
            return false; //already registred
        }
        else
        {
            //if not, register
            $sql = $pdo->prepare("INSERT INTO usuarios (name, email, pass, conf_pass, date_of_birthday, phone, address, gender, question, answer_question) VALUES (:n,:e, :pass, :DOB, :p, :a, :g, :q, :aq)");
            $sql->bindValue (":n",$name);
            $sql->bindValue (":e",$email);
            $sql->bindValue (":pass",md5 ($pass));
            $sql->bindValue (":conf_pass",md5 ($conf_pass));
            $sql->bindValue (":DOB",$date_of_birthday);
            $sql->bindValue (":p",$phone);
            $sql->bindValue (":a",$address);
            $sql->bindValue (":g",$gender);
            $sql->bindValue (":q",$question);
            $sql->bindValue (":aq",$answer_question);
            $sql->execute();

            return true; //all ok
        }
    }
    public function login ($email, $pass)
    {
        global $pdo;
        // verify if users already registred
        $sql = $pdo->prepare ("SELECT id_usuario FROM usuarios WHERE email =:e AND pass = :pass");
        $sql->bindValue (":e,$email");
        $sql->bindValue (":pass",md5 ($pass));
        $sql->execute();
        if ($sql->rowcount ()> 0 )
        {
            //enter
            $dado = $sql-> fetch();  
            session_start();
            $_SESSION ['id_usuario'] = $dado ['id_usuario'];
            return true; //login suscesfull
        
        }
        else
        {
            return false; //don't possible login

        }
    }



}
?>