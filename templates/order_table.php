<center>

        <form class="inline-form search-form  search-form-wpg" action="index.php#orders-container" method="get">
            <input type="hidden" id="page" name="page" value="orders">
            <input type="hidden" id="oPage" name="oPage" value="1">
            <input type="text" class="form-control" id="oSearch" name="oSearch" placeholder="Paieška" <?php echo 'value="' . @$_GET['oSearch'] . '"';?>>
            <button type="submit" class="btn btn-outline-success" id="oSearchSubmit" name="oSearchSubmit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>

        <?php
            if(OrderManager::$_oMinPage <= OrderManager::$_oMaxPage) Page::_loadTemplate("order_table_real");
            else echo '<br><center class="alert alert-danger">Produktai, tokiu pavadinimu nebuvo rasti!</center>';
        ?>

</center>