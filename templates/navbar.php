
<nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <a class="navbar-brand" href="#">Items4You</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent" requestedPage=<?php echo "\"" . Page::getPageName() . "\"" ?>>
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="index.php?page=index" pageName="index">
                <i class="fa fa-fw fa-home" aria-hidden="true"></i> 
                Pradžia
            </a>
            <a class="nav-item nav-link" href="index.php?page=orders" pageName="orders">
                <i class="fa fa-fw fa-handshake-o" aria-hidden="true"></i> 
                Užsakymai
            </a>
        </div>
    </div>

</nav>