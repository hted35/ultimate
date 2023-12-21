<?php

namespace Hted35;

use hted35\ultimate\model\Expanses;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController
{
    public function countryList(Request $request){
        $data['pageTitle'] = "Countries";
        $app = new \App\Http\Controllers\Api\AppController();
        $response = $app->getCountries();
        $result = $response->getData();
        $countries = $result->data->countries;
        foreach($countries as $item){
            $item->has_settings = Country::countryHasSettings($item->country_code);
            $data['countries'][] = $item;
        }
        $data['documents'] = $this->getDocuments();
        return view('admin.country.countries', $data);
    }
    public function countrySave(Request $request, $country_code){
        Country::countrySetSettings($country_code, $request->input('setting', []));
        $notify[] = ['success', 'Country Settings Updated'];
        return back()->withNotify($notify);
    }
    public function countryView(Request $request, $country_code){
        $data['pageTitle'] = "Countries";
        $app = new \App\Http\Controllers\Api\AppController();
        $response = $app->getCountries();
        $result = $response->getData();
        $countries = $result->data->countries;
        $data['country'] = null;
        foreach($countries as $item){
            if($item->country_code == $country_code){
                $item->settings = Country::countryGetSettings($item->country_code);
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
