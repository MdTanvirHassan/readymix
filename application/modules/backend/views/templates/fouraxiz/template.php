<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">
    <?php require_once 'elements/head.php'; ?>
    <body class="nav-md" onload="set_interval()" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()"   >
        
        
        <?php require_once 'elements/left_menu.php'; ?>
        <?php require_once 'elements/top_menu.php'; ?>
                
               
                    {{CONTENT}}
               
        <?php require_once 'elements/footer.php'; ?>
    </body>
</html>