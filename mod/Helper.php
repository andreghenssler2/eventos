<?php

class Helper
{
    public static function moeda($valor)
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public static function data($data)
    {
        return date('d/m/Y', strtotime($data));
    }

    public static function limpar($texto)
    {
        return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
    }

    public static function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }

    public static function token($tamanho = 32)
    {
        return bin2hex(random_bytes($tamanho));
    }
}