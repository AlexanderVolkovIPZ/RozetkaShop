<?php

namespace core;
/**
 * Клас до виконання запитів до БД
 */
class DB
{
    protected $pdo;

    public function __construct($server, $login, $password, $database)
    {

        $this->pdo = new \PDO("mysql:host={$server};dbname={$database};", $login, $password);
    }

    /**
     * @param $conditionsArray
     * @param string $sql
     * @return array
     */
    public function extracted($conditionsArray, string $sql): array
    {
        if (is_array($conditionsArray) && count($conditionsArray) > 0) {
            $whereParts = [];
            foreach ($conditionsArray as $key => $value) {
                $whereParts[] = "{$key} = ?";
            }
            $whereStr = implode(' AND ', $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }

        if (is_string($conditionsArray))
            $sql .= ' WHERE ' . $conditionsArray;
        return array($key, $value, $sql);
    }

    /**
     * Виконання запиту на отримання даних з вказаної таблиці БД
     * @param string $tableName Назва таблиці бази даних
     * @param string|array $fieldsList Список полів
     * @param array|null $conditionArray Асоціативний масив з умовою для пошуку
     * @return array|false
     */

    public function select($tableName, $fieldsList = "*", $conditionsArray = null, array $conditionLikeArray = null, $orderByArray = null, $limit = null, $offset = null)
    {
        $fieldsStr = "*";
        if (is_string($fieldsList)) {
            $fieldsStr = $fieldsList;
        }
        if (is_array($fieldsList)) {
            $fieldsStr = implode(', ', $fieldsList);
        }
        $sql = "SELECT {$fieldsStr} FROM {$tableName}";
        list($key, $value, $sql) = $this->extracted($conditionsArray, $sql);

        if (empty($conditionsArray) && !empty($conditionLikeArray)) {
            list($key, $value, $sql) = $this->extractedLike($conditionLikeArray, $sql);
        }

        if (is_array($orderByArray)) {
            $orderByParts = [];
            foreach ($orderByArray as $key => $value) {
                $orderByParts [] = "{$key} {$value}";
            }
            $sql .= ' ORDER BY ' . implode(', ', $orderByParts);
        }

        if (!empty($limit)) {
            if (!empty($offset)) {
                $sql .= " LIMIT {$offset}, {$limit}";
            } else {
                $sql .= " LIMIT {$limit}";
            }
        }

        $res = $this->pdo->prepare($sql);
        if (is_array($conditionsArray) && count($conditionsArray) > 0)
            $res->execute(array_values($conditionsArray));
        else if (isset($conditionLikeArray) && count($conditionLikeArray) > 0)
            $res->execute(array_values($conditionLikeArray));
        else
            $res->execute();
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($tableName, $fieldsList)
    {
        $fieldsArray = array_keys($fieldsList);

        $fieldsListString = implode(', ', $fieldsArray);

        $paramsArray = [];
        foreach ($fieldsList as $key => $value) {
            $paramsArray [] = ':' . $key;
        }
        $valuesListString = implode(', ', $paramsArray);
        $res = $this->pdo->prepare("INSERT INTO {$tableName} ($fieldsListString) VALUES($valuesListString)");
        $res->execute($fieldsList);

    }

    public function delete($table, $conditionArray = null)
    {
        $sql = "DELETE FROM {$table}";
        list($key, $value, $sql) = $this->extracted($conditionArray, $sql);
        $res = $this->pdo->prepare($sql);
        if (is_array($conditionArray) && count($conditionArray) > 0)
            $res->execute(array_values($conditionArray));
        else
            $res->execute();

    }

    public function update($table, $fieldsList, $conditionArray)
    {
        $sql = "UPDATE {$table} SET ";
        $setParts = [];
        $paramsArr = [];
        foreach ($fieldsList as $key => $value) {
            $setParts[] = "{$key} = ?";
            $paramsArr[] = $value;
        }
        $sql .= implode(', ', $setParts);
        if (is_array($conditionArray) && count($conditionArray) > 0) {
            $whereParts = [];
            foreach ($conditionArray as $key => $value) {
                $whereParts[] = "{$key} = ?";
                $paramsArr[] = $value;
            }
            $whereStr = implode(' AND ', $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }
        if (is_string($conditionArray))
            $sql .= ' WHERE ' . $conditionArray;
        $res = $this->pdo->prepare($sql);
        $res->execute($paramsArr);
    }

    public function extractedLike($conditionsArray, string $sql): array
    {
        if (is_array($conditionsArray) && count($conditionsArray) > 0) {
            $whereParts = [];
            foreach ($conditionsArray as $key => $value) {
                $whereParts[] = "{$key} LIKE ?";
            }
            $whereStr = implode(' AND ', $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }

        if (is_string($conditionsArray))
            $sql .= ' WHERE ' . $conditionsArray;
        return array($key, $value, $sql);
    }
}