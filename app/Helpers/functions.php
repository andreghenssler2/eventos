<?php

function redirect($url)
{
    header("Location: " . $url);
    exit;
}

function dd($dados)
{
    echo "<pre>";
    print_r($dados);
    echo "</pre>";
    die();
}

function limpar($texto)
{
    return htmlspecialchars(trim($texto));
}

function gerarToken($tamanho = 40)
{
    return bin2hex(random_bytes($tamanho / 2));
}

function moeda($valor)
{
    return "R$ " . number_format($valor, 2, ",", ".");
}

function dataBrasil($data)
{
    return date("d/m/Y", strtotime($data));
}