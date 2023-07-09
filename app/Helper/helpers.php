<?php


// admin sidebat menu active class
function setActive(array $routeNames)
{
    if (is_array($routeNames)) {
        foreach ($routeNames as $routeName) {
            if (request()->routeIs($routeName)) {
                return 'active';
            }
        }
    }
}