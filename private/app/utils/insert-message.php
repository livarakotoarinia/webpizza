<?php

/**
 * insert_success_err permet de dire si l'insertion dans la base de donnée est un succes ou non
 *
 * 
 */
if (!function_exists('insert_success_err')){
    function insert_success_err($param){
        if ($param){
            echo "Message enregistré avec succés, nous vous recontacterons dans les plus bref delai";
        }else{
            echo "error";
        }
    }
}