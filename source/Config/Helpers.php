<?php

use Source\Models\Apartamento;
use Source\Models\Autenticacao;

/**
 * ###############
 * ###   URL   ###
 * ###############
 */
function url(string $path = null): string
{
    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE;
}

/**
 * @return string
 */
function url_back(): string
{
    return ($_SERVER['HTTP_REFERER'] ?? url());
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }
    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

/**
 * ##################
 * ###   ASSETS   ###
 * ##################
 */

/**
 * @param string|null $path
 * @return string
 */
function theme(string $path = null): string
{
    if ($path) {
        return CONF_URL_BASE . "/themes/" . CONF_VISAO_SISTEMA . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE . "/themes/" . CONF_VISAO_SISTEMA;
}


/**
 * ####################
 * ###   VALIDAÇÃO   ###
 * ####################
 */

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $senha
 * @return bool
 */
function is_senha(string $senha): bool
{
    if (password_get_info($senha)['algo'] || (mb_strlen($senha) >= CONF_SENHA_MIN_LEN && mb_strlen($senha) <= CONF_SENHA_MAX_LEN)) {
        return true;
    }

    return false;
}


/**
 * ################
 * ###   DATAS   ###
 * ################
 */

/**
 * @param string|null $data
 * @param string $formato
 * @return string
 * @throws Exception
 */
function data_fmt(?string $data, string $formato = "d/m/Y"): string
{
    if ($data) {
        return (new DateTime($data))->format($formato);
    }
    return false;
}


/**
 * @param string|null $data
 * @return string
 * @throws Exception
 */
function data_fmt_br(?string $data): string
{
    if ($data) {
        return (new DateTime($data))->format(CONF_DATE_BR);
    }
    return false;
}


/**
 * @param string|null $data
 * @return string
 * @throws Exception
 */
function data_fmt_app(?string $data): string
{
    $data = (empty($data) ? "" : $data);
    return (new DateTime($data))->format(CONF_DATE_APP);
}


/**
 * @param string|null $data
 * @return string|null
 */
function data_fmt_back(?string $data): ?string
{
    if (!$data) {
        return null;
    }

    if (strpos($data, " ")) {
        $data = explode(" ", $data);
        return implode("-", array_reverse(explode("/", $data[0]))) . " " . $data[1];
    }

    return implode("-", array_reverse(explode("/", $data)));
}

function dateTime_fmt_back(?string $data): ?string
{
    if (!$data) {
        return null;
    }
    $data = explode("T", $data);
    return implode(" ", $data);
}


function dateTime_fmt_front(?string $data): ?string
{
    if (!$data) {
        return null;
    }
    $data = explode(" ", $data);
    return implode("T", $data);
}

/**
 * ####################
 * ###   SENHA   ###
 * ####################
 */

/**
 * @param string $senha
 * @return string
 */
function senha(string $senha): string
{
    if (!empty(password_get_info($senha)['algo'])) {
        return $senha;
    }

    return password_hash($senha, CONF_SENHA_ALGO, CONF_SENHA_OPTION);
}

/**
 * @param string $senha
 * @param string $hash
 * @return bool
 */
function senha_verificada(string $senha, string $hash): bool
{
    return password_verify($senha, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function senha_rehash(string $hash): bool
{
    return password_needs_rehash($hash, CONF_SENHA_ALGO, CONF_SENHA_OPTION);
}

/**
 * ######################
 * ###   REQUISIÇÃO   ###
 * ######################
 */

function csrf_input(): string
{
    $sessao = new \Source\Core\Sessao();
    $sessao->csrf();
    return "<input type='hidden' name='csrf' value='" . ($sessao->csrf_token ?? "") . "'/>";
}

/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool
{
    $sessao = new \Source\Core\Sessao();
    if (empty($sessao->csrf_token) || empty($request['csrf']) || $request['csrf'] != $sessao->csrf_token) {
        return false;
    }
    return true;
}

/**
 * @return string|null
 */
function flash(): ?string
{
    $sessao = new \Source\Core\Sessao();
    if ($flash = $sessao->flash()) {
        return $flash;
    }
    return null;
}

function buscarApto(?int $apartamento_id): string
{
    if ($apartamento_id) {
        $apartamento = (new Apartamento())->buscarPorId($apartamento_id);
        return "Torre-Apto: {$apartamento->torre}-{$apartamento->apartamento}";
    }
    return false;
}

function buscarMorador(int $morador_id): string
{
    $morador = (new  \Source\Models\Morador())->buscarPorId($morador_id);
    if ($morador) {
        return "{$morador->nome} {$morador->sobrenome}";
    }
    return false;
}

function sindico($usuario): bool
{
    $usuario = Autenticacao::usuario();
    if ($usuario->tipo == "SINDICO") {
        return true;
    }
    return false;
}

function qtdMoradores($apartamento_id): int
{
    $moradores = (new \Source\Models\Morador())->buscar("apartamento_id = :apartamento_id", "apartamento_id={$apartamento_id}");
    return $moradores->contagem();
}

function calc_idade($nascimento)
{
    if ($nascimento) {
        $nascimento = explode('-', $nascimento);
        $data = date('Y-m-d');
        $data = explode('-', $data);
        $anos = $data[0] - $nascimento[0];
        if ($nascimento[1] > $data[1]) return $anos - 1;
        if ($nascimento[1] == $data[1]) {
            if ($nascimento[2] <= $data[2]) {
                return $anos;
            } else {
                return $anos - 1;
            }
        }
        return $anos;
    }
    return false;
}

function morador($usuario): bool
{
    $usuario = Autenticacao::usuario();
    if ($usuario->tipo == "MORADOR") {
        return true;
    }
    return false;
}

function usuarioNomeCompleto(?int $usuario_id): string
{
    if ($usuario_id) {
        $usuario = (new \Source\Models\Usuario())->buscarPorId(3);
        return "{$usuario->nome} {$usuario->sobrenome}";
    }
    return false;
}