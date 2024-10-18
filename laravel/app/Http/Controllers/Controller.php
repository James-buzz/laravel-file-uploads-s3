<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function encodeURIComponent(string $str): string
    {
        $revert = ['%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')', '%2F' => '/'];
        return strtr(rawurlencode($str), $revert);
    }
}
