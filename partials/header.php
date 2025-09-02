<style>
    /* CSS elements that use urls should be placed here to use PHP variables. */
    .circuit#v1 { 
        top: 6%;
        mask-image: url("<?=VFX?>/Circuit_1.svg");
    }

    .circuit#v2 {
        top: 7%;
        mask-image: url("<?=VFX?>/Circuit_2.svg");
    }
</style>

<header>
    <a href=""><img src="<?=IMAGE_ROOT?>/Lunarflame_Logo.png"></a>
    <nav class="nav-links">
        <i class="bx bx-x" onclick="hideMenu()"></i>
        <?php require('nav-links.php') ?>
    </nav>
    <i class="bx bx-menu" onclick="showMenu()"></i>
</header>
