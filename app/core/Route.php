<?php

class Route
{
    public static $validRoutes = array();
    public static function set($route, $funciton)
    {
        self::$validRoutes[] = $route;
        print_r(self::$validRoutes);
    }
}
