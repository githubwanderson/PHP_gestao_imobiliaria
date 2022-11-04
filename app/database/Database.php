<?php

require __DIR__.'/Conexao.php';

class database extends Conexao{

    /**
     * *********** CONSTRUCT ***********
     * 
     * @param table $table
     * 
     */
    public function __construct( $table )
    {
        parent::__construct($table );
    }

    /**
     * metodo responsavel por inserir dados no banco
     * @param array $values [ field => value ]
     * @return integer id
     */
    public function insert($values){

        // dados da query 
        // pegando apenas as chaves do array
        $fields = array_keys($values);
        
        // pagando a qtde de campos de $values e criando um novo array com value = '?' por elemento x qtde de campso
        $binds  = array_pad([],count($fields),'?');

        // criando a query
        $query = 'INSERT INTO '.$this->getTable().' ('.implode(",",$fields).') VALUES ('.implode(",",$binds).')';
      
        // executando 
        // array_values pega apenas os valores do array sem as chaves        
        $this->execute( $query , array_values($values));  

        // retorna o id inserido
        return $this->connection->lastInsertId();
    }

    /**
     * metodo responsavel por executar uma consulta no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatement
     */
    public function select( $where = null , $join = null , $order = null , $limit = null , $fields = '*'){

        //dados da query
        $join = strlen($join) ? ' JOIN '.$join : '';
        $where = strlen($where) ? ' WHERE '.$where : '';
        $order = strlen($order) ? ' ORDER BY '.$order : '';
        $limit = strlen($limit) ? ' LIMIT '.$limit : '';

        $table = $this->getTable();

        //monta a query
        $query = "SELECT $fields FROM $table $join $where $order $limit";

        //executa a query
        return $this->execute($query);
    }


    /**
     * @param string $where
     * @param array $values [ field => value]
     * @return boolean
     */
    public function update( $where , $values ){

        //dados da query
        $fields = array_keys($values);
        $fields = implode('=?,',$fields);

        //monta a query
        $query = 'UPDATE '.$this->getTable().' SET '.$fields.' =? WHERE '.$where;

        //executa a query
        $this->execute( $query , array_values( $values ));

        //se nao ocorrer nem erro na chamada do metodo execute() entao retorne true
        return true;

    }

}