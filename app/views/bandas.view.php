<?php

class BandasView{
    public function renderBandas($bandas){
        require __DIR__ . '/templates/layout/header.phtml';
        require __DIR__ . '/templates/bandas.phtml';
        require __DIR__ . '/templates/layout/footer.phtml';
    }
}