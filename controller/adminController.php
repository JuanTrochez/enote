<?php


if (!$secu->isAdmin($bdd)) {
    header("Location: " . $basePath . "");
}
