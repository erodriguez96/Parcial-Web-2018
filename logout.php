<?php

include_once 'presentation.class.php';
include_once 'business.class.php';

User::logout();

header('location: index.php');
