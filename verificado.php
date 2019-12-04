<head>
<style>
a:link
{
    color:white;
    text-decoration: none;
}
a:hover
{
    color:white;
    text-decoration: none;
}
a:visited
{
    color:white;
    text-decoration: none;
}
a:active
{
    color:white;
    text-decoration: none;
}

</style>

</head>



<?php
 
    if(!isset($_SESSION["autorizado"]))
    {
        echo"<div class = 'form-group'style='margin-left:330px; margin-top:-600px;color:darkblue;' >";
        echo"<h1> Você deve realizar o login para cadastrar nesta página!</h1>";
        echo"<center>";
        echo"<button class='btn' style='background-color:darkblue; font-size:20px; margin-right:80px;'><a href = 'login.php'>Login</a|></button>";
        die(); // para parar o programa
        echo"</center>";
        echo"</div>";
    }

?>