<?php
setcookie('login', '', strtotime('-1 hour', time()), "/");
unset($_COOKIE['login']);
