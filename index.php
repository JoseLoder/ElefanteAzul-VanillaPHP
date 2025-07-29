<?php

require_once('Bd.php');

if(isset($_GET['controller']) && !empty($_GET['controller']) && isset($_GET['action']) && !empty($_GET['action']))
{
    switch($_GET['controller'])
    {
        case 'citas':
            require_once("controllers/CitasControllers.php");
            if(method_exists("CitasController",$_GET['action']))
            {
                switch($_GET['action'])
                {
                    case 'add':
                        CitasController::add();
                    break;
                    case 'listado':
                        CitasController::listado();
                    break;
                    //case 'ticket':
                    //    CitasController::ticket($_GET['id']);
                    //break;

                    default:
                        CitasController::listado();
                    break;
                }
            }
            else
            {
                CitasController::listado();
            }            
        break;
        default:
            header("Status: 301 Moved Permanently");
            header("Location: index.php?controller=citas&action=listado");
            exit();
        break;
    }
}   
else
{
    header("Status: 301 Moved Permanently");
    header("Location: index.php?controller=citas&action=listado");
    exit();
}