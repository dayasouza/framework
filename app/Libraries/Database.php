<?php

/**
 * Classe Database
 *
 * Esta classe representa uma conexão com um banco de dados MySQL utilizando PDO.
 */
class Database{

    // Configurações de conexão
    private $host = DB['HOST'];
    private $user = DB['USERNAME'] ;
    private $password = DB['PASSWORD'];
    private $db = DB['BANCO'];
    private $porta = DB['PORTA'] ;

    // Objetos PDO para manipulação de banco de dados
    private $dbh ;
    private $stmt;    

    /**
     * Construtor da classe.
     *
     * Este método é chamado automaticamente ao instanciar um objeto Database.
     * Ele estabelece uma conexão com o banco de dados utilizando as configurações fornecidas.
     */
    public function __construct()
    {
        // Construindo a string DSN para o MySQL
        $dsn = 'mysql:host=' . $this -> host . ';port=' . $this -> porta . ';dbname=' . $this -> db;
        // Opções para a conexão PDO
        $opcoes = [
            // Conexão persistente
            PDO::ATTR_PERSISTENT => TRUE, 
            // Modo de tratamento de erros
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            // Tentativa de estabelecer a conexão PDO
            $this -> dbh = new PDO($dsn, $this-> user, $this-> password, $opcoes);
        } catch (PDOException $e) {
            // Em caso de erro, exibe uma mensagem de erro e encerra o script
            print "Error!: " . $e -> getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Prepara uma consulta SQL para execução.
     *
     * Esta função recebe uma string contendo uma consulta SQL, a prepara
     * utilizando a conexão do banco de dados existente e associa o
     * resultado ao objeto interno $stmt.
     *
     * @param string $sql A consulta SQL a ser preparada.
     * @return void
     */
    public function query($sql){
        // Prepara a consulta SQL usando a conexão do banco de dados
        $this -> stmt = $this -> dbh -> prepare($sql);
    }

    /**
     * Método bind
     *
     * Este método associa um valor a um parâmetro na consulta SQL preparada.
     *
     * @param string $parametro O nome do parâmetro na consulta SQL.
     * @param mixed $valor O valor a ser associado ao parâmetro.
     * @param int|null $tipo (Opcional) O tipo do parâmetro. Se não fornecido, será detectado automaticamente.
     * @return void
     */
    public function bind($paremtro, $valor, $tipo = null)
    {
        // Verifica se o tipo do parâmetro não foi fornecido
        if (is_null($tipo)) {
            // Detecta automaticamente o tipo do parâmetro com base no valor fornecido
            switch (true) {
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                
                default:
                    $tipo = PDO::PARAM_STR;
                    break;
            }
        }
        // Associa o valor ao parâmetro na consulta SQL preparada
        $this -> stmt -> bindValue($paremtro, $valor, $tipo);
    }

    /**
     * Método executa
     *
     * Este método executa a consulta SQL preparada e retorna o resultado da execução.
     *
     * @return bool True se a execução foi bem-sucedida, false em caso de erro.
     */
    public function executa()
    {
        // Executa a consulta SQL preparada e retorna o resultado da execução
        return $this -> stmt -> execute();
    }

    /**
     * Método resultado
     *
     * Este método executa a consulta SQL preparada e retorna a primeira linha do resultado como um objeto.
     *
     * @return object|false Retorna um objeto representando a primeira linha do resultado se houver, ou false se ocorrer um erro.
     */
    public function resultado()
    {
        // Executa a consulta SQL preparada
        $this -> executa();
        // Retorna a primeira linha do resultado como um objeto
        return $this -> stmt -> fetch (PDO::FETCH_OBJ);
    }

    /**
     * Método resultados
     *
     * Este método executa a consulta SQL preparada e retorna todas as linhas do resultado como um array de objetos.
     *
     * @return array|false Retorna um array contendo objetos representando todas as linhas do resultado se houver, ou false se ocorrer um erro.
     */
    public function resultados()
    {
        // Executa a consulta SQL preparada
        $this -> executa();
        // Retorna todas as linhas do resultado como um array de objetos
        return $this -> stmt -> fetchAll (PDO::FETCH_OBJ);
    }

    /**
     * Método totalResultados
     *
     * Este método retorna o número total de linhas afetadas pelo resultado da última consulta.
     *
     * @return int O número total de linhas afetadas pelo resultado da última consulta.
     */
    public function totalResultados()
    {   
        // Utiliza o método rowCount() do objeto $stmt para obter o número total de linhas afetadas
        return $this-> stmt -> rowCount();
    }

    /**
     * Método ultimoIdInserido
     *
     * Este método retorna o último ID inserido durante a execução de uma consulta INSERT.
     *
     * @return string O último ID inserido como uma string.
     */
    public function ultimoIdInserido()
    {
        // Utiliza o método lastInsertId() do objeto $dbh para obter o último ID inserido
        return $this-> dbh -> lastInsertId();
    }

}
