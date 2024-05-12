<?php

    session_start();

    session_unset();

    session_destroy();

    header('Location: categories.php?pageid=1&pagename=Cars');

    exit();








?>