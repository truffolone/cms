<?php

namespace App\Http\Controllers;

use App\Company;
use App\EchoCity;
use App\EchoCountry;
use App\Http\Requests\CreateCompanyFormRequest;
use App\Http\Requests\UpdateCompanyFormRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('city')->with('country')->orderBy('name')->get();

        $ret = ['companies' => $companies];

        return view('companies.index', $ret);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //generating model for reference in the form view
        $company = new Company;

        //generating array with data to show
        $dataArray = array(
            'company' => $company,
            'locations' => $this->_getLocationJson()
        );

        //calling the view
        return view('companies.create', $dataArray);
    }

    /**
     * Returns a JSON string with cities/countries
     *
     * @return string
     */
    private function _getLocationJson()
    {
        $countries = EchoCountry::with('cities')->get()->sortBy('name');
        $array = array('country' => []);
        foreach ($countries as $country) {
            $cityArray = array();

            foreach ($country->cities as $city) {
                $cityArray[] = ['id' => $city->id, 'name' => $city->name];
            }

            //sorting array based on name
            usort($cityArray, function ($a, $b) {
                return $a['name'] > $b['name'];
            });

            $array['country'][] = [
                'name' => $country->name,
                'id' => $country->id,
                'cities' => $cityArray
            ];
        }

        return json_encode($array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateCompanyFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyFormRequest $request)
    {
        $company = new Company;
        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->zip_code = $request->input('zip_code');
        $company->telephone = $request->input('telephone');
        $company->fax = $request->input('fax');
        $company->email = $request->input('email');
        $company->url = $request->input('url');

        $country = EchoCountry::find($request->input('country_id'));
        $company->country()->associate($country);

        $city = EchoCity::find($request->input('city_id'));
        $company->city()->associate($city);

        $company->save();

        return redirect()
            ->action('CompanyController@index')
            ->with('message', 'Company ' . $request->input('name') . ' successfully created!');
    }

    /**
     * Recycle bin for the companies
     *
     * @return \Illuminate\Http\Response
     */
    public function bin()
    {
        $companies = Company::onlyTrashed()->with('city')->with('country')->orderBy('name')->get();

        $ret = ['companies' => $companies];

        return view('companies.bin', $ret);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $ret = array(
            'company' => $company,
            'locations' => $this->_getLocationJson()
        );

        return view('companies.edit', $ret);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyFormRequest $request
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyFormRequest $request, Company $company)
    {
        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->zip_code = $request->input('zip_code');
        $company->telephone = $request->input('telephone');
        $company->fax = $request->input('fax');
        $company->email = $request->input('email');
        $company->url = $request->input('url');

        $country = EchoCountry::find($request->input('country_id'));
        $company->country()->associate($country);

        $city = EchoCity::find($request->input('city_id'));
        $company->city()->associate($city);

        $company->save();

        return redirect()
            ->action('CompanyController@index')
            ->with('message', 'Company ' . $request->input('name') . ' successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()
            ->action('CompanyController@index')
            ->with('message', 'Company ' . $company->name . ' successfully deleted!');
    }

    /**
     * Restores a company from the recylce bin
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id)
    {
        $company = Company::onlyTrashed()->find($id);

        $company->restore();

        return redirect()
            ->action('CompanyController@index')
            ->with('message', 'Company ' . $company->name . ' successfully restored!');
    }
}
