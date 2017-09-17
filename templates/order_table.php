<?php 

    //Originally I wanted those to be in template system, but it appears, that I only can use include_once one time :I.
    //So yeah, I still need to figure workaround.
    function _renderOrderRow($order, $first = false) {
        
        //Counter.
        global $_nOrderRow;
        if(!isset($_nOrderRow))
            $_nOrderRow = ((OrderManager::$_oCurrentPage - 1) * OrderManager::$_oItemsPerPage) + 1;
        else
            $_nOrderRow++;

        //Rendering itself.
        echo '
            <tr>
                <th scope="row">' . $_nOrderRow . '</th>
                <td>' . $order->getName() . '</td>
                <td>' . $order->getSurname() . '</td>
                <td>' . $order->getEmail() . '</td>
                <td>' . $order->getPhone() . '</td>
                <td>' . $order->getAddress() . '</td>
                <td>' . $order->getInfo() . '</td>
            </tr>
        ';
        
    }

?>

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