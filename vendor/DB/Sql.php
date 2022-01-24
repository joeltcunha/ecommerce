<?php

class Sql extends PDO {
    private $conn;

//    CONEXÃO COM BANCO DE DADOS

    public function __construct()
    {
       $this->conn = new PDO("mysql:host=localhost; dbname=db_ecommerce", "root", "root@abr21");
    }

//    Percorre o DB a procura de informações
//    Os statements descrevem o que será feito no DB
//    Os parâmetros são as informações do banco de dados (linhas e colunas)

    private function setParams($statement, $parameters = array()) {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

//    Faz a pesquisa com um único valor
    private function setParam($statement, $key, $value) {
        $statement->bindParam($key, $value);
    }

//    Faz a pesquisa no DB mas não retorna valor
    public function query($rawQuery, $params = array()) {
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

//    Faz a pesquisa no DB e retorna o valor
    public function select($rawQuery, $params = array()):array{
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
