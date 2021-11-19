<?php
    require_once __DIR__ . "/../exceptions/QueryException.php";
    require_once __DIR__ . "/Connection.php";
    require_once __DIR__ . "/../core/App.php";
    require_once __DIR__ . "/../entity/Entity.php";

    abstract class QueryBuilder {
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


        public function __construct(string $table, string $classEntity){
            $this->connection =  App::get('connection');
            $this->table = $table;
            $this->classEntity = $classEntity;
        }

        public function findAll() {
            $sql = "SELECT * FROM $this->table";
            return $this->executeQuery($sql);
        }

        public function save(Entity $entity) {
            try {
                $parameters = $entity->toArray();
                $sql = sprintf(
                    "INSERT INTO %s (%s) VALUES (%s)",
                    $this->table,
                    implode(", ", array_keys($parameters)),
                    ":" . implode(", :", array_keys($parameters))
                );
                $statement = $this->connection->prepare($sql);
                $statement->execute($parameters);

            } catch (\PDOException $pdoException) {
                throw new QueryException("Error al insertar en la base de datos: " . $pdoException->getMessage());
            }
        }

        public function executeQuery(string $sql) {
            try {
                $pdoStatement = $this->connection->prepare($sql);
                $pdoStatement->execute();
                $pdoStatement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->classEntity);
                return $pdoStatement->fetchAll();
                
            } catch (\PDOException $pdoException) {
                throw new QueryException("No se ha podido ejecutar la consulta solicitada: " . $pdoException->getMessage());
            }
        }

        public function findById(int $id) {
            $sql = "SELECT * FROM $this->table Where id=$id";
            $result = $this->executeQuery($sql);
            if (empty($result)) {
                throw new NotFoundException("No se ha encontrado ningún elemento con id $id");
            }
            return $result [0];
        }

        public function beginTransaction(callable $fnExecuteQuerys)
        {
            try {
                $this->connection->beginTransaction();
                $fnExecuteQuerys();
                $this->connection->rollBack();
            } catch (\PDOException $pdoException) {
                $this->connection->rollBack();
                throw new QueryException("No se puede realizar la operacion: " . $pdoException->getMessage());
                
            }
        }

        public function executeTransaction(callable $finExecuteQuerys){
            try {
                $this->connection->beginTransaction();
                $finExecuteQuerys();
                $this->connection->commit();
            } catch (\PDOException $pdoException) {
                $this->connection->rollBack();
                throw new QueryException("No se ha podido realizar la operacion: " . $pdoException->getMessage());
            }
        }

        /**
         * @param array $parameters
         * @return string
         */

        private function getUpdates(array $parameters): string {
            $updates = "";
            foreach ($parameters as $key => $value) {
                if ($key !== "id") {
                    if ($updates !== "") {
                        $updates .= "=:" . $key;
                    }
                }
                return $updates;
            }
        }

        /**
         * @param Entity $entity
         * @throws QueryException
         */
        public function update(Entity $entity){
            try {
                $parameters = $entity->toArray();
                $sql = sprintf(
                    "UPDATE %s SET %s WHERE id = :id ",
                    $this->table,
                    $this->getUpdates($parameters)
                );
                $statement = $this->connection->prepare($sql);
                $statement->execute($parameters);
            } catch (\PDOException $pdoException) {
                throw new QueryException("Error al actualizar el elemento con id {$parameters["id"]}: " . $pdoException->getMessage() );
                
            }
        }
    }