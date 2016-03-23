<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeceptionTesting\Helper;

/**
 * Description of Session
 *
 * @author hehou
 */
class Session {
    public function __construct()
    {
        session_start();
    }
    
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        
        return $this;
    }
    
    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        
        throw Exception(sprintf('Key "%s" does not exist.', $key));
    }
    
    public function extract()
    {
        return $_SESSION;
    }
    
    public function destroy()
    {
        session_destroy();
    }
}
