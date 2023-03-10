<?php

namespace models;

use core\Core;

class Carimage
{
    protected static string $tableName = "car_image";

    public const MAX_IMAGE_COUNT = 5;

    public static function addCarImage($image_id, $car_id, $is_main = 0)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "image_id" => $image_id,
            "car_id" => $car_id,
            "is_main" => $is_main,
        ]);
    }
    public static function getMainCarImageByCarIdInnered($car_id): ?array
    {
        $car_images = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if (!empty($car_images))
        {
            $result = [];
            foreach ($car_images as $image)
            {
                if ($image["is_main"] == 1)
                {
                    $main_image = $image;
                    break;
                }
            }
            $image = Image::getImageById($main_image["image_id"]);
            $result["name"] = $image["name"];
            $result["is_main"] = $main_image["is_main"];
            $result["image_id"] = $main_image["image_id"];
            $result["car_image_id"] = $main_image["id"];
            $result["car_id"] = $main_image["car_id"];
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function getMainCarImageNameByCarIdInnered($car_id)
    {
        $car_images = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if (!empty($car_images))
        {
            $main_image = Core::getInstance()->db->select(self::$tableName, "*", [
                "car_id" => $car_id,
                "is_main" => 1
            ]);
            if (!empty($main_image))
            {

                return Image::getImageNameById($main_image[0]["image_id"]);
            }
            else
            {
                return null;
            }

        }
        else
        {
            return null;
        }
    }


    public static function getAllCarImagesByCarIdInnered($car_id): ?array
    {
        $car_images = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if (!empty($car_images))
        {
            $result = [];
            for ($i = 0; $i < count($car_images); $i++)
            {
                $image = Image::getImageById($car_images[$i]["image_id"]);
                $result[$i]["name"] = $image["name"];
                $result[$i]["is_main"] = $car_images[$i]["is_main"];
                $result[$i]["image_id"] = $car_images[$i]["image_id"];
                $result[$i]["car_image_id"] = $car_images[$i]["id"];
                $result[$i]["car_id"] = $car_images[$i]["car_id"];
            }
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function setAsNotMainCarImageById($id)
    {
        $car_image = Core::getInstance()->db->select(self::$tableName, "*", [
            "id" => $id,
        ]);
        if (!empty($car_image))
        {
            Core::getInstance()->db->update(self::$tableName, [
                "is_main" => 0
            ], [
                "id" => $id,
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function setAsMainCarImageByImageId($image_id)
    {
        $car_image = Core::getInstance()->db->select(self::$tableName, "*", [
            "image_id" => $image_id,
        ]);
        if (!empty($car_image))
        {
            Core::getInstance()->db->update(self::$tableName, [
                "is_main" => 1
            ], [
                "image_id" => $image_id,
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function getMainImageByCarId($car_id)
    {
        $main_image = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id,
            "is_main" => 1
        ]);
        if (!empty($main_image))
        {
            return $main_image[0];
        }
        else
        {
            return null;
        }
    }

    public static function getAllCarImagesByCarId($car_id): ?array
    {
        $car_images = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if (!empty($car_images))
        {
            return $car_images;
        }
        else
        {
            return null;
        }
    }

    public static function getAllCarImages(): ?array
    {
        $car_images = Core::getInstance()->db->select(self::$tableName);
        if (!empty($car_images))
        {
            return $car_images;
        }
        else
        {
            return null;
        }
    }

    public static function deleteAllCarImagesByCarId($car_id)
    {
        $car_images = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if (!empty($car_images))
        {
            Core::getInstance()->db->delete(self::$tableName, [
                "car_id" => $car_id
            ]);
            foreach ($car_images as $car_image)
            {
                Image::deleteImageById($car_image["image_id"], "car");
            }
        }
        else
        {
            return null;
        }
    }
}