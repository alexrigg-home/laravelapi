<?php
//generic helper
// note I've autoloaded this in composer
use Illuminate\Support\Facades\Hash;

if (! function_exists('encryptpassword') ) 
{
    function encryptpassword($password)
    {
    	 return Hash::make($password);
    }
    
}
