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

    function _renderProductsTop($minPage, $currPage, $maxPage) {

        echo '
            <center>
        ';

        echo '
                <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Praeitas">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Praeitas</span>
                    </a>
                </li>
        ';
              
        for($i = $minPage; $i <= $maxPage; $i++)
            _renderPage($i, $i == $currPage);

        echo '
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Kitas">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Kitas</span>
                    </a>
                </li>
                </ul>
            </center>
        ';

    }

    function _renderPage($pageNum, $active) {
        if($active)
            echo '<li class="page-item"><span class="page-link active">' . $pageNum . '</span></li>';
        else
            echo '<li class="page-item"><a class="page-link" href="' . Page::getCurrentURL() . '&pPage=' . $pageNum . '#products-container">' . $pageNum . '</a></li>';
    }

?>