<?php

namespace Extr\Helpers;

class SecurityHelper
{
    public function encrypt(string $text) : string
    {
        return password_hash($text, PASSWORD_DEFAULT);
    }

    public function verify(string $text, $cript_text) : bool
    {
        return password_verify($text, $cript_text);
    }
}