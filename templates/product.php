<?php 

    //kk so it appears that I can only call include_once on a file once.
    //So then lets have a function for rendering :/.
    //Maybe there is better soliution for this problem, but I have only 5 days so this will do.
    function _renderProduct($product) {

        echo '
            <div class="card">
                <!--<img class="card-img-top" src="..." alt="Card image cap">-->
            
                <div class="card-block">
                    <h4 class="card-title">' . $product->getName() . '</h4>
                    <p class="card-text">' . $product->getDescription() . '</p>
                    <h5>' . $product->getCost(). ' €</h5>
            
                    <div class="bottom">
                        <button class="btn btn-outline-success">Pridėti prie krepšelio</button>
                    </div>
                </div>
            
            </div>
        ';

    }

    function _renderProductsTop($minPage, $currPage, $maxPage, $searchText) {

        //Start of top block
        echo '<center>';

        //Search Form
        echo '
            <form class="inline-form search-form' . ($minPage <= $maxPage ? ' search-form-wpg' : '') . '" action="index.php#products-container" method="get">
                <input type="hidden" id="page" name="page" value="index">
                <input type="hidden" id="pPage" name="pPage" value="1">
                <input type="text" class="form-control" id="pSearch" name="pSearch" placeholder="Paieška" value="' . $searchText . '">
                <button type="submit" class="btn btn-outline-success" id="pSearchSubmit" name="pSearchSubmit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        ';

        //We dont want any pages when there's no items at all.
        if($minPage <= $maxPage) {
            //Start of pagination.
            echo '<ul class="pagination">';

            //Pagination content
            _renderPageControl(1, $currPage != $minPage ? $currPage - 1 : $maxPage, $searchText);
                
            for($i = $minPage; $i <= $maxPage; $i++)
                _renderPage($i, $i == $currPage, $searchText);

            _renderPageControl(0, $currPage != $maxPage ? $currPage + 1 : $minPage, $searchText);

            //End of pagination
            echo '</ul>';

            //End of top block.
            echo '</center>';
        }

        else
            echo '
            <center class="alert alert-danger">Nėra jokių produktų tokiu pavadinimu!</center>
            ';

    }

    function _renderPage($pageNum, $active, $searchText) {
        if($active)
            echo '<li class="page-item"><span class="page-link active">' . $pageNum . '</span></li>';
        else
            echo '<li class="page-item"><a class="page-link" href="' . Page::getCurrentURL() . '&pPage=' . $pageNum . '&pSearch=' . $searchText . '#products-container">' . $pageNum . '</a></li>';
    }

    //$dir = 0 (right)
    //$dir = 1 (left)
    function _renderPageControl($dir, $pageNum, $searchText) {
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