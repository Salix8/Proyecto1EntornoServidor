<?php

require_once __DIR__ . '/../entity/Usuario.php.php';
require_once __DIR__ . '/../database/QueryBuilder.php';

class UsuarioRepository extends QueryBuilder {

    public function __construct(){

        parent::__construct('usuarios', 'Usuario');

    }


    public function findByUserNameAndPassword(string $username, string $password): ?Usuario {
        $sql = "SELECT * FROM $this->table WHERE username = :username AND password = :password";
        $parameters = ["username" => $username,
                      "password" => $password];
        try {
            $pdoStatement = $this->connection->prepare($sql);
            $pdoStatement->execute($parameters);
            $pdoStatement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->classEntity);
            $result = $pdoStatement->fetchAll();
            if (empty($result)) {
                throw new NotfoundException("No se ha encontrado ningún usuario con esas credenciales");
            }
            return $result[0];
            
        } catch (\PDOException $pdoException) {
            throw new QueryException("No se ha podido ejecutar la consulta solicitada: " . $pdoException->getMessage());
        }
        return null;
    }

}

