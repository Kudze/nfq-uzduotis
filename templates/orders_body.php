<?php Page::_loadTemplate("navbar"); ?>

<div class="spacer2x"></div>

<div class="container-fluid main-container center bg-dark">
    <h1 class="display-4">Print3D užsakymai:</h1>
</div>

<center class="container-fluid main-container center bg-dark2" id="orders-container">

    <?php OrderManager::renderOrdersList(); ?>

</center>

<div class="container-fluid end-container bg-dark"></div>

<?php Page::_loadTemplate("copyright") ?>