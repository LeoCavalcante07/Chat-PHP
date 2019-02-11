<?php

$host = "localhost";
$user = "root";
$password = "bcd127";
$banco = "db_chat"; 

session_start();

    if(!$conexao = mysqli_connect($host, $user, $password, $banco)){
        echo("<script>alert('Houve um erro na conexão com o banco')</script>");
    } 

    if(isset($_POST['btnEntrar'])){
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];

        $sql = "select nome, id_usuario from usuario where email = '".$usuario."' and senha = '".$senha."'";
        echo $sql;
        $select = mysqli_query($conexao, $sql);
        
        $rsUsuario = mysqli_fetch_array($select);

        if(@count($rsUsuario) > 0){
        
            //echo $rsUsuario['nome'];
            
            $_SESSION['usuario'] = $rsUsuario['nome'];
            $_SESSION['id_usuario'] = $rsUsuario['id_usuario'];

            header("location:chat.php");
        }else{
            echo 'usuario inexistente';
        }

    }
    

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Page Title</title>    
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <script src="main.js"></script>
</head>
<body>

    <div class="caixa_chat">
        <form action="index.php" method="POST">
                usuario: <input type="text" name="txtUsuario">
                <br>    
                senha: <input type="password" name="txtSenha">

                <input type="submit" name="btnEntrar" value="Entrar">
        </form>
        
        
    </div>


</body>
</html>
