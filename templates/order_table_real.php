<?php

    //Originally I wanted those to be in template system, but it appears, that I only can use include_once one time :I.
    //So yeah, I still need to figure workaround.
    function renderOrderTablePage($pageNum, $active) {
        if($active)
            echo '<li class="page-item"><span class="page-link active">' . $pageNum . '</span></li>';
        else
            echo '<li class="page-item"><a class="page-link" href="' . Page::getCurrentURL() . '&oPage=' . $pageNum . '&oSearch=' . @$_GET['oSearch'] . '#products-container">' . $pageNum . '</a></li>';
    }
    
    //$dir = 0 (right)
    //$dir = 1 (left)
    function renderOrderTablePageControl($dir, $pageNum) {
        echo '
        <li class="page-item">
            <a class="page-link" href="' . Page::getCurrentURL() . '&oPage=' . $pageNum . '&oSearch=' . @$_GET['oSearch'] . '#products-container" aria-label="' . ($dir ? 'Praeitas' : 'Kitas') . '">
                <span aria-hidden="true">' . ($dir ? '&laquo;' : '&raquo;') . '</span>
                <span class="sr-only">' . ($dir ? 'Praeitas' : 'Kitas') . '</span>
            </a>
        </li>
        ';
    }

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

<ul class="pagination">

<?php

    //Pagination content
    //Originally I wanted those to be in template system, but it appears, that I only can use include_once one time :I.
    //So yeah, I still need to figure workaround.
    renderOrderTablePageControl(1, OrderManager::$_oCurrentPage != OrderManager::$_oMinPage ? OrderManager::$_oCurrentPage - 1 : OrderManager::$_oMaxPage);
                
    for($i = OrderManager::$_oMinPage; $i <= OrderManager::$_oMaxPage; $i++)
        renderOrderTablePage($i, $i == OrderManager::$_oCurrentPage);

    renderOrderTablePageControl(0, OrderManager::$_oCurrentPage != OrderManager::$_oMaxPage ? OrderManager::$_oCurrentPage + 1 : OrderManager::$_oMinPage);

?>

</ul>

<table class="table table-inverse">
    <thead>
        <tr>
            <th>Eil. Nr.</th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>El. Paštas</th>
            <th>Tel. Numeris</th>
            <th>Adresas</th>
            <th>Papildoma Informacija</th>
        </tr>
    </thead>
    <tbody>
        <?php

            foreach(OrderManager::$_oItems as $oItem)
                _renderOrderRow($oItem);

        ?>
    </tbody>
</table>