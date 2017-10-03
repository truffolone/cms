<?php

namespace App\Http\Controllers;

use App\User;
use App\EchoCity;
use App\EchoCountry;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('country')->with('city')->with('userInfo')->with('companies')->get();

        return view('users.index', ['users' => $users]);
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
            'company'    => $company,
            'locations'  => $this->_getLocationJson()
        );

        //calling the view
        return view('companies.create', $dataArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        foreach($countries as $country)
        {
            $cityArray = array();

            foreach($country->cities as $city)
            {
                $cityArray[] = ['id' => $city->id, 'name' => $city->name];
            }

            //sorting array based on name
            usort($cityArray, function($a, $b) {
                return $a['name'] > $b['name'];
            });

            $array['country'][] = [
                'name'   => $country->name,
                'id'     => $country->id,
                'cities' => $cityArray
            ];
        }

        return json_encode($array);
    }
}
