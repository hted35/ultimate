<?php
function hted35_ultimate_autoloader($class) {
    include __DIR__.'/../models/Country.php';
}
spl_autoload_register('hted35_ultimate_autoloader');
class Hultimate{
    static  function getDocuments(){
        return [
            'tcKimlikNo' =>['code'=>'tcKimlikNo', 'title'=> __('Tc Kimlik Numarası'), 'description'=>__('Tc Kimlik Numarası Açıklaması')],
            'tcKimlik' =>['code'=>'tcKimlik', 'title'=> __('Tc Kimlik Belgesi'), 'description'=>__('Tc Kimlik Belgesi Açıklaması')],
            'socialNumber' =>['code'=>'socialNumber', 'title'=> __('Sosyal Güvenlik Numarası'), 'description'=>__('Tc Sosyal Güvenlik Açıklaması')],
            'driverLicense' =>['code'=>'driverLicense', 'title'=> __('Sürücü Belgesi'), 'description'=>__('Sürücü Belgesi Açıklaması')],
        ];
    }
}
