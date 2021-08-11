<?php


namespace Source\Core;


use Source\Support\Mensagem;

/**
 * Class Modelo
 * @package Source\Core
 */
class Modelo
{
    /**
     * @var
     */
    protected $dados;
    /**
     * @var
     */
    protected $falha;
    /**
     * @var Mensagem
     */
    protected $mensagem;
    /**
     * @var
     */
    protected $query;
    /**
     * @var
     */
    protected $parametros;
    /**
     * @var
     */
    protected $ordem;
    /**
     * @var
     */
    protected $limite;
    /**
     * @var
     */
    protected $offset;
    /**
     * @var string
     */
    protected  $entidade;
    /**
     * @var array
     */
    protected $protegido;
    /**
     * @var array
     */
    protected $requerido;

    /**
     * Modelo constructor.
     * @param string $entidade
     * @param array $protegido
     * @param array $requerido
     */
    public function __construct(string $entidade, array $protegido, array $requerido)
    {
        $this->entidade = $entidade;
        $this->protegido = array_merge($protegido, []);
        $this->requerido = $requerido;
        $this->mensagem = new Mensagem();
    }

    /**
     * @param $nome
     * @param $valor
     */
    public function __set($nome, $valor)
    {
        if (empty($this->dados)) {
            $this->dados = new \stdClass();
        }
        $this->dados->$nome = $valor;
    }

    /**
     * @param $nome
     * @return bool
     */
    public function __isset($nome)
    {
        return isset($this->dados->$nome);
    }

    /**
     * @param $nome
     * @return null
     */
    public function __get($nome)
    {
        return ($this->dados->$nome ?? null);
    }

    /**
     * @return object|null
     */
    public function dados(): ?object
    {
        return $this->dados;
    }

    /**
     * @return mixed
     */
    public function falha(): ?\PDOException
    {
        return $this->falha;
    }

    /**
     * @return Mensagem|null
     */
    public function mensagem(): ?Mensagem
    {
        return $this->mensagem;
    }

    /**
     * @param string|null $termos
     * @param string|null $parametros
     * @param string $colunas
     * @return Modelo|mixed
     */
    public function buscar(?string $termos = null, ?string $parametros = null, string $colunas = "*", ?string $join = null)
    {
        if ($termos) {
            $this->query = "SELECT {$colunas} FROM {$this->entidade} {$join} WHERE {$termos}";
            parse_str($parametros, $this->parametros);;
            return $this;
        }

        $this->query = "SELECT {$colunas} FROM {$this->entidade}";
        return $this;
    }

    /**
     * @param int $id
     * @param string $colunas
     * @return Modelo|null
     */
    public function buscarPorId(int $id, string $colunas = "*"): ?Modelo
    {
        $buscar = $this->buscar("id = :id", "id={$id}", $colunas);
        return $buscar->fetch();
    }

    /**
     * @param string $colunaOrdem
     * @return $this
     */
    public function ordem(string $colunaOrdem): Modelo
    {
        $this->ordem = " ORDER BY {$colunaOrdem}";
        return $this;
    }

    /**
     * @param int $limite
     * @return $this
     */
    public function limite(int $limite): Modelo
    {
        $this->limite = " LIMIT {$limite}";
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function offset(int $offset): Modelo
    {
        $this->offset = " OFFSET {$offset}";
        return $this;
    }

    /**
     * @param bool $todos
     * @return null|array|mixed|Modelo
     */
    public function fetch()
    {

        try {
            $stmt = Conexao::getInstace()->prepare($this->query . $this->ordem . $this->limite . $this->offset);
            $stmt->execute($this->parametros);
            if (!$stmt->rowCount()) {
                return null;
            }
            return $stmt->fetchObject(static::class);
        } catch (\PDOException $exception) {
            $this->falha = $exception;
            return null;
        }
    }

    public function fetchall()
    {
        try {
            $stmt = Conexao::getInstace()->prepare($this->query . $this->ordem . $this->limite . $this->offset);
            $stmt->execute($this->parametros);
            return $stmt->fetchAll();
        } catch (\PDOException $exception) {
            $this->falha = $exception;
            return null;
        }

    }

    public function contagem(string $chave = "id"): int
    {
        $stmt = Conexao::getInstace()->prepare($this->query);
        $stmt->execute($this->parametros);
        return $stmt->rowCount();
    }

    /**
     * @param string $chave
     * @return int
     */
    public function contar(string $chave = "id"): int
    {
        $stmt = Conexao::getInstace()->prepare($this->query);
        $stmt->execute($this->parametros);
        return $stmt->rowCount();
    }

    /**
     * @param array $dados
     * @return int|null
     */
    protected function criar(array $dados): ?int
    {
        try {
            $colunas = implode(", ", array_keys($dados));
            $valores = ":" . implode(", :", array_keys($dados));

            $stmt = Conexao::getInstace()->prepare("INSERT INTO {$this->entidade} ({$colunas}) VALUES ({$valores})");
            $stmt->execute($this->filtrar($dados));

            return Conexao::getInstace()->lastInsertId();
        } catch (\PDOException $exception) {
            $this->falha = $exception;
            return null;
        }
    }


    /**
     * @param array $dados
     * @param string $termos
     * @param string $parametros
     * @return int|null
     */
    protected function atualizar(array $dados, string $termos, string $parametros): ?int
    {
        try {
            $dataSet = [];
            foreach ($dados as $bind => $valor) {
                $dataSet[] = "{$bind} = :{$bind}";
            }
            $dataSet = implode(", ", $dataSet);
            parse_str($parametros, $parametros);

            $stmt = Conexao::getInstace()->prepare("UPDATE {$this->entidade} SET {$dataSet} WHERE {$termos}");
            $stmt->execute($this->filtrar(array_merge($dados, $parametros)));
            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $exception) {
            $this->falha = $exception;
            return null;
        }
    }

    /**
     * @param string $termos
     * @param string|null $parametros
     * @return bool
     */
    public function deletar(string $termos, ?string $parametros): bool
    {
        try {
            $stmt = Conexao::getInstace()->prepare("DELETE FROM {$this->entidade} WHERE {$termos}");
            if ($parametros) {
                parse_str($parametros, $parametros);
                $stmt->execute($parametros);
                return true;
            }

            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            $this->falha = $exception;
            return false;
        }
    }

    public function salvar(): bool
    {

        if (!$this->requerido()) {
            $this->mensagem->aviso("Preencha todos os campos para continuar");
            return false;
        }

        /** Update */
        if (!empty($this->id)) {
            $id = $this->id;
            $this->atualizar($this->seguro(), "id = :id", "id={$id}");
            if ($this->falha()) {
                $this->mensagem->erro("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Create */
        if (empty($this->id)) {
            $id = $this->criar($this->seguro());
            if ($this->falha()) {
                $this->mensagem->erro("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->dados = $this->buscarPorId($id)->dados();
        return true;
    }

    /**
     * @return bool
     */
    public function excluir(): bool
    {
        if (empty($this->id)) {
            return false;
        }

        $deletar = $this->deletar("id = :id", "id={$this->id}");
        return $deletar;
    }

    /**
     * @return array|null
     */
    protected function seguro(): ?array
    {
        $seguro = (array)$this->dados;
        foreach ($this->protegido as $unset) {
            unset($seguro[$unset]);
        }
        return $seguro;
    }

    /**
     * @param array $dados
     * @return array|null
     */
    private function filtrar(array $dados): ?array
    {
        $filtrar = [];
        foreach ($dados as $chave => $valor) {
            $filtrar[$chave] = (is_null($valor) ? null : filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
        }
        return $filtrar;
    }

    protected function requerido(): bool
    {
        $dados = (array)$this->dados();
        foreach ($this->requerido as $campo) {
            if (empty($dados[$campo])) {
                return false;
            }
        }
        return true;
    }
}