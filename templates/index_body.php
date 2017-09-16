<?php Page::_loadTemplate("navbar"); ?>

<div class="spacer2x"></div>

<div class="container-fluid main-container center bg-dark">
    <h1 class="display-4">Kodėl verta pirkti Print3D Spausdintuvą?</h1>
</div>
<div class="container-fluid main-container bg-dark2">
    <div class="media left">
        <i class="fa fa-clock-o fa-fw fa-5x d-flex"></i>
            
        <div class="media-body">
            <h4 class="mt-0">Dvigubai trumpesnis spausdinimo laikas, nei konkurentų spausdintuvuose!</h4>
            <font>
                Print3D spausdintuvai naudoja naują Print3D&trade; materiją, kuri pilnai tinka spausdinimui, bei greičiau stingsta, nei mūsų konkurentų naudojamos medžiagos. 
                Būtent todėl mūsų spausdintuvai yra dvigubai greitesni!
            </font>
        </div>
    </div>
</div>
<div class="container-fluid main-container bg-dark">
    <div class="media right">
    <div class="media-body">
        <h4 class="mt-0">Žymiai pigesnis produktas</h4>
        <font>
            Kadangi Print3D&trade; materija labiau tinka 3D spausdinimui negu bet kokia kita materija, galėjome iš standartinio 3D spausdintuvo panaikinti kelis komponentus, 
            taip sumažindami gaminimo kaštus.
        </font>
    </div>

        <i class="fa fa-money fa-5x fa-fw d-flex"></i>
    </div>
</div>
<div class="container-fluid main-container bg-dark2">
    <div class="media left">
        <i class="fa fa-wrench fa-5x fa-fw d-flex"></i>
            
        <div class="media-body">
            <h4 class="mt-0">5 Metų garantija</h4>
            <font>
                Kadangi mums yra svarbiausia yra tobulinti 3D spausdinimo sferą, ir auginti žmonių pasitikėjimą mumis. Mes savo produkcijai skiriame 5 metų garantiją.
            </font>
        </div>
    </div>
</div>
<div class="container-fluid end-container bg-dark"></div>

<div class="spacer"></div>

<div class="container-fluid main-container center bg-dark">
    <h1 class="display-4">Kaip užsisakyti Print3D spausdintuvą?</h1>
</div>

<div class="container-fluid main-container center bg-dark2" id="products-container">

    <form action="index.php?page=orders" method="post">

        <h4>Norint užsisakyti 3D spausdintuvą už 200&euro; jums reikia užpildyti šią formą, o vėliau mes patys su jumis susisieksime per 5 darbo dienas!</h3>

        <input class="form-control form-control-small first" type="text" id="orderName" name="orderName" placeholder="Vardas">
        <input class="form-control form-control-small second" type="text" id="orderSurname" name="orderSurname" placeholder="Pavardė"></br>
        <input class="form-control" type="tel" id="orderPhone" name="orderPhone" placeholder="Telefono numeris">
        <input class="form-control" type="email" id="orderMail" name="orderMail" placeholder="El. Paštas">
        <input class="form-control" type="text" id="orderAddress" name="orderAddress" placeholder="Adresas">
        <input class="form-control" type="text" id="orderInfo" name="orderInfo" placeholder="Papildoma informacija (Šis laukelis nėra būtinas)">
        <input class="form-control btn btn-outline-success" style="margin-bottom: 0px;" type="submit" id="orderSubmit" name="orderSubmit" value="Užsakyti">

    </form>

</div>

<div class="container-fluid end-container bg-dark"></div>

<?php Page::_loadTemplate("copyright") ?>