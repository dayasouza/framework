<?php

class Valida {

    public static function validarNome($nome){
        if(!preg_match('/^([áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+((\s[áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+)?$/', $nome)):
            return true;
        else:
            return false;
        endif;
    }

    public static function validarEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            return true;
        else:
            return false;
        endif;
    }

    public static function dataBr($data)
    {
        if (isset($data)) {
            return date('d/m/Y H:i', strtotime($data));
        } else {
            return false;
        }
    }

}