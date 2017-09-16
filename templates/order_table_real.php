<?php

    global $oSearchText, $oCurrPage, $oMinPage, $oMaxPage, $oItems;

    function _renderOrderTablePage($pageNum, $active, $searchText) {
        if($active)
            echo '<li class="page-item"><span class="page-link active">' . $pageNum . '</span></li>';
        else
            echo '<li class="page-item"><a class="page-link" href="' . Page::getCurrentURL() . '&pPage=' . $pageNum . '&pSearch=' . $searchText . '#products-container">' . $pageNum . '</a></li>';
    }
    
    //$dir = 0 (right)
    //$dir = 1 (left)
    function _renderOrderTablePageControl($dir, $pageNum, $searchText) {
        echo '
        <li class="page-item">
            <a class="page-link" href="' . Page::getCurrentURL() . '&pPage=' . $pageNum . '&pSearch=' . $searchText . '#products-container" aria-label="' . ($dir ? 'Praeitas' : 'Kitas') . '">
                <span aria-hidden="true">' . ($dir ? '&laquo;' : '&raquo;') . '</span>
                <span class="sr-only">' . ($dir ? 'Praeitas' : 'Kitas') . '</span>
            </a>
        </li>
        ';
    }

?>

<ul class="pagination">

<?php

    //Pagination content
    //Originally I wanted those to be in template system, but it appears, that I only can use include_once one time :I.
    //So yeah, I still need to figure workaround.
    _renderOrderTablePageControl(1, $oCurrPage != $oMinPage ? $oCurrPage - 1 : $oMaxPage, $oSearchText);
                
    for($i = $oMinPage; $i <= $oMaxPage; $i++)
        _renderOrderTablePage($i, $i == $oCurrPage, $oSearchText);

    _renderOrderTablePageControl(0, $oCurrPage != $oMaxPage ? $oCurrPage + 1 : $oMinPage, $oSearchText);

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

            foreach($oItems as $oItem)
                _renderOrderRow($oItem);

        ?>
    </tbody>
</table>