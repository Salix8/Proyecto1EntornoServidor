<?php
    require_once __DIR__ . "/../exceptions/QueryException.php";
    require_once __DIR__ . "/Connection.php";
    require_once __DIR__ . "/../core/App.php";

    class QueryBuilder {
        /**
         * @param var $connection
         */
        private $connection;

        /**
         * @var string
         */
        private $table;

        /**
         * @var string
         */
        private $classEntity;


        public function __construct(string $table = "", string $classEntity = ""){
            $this->connection =  App::get('connection');
            $this->table = $table;
            $this->classEntity = $classEntity;
        }

        public function findAll() {
            $sql = "SELECT * FROM $this->table";
            try {
                $pdoStatement = $this->connection->prepare($sql);
                $pdoStatement->execute();
                $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
                return $pdoStatement->fetchAll();
                
            } catch (\PDOException $pdoException) {
                throw new QueryException("No se ha podido ejecutar la consulta solicitada: " . $pdoException->getMessage());
            }
        }
    }