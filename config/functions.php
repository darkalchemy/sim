<?php
// Fichiers comportant les fonctions accèssibles hors controllers/middlewares
// Don't remove this function
function slim_env($var = null)
{
    if (!is_null($var)) {
        if ($var === 'CACHE') {
            return filter_var(getenv($var), FILTER_VALIDATE_BOOLEAN);
        } elseif ($var === 'ENV') {
            if (getenv($var) === 'local') {
                return true;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}
