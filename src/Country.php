<?php

namespace Hted35;

use App\Models\Expanses;
use Illuminate\Http\Request;

class Country
{
    public function countryList(Request $request){
        view()->addLocation(__DIR__.'/../templates');
        $data['pageTitle'] = "Countries";
        $app = new \App\Http\Controllers\Api\AppController();
        $response = $app->getCountries();
        $result = $response->getData();
        $countries = $result->data->countries;
        foreach($countries as $item){
            $item->has_settings = Expanses::countryHasSettings($item->country_code);
            $data['countries'][] = $item;
        }
        $data['documents'] = $this->getDocuments();
        return view('admin.country.countries', $data);
    }
    public function countrySave(Request $request, $country_code){
        view()->addLocation(__DIR__.'/../templates');
        Expanses::countrySetSettings($country_code, $request->input('setting', []));
        $notify[] = ['success', 'Country Settings Updated'];
        return back()->withNotify($notify);
    }
    public function countryView(Request $request, $country_code){
        view()->addLocation(__DIR__.'/../templates');
        $data['pageTitle'] = "Countries";
        $app = new \App\Http\Controllers\Api\AppController();
        $response = $app->getCountries();
        $result = $response->getData();
        $countries = $result->data->countries;
        $data['country'] = null;
        foreach($countries as $item){
            if($item->country_code == $country_code){
                $item->settings = Expanses::countryGetSettings($item->country_code);
                $data['country'] = $item;
            }
        }
        $data['documents'] = $this->getDocuments();
        return view('admin.country.countries-view', $data);
    }
    private function getDocuments(){
        return [
            'tcKimlikNo' =>['code'=>'tcKimlikNo', 'title'=> __('Tc Kimlik Numarası'), 'description'=>__('Tc Kimlik Numarası Açıklaması')],
            'tcKimlik' =>['code'=>'tcKimlik', 'title'=> __('Tc Kimlik Belgesi'), 'description'=>__('Tc Kimlik Belgesi Açıklaması')],
            'socialNumber' =>['code'=>'socialNumber', 'title'=> __('Sosyal Güvenlik Numarası'), 'description'=>__('Tc Sosyal Güvenlik Açıklaması')],
            'driverLicense' =>['code'=>'driverLicense', 'title'=> __('Sürücü Belgesi'), 'description'=>__('Sürücü Belgesi Açıklaması')],
        ];
    }
}
