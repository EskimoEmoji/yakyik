<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $myIP = '76.249.156.44';
        $chi = '107.122.93.54';
        $beach = '165.225.10.223';
        $CA = '149.142.201.252';
        $OH = '18.188.149.90';
        $ip = \request()->ip();
        $location = Location::get($ip);

        if($location){
            $locationData= [
                'ip' => $location->ip,
                'country' => $location->countryCode,
                'state' => $location->regionCode,
                'zipcode' => $location->zipCode,
                'city' => $location->cityName,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
            ];
        } else {
            $locationData = null;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'location' => $locationData != null ? json_encode($locationData) : $locationData,
            'password' => Hash::make($data['password']),

        ]);
    }
}
