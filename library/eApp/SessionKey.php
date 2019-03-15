<?php

class eApp_SessionKey
{
    static public function get()
    {
        return sha1("eApp_by_eVias.be");
    }
}