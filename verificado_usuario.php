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
        echo"<div class = 'form-group'style='margin-left:330px; margin-top:-40px;color:darkblue;' >";
        echo"<h1></h1>";
        echo"<center>";
        
        die(); // para parar o programa
        echo"</center>";
        echo"</div>";
    }

?>