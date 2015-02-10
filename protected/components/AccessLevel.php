<?php

class AccessLevel
{
    /**
     * Checks if the user level is 'Admin'
     * @return bool if it's an admin
     */
    public static function isAdmin()
    {
        if ((!Yii::app()->user->isGuest) && (Yii::app()->user->level == 'Admin')) return true;
        else return false;
    }

    /**
     * Checks if the user level is 'User'
     * @return bool if it's a user
     */
    public static function isUser()
    {
        if ((!Yii::app()->user->isGuest) && (Yii::app()->user->level == 'User')) return true;
        else return false;
    }

    /**
     * Checks if the user level is logged in
     * @return bool if it's logged in
     */
    public static function isLogged()
    {
        return !Yii::app()->user->isGuest;
    }

    /**
     * Checks if the user level is a guest (not logged in)
     * @return bool if it's a guest
     */
    public static function isGuest()
    {
        return Yii::app()->user->isGuest;
    }
}