<?php

$sessionLifetime = 1800; // durée de la session 30mn (60sec x 30mn = 1800 sec)
session_set_cookie_params($sessionLifetime);
session_start();
