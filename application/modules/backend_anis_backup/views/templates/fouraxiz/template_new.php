<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">
    <?php require_once 'elements/head.php'; ?>
    <body>
        <?php require_once 'elements/top_menu_brand.php'; ?>
        <?php //require_once 'elements/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                 <?php require_once 'elements/menu.php'; ?>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <?php //require_once 'elements/left_menu.php'; ?>
                </div>
                <div id="content" class="col-lg-12 col-md-12 col-sm-12">
                    {{CONTENT}}
                </div>
            </div>
        </div>
        <?php require_once 'elements/footer.php'; ?>
    </body>
</html>