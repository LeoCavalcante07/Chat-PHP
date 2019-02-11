<?php

    session_start();
    

    $host = "localhost";
    $user = "root";
    $password = "bcd127";
    $banco = "db_chat"; 

    if(!$conexao = mysqli_connect($host, $user, $password, $banco)){
        echo("<script>alert('Houve um erro na conexão com o banco')</script>");
    } 

    if(isset($_GET['btnEnviar'])){
        
        
        $sql = "insert into mensagem(id_remetente, id_destinatario, mensagem) 
        values(".$_SESSION['id_usuario'].", 2, '".$_GET['txtMensagem']."')";


        //echo($sql);

        mysqli_query($conexao, $sql);

        header("location:chat.php");
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
        <div class="caixa_conversa">

            <?php
            
                $sql = "select * from mensagem";

                $select = mysqli_query($conexao, $sql);

                while($rsConsulta = mysqli_fetch_array($select)){

                    if($rsConsulta['id_remetente'] == $_SESSION['id_usuario']){
            
            ?>
            
            <div class="mensagem_enviada">

                        <?php echo($rsConsulta['mensagem']) ?>

            </div>
            <?php
                    }else{
            ?>

            <div class="mensagem_recebida">

                <?php echo($rsConsulta['mensagem']) ?>
            </div>

            <?php
                    }
                }

            ?>
        
        </div>
        <div class="caixa_envio">  
            <form id="form_envio" action="chat.php" method="GET">

                <textarea name="txtMensagem">

                </textarea>

                <input type="submit" name="btnEnviar" value="Enviar">

            </form>
            
        </div>
    </div>


</body>
</html>
