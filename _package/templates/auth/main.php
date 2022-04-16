<?php
    
    if (isset($_SESSION['user']))
        echo "<script>window.location.replace('../profile/');</script>";

	include "main.html";