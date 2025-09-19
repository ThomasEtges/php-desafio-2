<?php

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("TRUNCATE TABLE carrinho");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");