<?php
    ## Crear clave unica
    $clave = 'aes-256-ctr is arguably the best choice for cipher algorithm as of 2016. This avoids potential security issues (so-called padding oracle attacks) and bloat from algorithms that pad data to a certain block size. aes-256-gcm is preferable, but not usable until the openssl library is enhanced, which is due in PHP 7.1';
    $metodo = 'aes-256-cbc';
    $iv = base64_decode("7gJNTREF1wOnBe9YIFaoeQ==");

    # encriptar la clave dada
    $encriptar = function($valor) use ($metodo, $clave, $iv) {
        return openssl_encrypt($valor, $metodo, $clave, 0, $iv);
    };

    # desencriptar clave dada
    $desencriptar = function($valor) use ($metodo, $clave, $iv) {
        $dato_encriptado = base64_decode($valor);
        return openssl_decrypt($dato_encriptado, $metodo, $clave, 0, $iv);
    };

    # generear un valor IV
    $getIv = function() use ($metodo){
        return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($metodo)));
    };
?>