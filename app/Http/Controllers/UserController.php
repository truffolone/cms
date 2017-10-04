<?php

namespace App\Http\Controllers;

use App\EchoCity;
use App\EchoCountry;
use App\User;
use App\Company;
use App\UserInfo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('country')
                            ->with('city')
                            ->with('userInfo')
                            ->with('companies')
                            ->get();

        $companyName = "-";
        if(property_exists('companies', $users))
        {
            $companyName = $users->companies->first();
        }

        return view('users.index', ['users' => $users, 'companyName' => $companyName]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //generating model for reference in the form view
        $company = new User;

        //generating array with data to show
        $dataArray = array(
            'company' => $company,
            'locations' => $this->_getLocationJson(),
            'companies' => Company::orderBy('name')->get()
        );

        //calling the view
        return view('users.create', $dataArray);
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
     * @param  \App\Http\Requests\StoreNewUser $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewUser $request)
    {
        //Password Hashing
        $password = $request->input('password') ?
                        sodium_crypto_pwhash_str($request->input('password'),
                                            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
                                           SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE) : null;

        //Binding User Values
        $user = new User;
        $user->email    = $request->input('email');
        $user->username = $request->input('username');
        $user->password = $password;
        $user->question = $request->input('question');
        $user->answer   = $request->input('answer');

        //Country
        if($request->input('country_id'))
        {
            $country = EchoCountry::find($request->input('country_id'));
            $user->country()->associate($country);
        }

        //City
        if($request->input('city_id'))
        {
            $city = EchoCity::find($request->input('city_id'));
            $user->city()->associate($city);
        }

        //Company
        if($request->input('company_id'))
        {
            $company = Company::find($request->input('company_id'));
            $user->companies()->attach($company);
        }

        $user->save();

        //User Infos Added Data
        $userInfo = new UserInfo;
        $userInfo->address     = $request->input('address');
        $userInfo->zip_code    = $request->input('zip_code');
        $userInfo->piva        = $request->input('piva');
        $userInfo->more_info   = $request->input('more_info');
        $userInfo->telephone   = $request->input('telephone');
        $userInfo->cellphone   = $request->input('cellphone');
        $userInfo->fax         = $request->input('fax');
        $userInfo->first_name  = $request->input('first_name');
        $userInfo->middle_name = $request->input('middle_name');
        $userInfo->last_name   = $request->input('last_name');
        $userInfo->user()->associate($user);
        $userInfo->save();

        return redirect()
            ->action('UserController@index')
            ->with('message', 'User ' . $request->input('username') . ' successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
