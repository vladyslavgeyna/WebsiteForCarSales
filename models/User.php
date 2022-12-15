<?php

namespace models;

use core\Core;
use core\Utils;

class User
{
    protected static string $tableName = "user";

    public static function addUser($name, $surname, $lastname, $login, $password, $phone, $image_id = null)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "name" => $name,
            "surname" => $surname,
            "lastname" => $lastname,
            "login" => $login,
            "password" => $password,
            "phone" => $phone,
            "image_id" => $image_id
        ]);
    }

    public static function updateUser($id, $updateArray)
    {
        $updateArray = Utils::filterArray($updateArray, [
            "name", "surname", "lastname", "phone", "image_id"
        ]);
        Core::getInstance()->db->update(self::$tableName, $updateArray, [
            "id" => $id
        ]);
    }

    public static function deleteUser($id)
    {
        Core::getInstance()->db->delete(self::$tableName, [
            "id" => $id
        ]);
    }

    public static function isLoginExists($login): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
           "login" => $login
        ]);
        return !empty($user);
    }

    public static function isPhoneExists($phone): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "phone" => $phone
        ]);
        return !empty($user);
    }

    public static function verifyUser($login, $password): bool
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
           "login" =>  $login,
            "password" => $password
        ]);
        return !empty($user);
    }

    public static function getUserByLoginAndPassword($login, $password)
    {
        $user = Core::getInstance()->db->select(self::$tableName, "*", [
            "login" =>  $login,
            "password" => $password
        ]);
        if(!empty($user))
        {
            return $user[0];
        }
        return null;
    }

    public static function authenticateUser($user)
    {
        $_SESSION["user"] = $user;
    }

    public static function logoutUser()
    {
        unset($_SESSION["user"]);
    }

    public static function isUserAuthenticated(): bool
    {
        return isset($_SESSION["user"]);
    }

    public static function getCurrentAuthenticatedUser()
    {
        return $_SESSION["user"];
    }

    public static function isUserAdmin(): bool
    {
        $user = self::getCurrentAuthenticatedUser();
        return $user["is_admin"] == 1;
    }

}