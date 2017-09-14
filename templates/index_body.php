<?php 

    Page::_loadTemplate("navbar");

?>

<div class="spacer2x"></div>

<div class="container-fluid main-container center bg-dark">
    <h1 class="display-4">Kodėl verta pirkti mūsų produkciją?</h1>
</div>
<div class="container-fluid main-container bg-dark2">
    <div class="media left">
        <i class="fa fa-wrench fa-5x d-flex"></i>
            
        <div class="media-body">
            <h4 class="mt-0">Blah blah blah blah blah blah</h4>
            <font>
                Blah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blah.
                Blah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blah.
            </font>
        </div>
    </div>
</div>
<div class="container-fluid main-container bg-dark">
    <div class="media right">
    <div class="media-body">
        <h4 class="mt-0">Blah blah blah blah blah blah</h4>
        <font>
            Blah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blah.
            Blah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blah.
        </font>
    </div>

        <i class="fa fa-wrench fa-5x d-flex"></i>
    </div>
</div>
<div class="container-fluid main-container bg-dark2">
    <div class="media left">
        <i class="fa fa-wrench fa-5x d-flex"></i>
            
        <div class="media-body">
            <h4 class="mt-0">Blah blah blah blah blah blah</h4>
            <font>
                Blah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blah.
                Blah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blahBlah blah blah blah blah blah.
            </font>
        </div>
    </div>
</div>
<div class="container-fluid end-container bg-dark"></div>

<div class="spacer"></div>

<div class="container-fluid main-container center bg-dark">
    <h1 class="display-4">Items4You produkcija:</h1>
</div>

<div class="container-fluid main-container center bg-dark2" id="products-container">

    <?php ProductManager::renderProductsList(); ?>

</div>

<div class="container-fluid end-container bg-dark"></div>

<div class="spacer"></div>

<div class="container-fluid center bg-dark">Copyright notice</div>
