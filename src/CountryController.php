<?php

namespace Hted35;

use hted35\ultimate\model\Expanses;
use Illuminate\Http\Request;
use Hted35\Ultimate\model\Country;

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
        $data['documents'] = \Hultimate::getDocuments();
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
        $data['documents'] = \Hultimate::getDocuments();
        return view('admin.country.countries-view', $data);
    }
}
