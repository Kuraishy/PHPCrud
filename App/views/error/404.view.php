<!-- importando componentes -->
<!-- como index.php a importando el archivo helpers.php y index.php -->
<!-- llama a este archivo, la importancion pasa al child (este archivo) -->
<!-- por lo cual ya no se necesita importar helpers.php y se pueden usar -->
<!-- sus funciones -->
<?php
// require basePath('views/partials/head.php');
loadPartial("head");
?>
<!-- Nav -->
<?php
// require basePath("views/partials/navbar.php");
loadPartial("navbar");
?>
<!-- Top Banner -->
<!-- <php loadPartial("top-banner"); ?> -->
<!--  ERROR -->


<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">404 Error</div>
        <p class="text-center text-2xl mb-4">
            This page does not exist
        </p>
    </div>
</section>


<!-- Bottom Banner -->
<!-- ?php loadPartial("bottom-banner"); ?> -->
<!-- Footer -->
<?php loadPartial("footer"); ?>