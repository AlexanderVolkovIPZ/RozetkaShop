<?php

namespace models;

use core\Core;
use core\Utils;

class User
{
    protected static $tableName = 'user';

    public static function addUser($login, $password, $firstName, $middleName, $lastName)
    {

        \core\Core::getInstance()->db->insert(
            self::$tableName, [
                'firstName' => $firstName,
                'middleName' => $middleName,
                'lastName' => $lastName,
                'login' => $login,
                'password' => self::hashPassword($password)
            ]
        );
    }

    public static function hashPassword($password)
    {
        return md5($password);
    }

    public static function selectUser($fieldsList = "*", $conditionsArray = null, $orderByArray = null, $limit = null, $offset = null)
    {
        $users = \core\Core::getInstance()->db->select(
            self::$tableName,
            $fieldsList,
            $conditionsArray,
            $orderByArray,
            $limit,
            $offset
        );
        return $users;
    }

    public static function deleteUser($where = null)
    {
        \core\Core::getInstance()->db->delete(
            self::$tableName,
            $where
        );
    }

    public static function updateUser($id, $updatesArray)
    {
        $updatesArray = Utils::filterArray($updatesArray, ['firstName', 'middleName', 'lastName', 'typeAccess', 'password', 'login']);
        \core\Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            ['id' => $id]
        );
    }

    public static function isLoginExist($login)
    {
        $user = \core\Core::getInstance()->db->select(self::$tableName, '*', ['login' => $login]);
        return !empty($user);
    }

    public static function verifyUser($login, $password)
    {
        $user = \core\Core::getInstance()->db->select(self::$tableName, '*',
            ['login' => $login, 'password' => $password]);
        return !empty($user);
    }

    public static function getUserByLoginAndPassword($login, $password)
    {
        $user = \core\Core::getInstance()->db->select(self::$tableName, '*',
            ['login' => $login, 'password' => self::hashPassword($password)]);
        if (!empty($user))
            return $user[0];
        return null;
    }

    public static function logoutUser()
    {
        session_destroy();
        unset($_SESSION['user']);
    }

    public static function authentificationUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function isAuthenticatedUser()
    {
        return isset($_SESSION['user']);
    }

    public static function getCarrentAuthenticatedUser()
    {
        return $_SESSION['user'];
    }

    public static function isUserAdmin()
    {
        $user = self::getCarrentAuthenticatedUser();
        return $user['typeAccess'] == 10;
    }

    public static function getUserById($id)
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        return $user[0];
    }
}