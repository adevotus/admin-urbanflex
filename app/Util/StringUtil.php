<?php
namespace App\Util;

class StringUtil {

    public static function generateRandomString($length = 40) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomNumber($length = 12) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomNumber;
    }

    public static function helpLike($likeVal) {
        $likeVal = str_replace("+", " ", $likeVal);
        $likeVal = str_replace("-", " ", $likeVal);
        $returnLikeVal = "%";
        $listOfLikeVal = preg_split('/\s+/', $likeVal);
        foreach ($listOfLikeVal as $likeValItem) {
            $returnLikeVal.= "{$likeValItem}%";
        }
        return $returnLikeVal;
    }

    public static function slug($title) {

        $slug = strtolower($title);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        return $slug;
    }

    public function generateTrxId(){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $keyLength = 10;
        $charactersLength = strlen($characters);
        $trxId = '';
        for ($i = 0; $i < $keyLength; $i++) {
            $trxId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $trxId;
    }
}
