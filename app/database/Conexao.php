<?php

class Conexao{

    /**
     * Variveis para acesso ao banco de dados
     */
    private $dsn     = 'mysql:host=localhost;dbname=imobi';
    private $user       = 'root';
    private $password   = '';

    /**
     * Tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia de conexao com o banco de dados
     * @var PDO
     */
    protected $connection;

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param table $table
     * 
     */
    public function __construct($table = null)
    {
        $this->setTable($table);
        $this->setConnection();
    }

    /**
     * Metodo responsavel por criar uma conexao com o banco
     */
    private function setConnection(){
        try
        {
            $this->connection = new PDO($this->dsn,$this->user,$this->password);   
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       

        } 
        catch (PDOException $e) 
        {
            die('Error: '.$e->getMessage());
        }
    }

    /**
     * metodo responsavel por executar queries dentro do banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query,$params = []){

        try 
        {
           $statement = $this->connection->prepare(($query));
           $statement->execute($params);
           return $statement;

        } 
        catch (PDOException $e) 
        {
            die('Error: '.$e->getMessage());
        }

    }

    /**
     * *********** GETTERS AND SETTERS ***********
     */

    public function setTable( $table ){
        $this->table = $table;
    }

    public function getTable(){
        return $this->table;
    }
}