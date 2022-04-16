<?php
    if (isset($_POST['email'], $_POST['password']))
    {
        if (!empty($_POST['email']) and !empty($_POST['password']))
        {
            $response = $database->getUser($_POST['email'], $_POST['password']);

            if (!$response)
            {
                $response = $database->createUser($_POST['email'], $_POST['password']);
                if ($response)
                {
               		echo "<script>window.location.replace('../');</script>";
                }
                else
                {
                    echo "<script>alert('ERROR');</script>";
                }
            }
            else
            {
                echo "<script>window.location.replace('../');</script>";
            }
        }
    }

	include "main.html";