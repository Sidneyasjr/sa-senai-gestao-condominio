<?php
/**
 * BANCO DE DADOS
 */
const CONF_DB_HOST = "localhost";
const CONF_DB_USER = "root";
const CONF_DB_PASS = "root";
const CONF_DB_NAME = "db_sa";

/**
 * URLs DO PROJETO
 */
const CONF_URL_BASE = "https://localhost/gest-residents";

/**
 * DATES
 */
const CONF_DATE_BR = "d/m/Y H:i";
const CONF_DATE_APP = "Y-m-d H:i";

/**
 * PASSWORD
 */
const CONF_SENHA_MIN_LEN = 6;
const CONF_SENHA_MAX_LEN = 40;
const CONF_SENHA_ALGO = PASSWORD_DEFAULT;
const CONF_SENHA_OPTION = ["cost" => 10];


/**
 * VIEW
 */
const CONF_VISAO_PASTA = __DIR__ . "/../../shared/views";
const CONF_VISAO_EXT = "php";
const CONF_VISAO_SISTEMA = "sistema";