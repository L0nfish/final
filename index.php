<?php
require_once 'secure.php';
$header = 'Главная: .';
$userIdentity = (new UserMap())->identity($_SESSION['id']);

require_once 'template/header.php';
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <section class="box-body">
                    <h3><?=$header;?></h3>
                </section>
                <div class="box-body">
                    

                </div>
            </div>
        </div>
    </div>
<?php
require_once 'template/footer.php';
?>