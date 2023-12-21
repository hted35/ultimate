<?php

namespace Hted35;

class Hattat
{
    static function _IsChecked($setting, $key){
        if(array_key_exists($key, $setting)){
            return 'checked';
        }
        return '';
    }
}
