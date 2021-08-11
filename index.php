<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Core\Sessao;


$sessao = new Sessao();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * SISTEMA ROTAS
 */
$route->group(null);
$route->get("/", "Web:login");
$route->post("/", "Web:login");

$route->get("/registro", "Web:registro");
$route->post("/registro", "Web:registro");


$route->group(null);
$route->get("/home", "Sistema:home");

$route->get("/encomendas", "Encomendas:encomendas");
$route->get("/encomenda", "Encomendas:encomenda");
$route->post("/encomenda", "Encomendas:encomenda");
$route->get("/encomenda/{id}", "Encomendas:encomenda");
$route->post("/encomenda/{id}", "Encomendas:encomenda");
$route->get("/detalhe-encomenda/{id}", "Encomendas:detalheEncomenda");


$route->get("/apartamentos", "Apartamentos:apartamentos");
$route->get("/apartamento", "Apartamentos:apartamento");
$route->post("/apartamento", "Apartamentos:apartamento");
$route->get("/apartamento/{id}", "Apartamentos:apartamento");
$route->post("/apartamento/{id}", "Apartamentos:apartamento");


$route->get("/moradores", "Moradores:moradores");
$route->get("/morador", "Moradores:morador");
$route->post("/morador", "Moradores:morador");
$route->get("/morador/{id}", "Moradores:morador");
$route->post("/morador/{id}", "Moradores:morador");
$route->get("/perfil", "Moradores:perfil");
$route->get("/edit-perfil", "Moradores:editPerfil");
$route->post("/edit-perfil", "Moradores:editPerfil");
$route->get("/detalhe-morador/{id}", "Moradores:detalheMorador");


$route->get("/usuarios", "Usuarios:usuarios");
$route->get("/usuario", "Usuarios:usuario");
$route->post("/usuario", "Usuarios:usuario");
$route->get("/usuario/{id}", "Usuarios:usuario");
$route->post("/usuario/{id}", "Usuarios:usuario");



$route->get("/sair", "Sistema:sair");


$route->group("/ops");
$route->get("/{errcode}", "Web:error");


/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
