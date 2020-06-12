<?php function createLink($href, $icon, $text) {
    $is_active = $_SERVER['PHP_SELF'] === '/' . $href;
    $class_name = $is_active ? 'active' : '';

    print("
        <li class='$class_name'>
            <a href='$href'>
                <i class='fa $icon'></i>
                <span>$text</span>
            </a>
        </li>
    ");
} ?>
<!-- Sidebar Menu -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <?php createLink("index.php", "fa-calendar", "Главная"); ?>
           
            <li class="header">Справочники</li>
            <?php
            createLink("list-inventar.php", "fa-users", "Инвентарь");
            createLink("list-naklad.php", "fa-users", "Накладные");
            createLink("list-sklad.php", "fa-users", "Склады");
            createLink("list-ychet.php", "fa-users", "Учёт ");
            
            ?>
            <li class="header">Запрос складов</li>
            <?php createLink("list-skladzapr.php", "fa-users", "Склады на текущую дату"); ?>
        </ul>
    </section>
</aside>
<!-- /.sidebar-menu -->