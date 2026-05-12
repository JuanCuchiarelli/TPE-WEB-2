<?php

class ErrorView {
    protected $user;

    public function setUser($user) {
        $this->user = $user;
    }

    public function renderError($err = null) {
        require __DIR__ . '/templates/layout/header.phtml';
        require __DIR__ . '/templates/error.phtml';
        require __DIR__ . '/templates/layout/footer.phtml';
    }

}