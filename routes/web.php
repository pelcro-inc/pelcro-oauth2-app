<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('authorize', function (Request $request) {
    $query = http_build_query([
        'client_id' => config('services.pelcro.client_id'),
        'redirect_uri' => config('services.pelcro.redirect_uri'),
        'response_type' => 'code'
    ]);

    $query = urldecode($query);

    return redirect(config('services.pelcro.base_url')."/oauth/authorize?$query");
})->name('oauth.authorize');

Route::get('redirect', function (Request $request) {

    $response = Http::post(config('services.pelcro.base_url').'/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => config('services.pelcro.client_id'),
        'client_secret' => config('services.pelcro.client_secret'),
        'redirect_uri' => config('services.pelcro.redirect_uri'),
        'code' => $request->code,
    ]);
    $decoded_response = json_decode($response->body(), true);
    session(['access_token' => $decoded_response['access_token']]);

    return redirect('/');

});

Route::get('customers', function (Request $request) {
    $response = Http::withToken(session('access_token'))->get(config('services.pelcro.base_url').'/api/v1/core/customers',[
        'site_id' => 1
    ]);
    return $response->json();
});
