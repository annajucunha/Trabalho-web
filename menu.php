<?php
session_start();
?>
 
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
        a
        {
            color:white;
        }
        </style>

					
				

					
							
						 <div class = "menu">   

							  
								
								
									
											
									</div>
                                    <div class = "container-fluid  mt-10 pt-2 pb-4 pr-4 pl-4  " style="background-image:url('menuzao.png'); height: 685px; width: 255px; margin-left: 30px;">
                                    <div class = "container-fluid  pt-2 pb-4 pr-4 pl-4  " style="color: white; text-align: right;">	
                                    <br />
                                    <h1>Sorveteria</h1>		
                                    <br />
                                    <div class = "col-2">				
                                    <div class = "col-1">																						
										<?php
										if(isset($_SESSION["autorizado"])){
										
											echo '<a href = "logout.php" style="color: white ;">Logout </a>';
										}
										else{
											echo '<a href = "login.php">Login </a>';
										}
									?>
                                    </div>
                                    <br /><br/>
                                    <div class = "col-2">				
											<a href = "form_cadastro.php" style="color: white ;">Cadastrar Usuario</a>
                                    </div>
                                    <br /><br/>
                                    <?php


 
                                        if(isset($_SESSION["autorizado"]))
                                        {
                                                                            
                                    ?> 
									<div class = "col-2 ">									
                                        <a href = "form_picole.php" style="color: white ;"> Picolés</a>
                                    </div>
                                    <br /><br/>
									<div class = "col-2">																				
                                        <a href = "form_sorvete.php" style="color: white ;"> Sorvetes Massa</a>
                                    </div>
                                    <br /><br/>
									<div class = "col-2">									
                                        <a href = "form_acai.php" style="color: white ;"> Açai</a>
                                    </div>
                                   <br /><br/>
                                    <div class = "col-2">									
                                        <a href = "form_milkshake.php" style="color: white ;"> Milk Shakes</a>
                                    </div>
                                    <br /><br/>
									<div class = "col-3">									
                                        <a href = "form_carrinho.php" style="color: white ;">Comprar Online </a> 
                                    </div>
									<br /><br/>
									<?php
                                        }
                                        ?>
									</div>
									</div>
									
							
	</div>
	</div>
						  

     </html>