<?php

namespace Hted35\Ultimate\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    static function countryHasSettings($country_code){
        return DB::table('conturies')->where(['country'=>$country_code])->first();
    }
    static function countrySetSettings($country_code, $data){
        foreach($data as $factor=>$setting){
            DB::table('conturies')->where(['country'=>$country_code, 'factor'=>$factor])->delete();
            foreach($setting as $name=>$value){
                $data = [
                    'factor'=>$factor,
                    'country'=>$country_code,
                    'name' => $name,
                    'value'=>$value,
                ];
                DB::table('conturies')->insert($data);
            }
        }
    }
    static function countryGetSettings($country_code){
        $result = [];
        $rows = DB::table('conturies')->where(['country'=>$country_code])->get();
        if(!$rows->isEmpty()){
            foreach($rows as $row){
                $result[$row->factor][$row->name] = $row->value;
            }
        }
        return $result;
    }
}
