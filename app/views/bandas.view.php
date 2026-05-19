<?php

class BandasView{
    public function renderBandas($bandas){
        require __DIR__ . '/templates/layout/header.phtml';
        require __DIR__ . '/templates/bandas.phtml';
        require __DIR__ . '/templates/layout/footer.phtml';
    }
<<<<<<< HEAD

    public function showAdminPanel($bandas) {
        require_once __DIR__ . '/templates/layout/header.phtml';
        require_once __DIR__ . '/templates/adminBandas.phtml';
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }

    public function renderEditForm($banda){
        require __DIR__ . '/templates/layout/header.phtml';
        require __DIR__ . '/templates/editBandas.phtml';
        require __DIR__ . '/templates/layout/footer.phtml';
    }
=======
>>>>>>> 4e7772db04f094b9a25864ce9fc0483579a7664e
}