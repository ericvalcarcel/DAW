<?php
    require('functions/functionsBD.php'); 
    //Head de la página
    require('controls/head.php'); 

    //Header
    require('controls/header.php'); 
    
    require('controls/nav.php'); 
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col">
                
                    <textarea id="mytextarea"></textarea>

            </div>
            
        </div>
    </div>
</main>

<?php
    //Nav
    include('controls/aside.php'); 

    //Footer
    require('controls/footer.php'); 

    //Links
    require('controls/links.php'); 
?>
