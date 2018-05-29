<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\User;
use GuzzleHttp\Client;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {

        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        try {

            // Ejecutamos el validador y en caso de que falle devolvemos la respuesta
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }

            User::create($request->all());
            return ['created' => true];
        } catch (Exception $e) {
            \Log::info('Error creating user: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required'
        ];

        try {

            // Ejecutamos el validador y en caso de que falle devolvemos la respuesta
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            $user = User::find($id);
            $user->update($request->all());
            return ['updated' => true];
        } catch (Exception $e) {
            \Log::info('Error creating user: '.$e);
            return \Response::json(['created' => false], 500);
        }

    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return ['deleted' => true];
    }

    public function file()
    {

        return view('file');
    }

    public function fileSave(Request $request)
    {
        $client = new Client();
        try{
            $response = $client->request('POST','https://redaliados.com/admin/public/api/banners/12345685216',
                ['auth'=>['ediaz@celmedia.com','edwarddiaz92'],
                    'timeout'=>5.0,
                    'headers' =>
                        [
                            'api-key'=>'726eae03-aaf6-4b3e-af94-a1ea9d4480a1',
                            ''
                        ],
                    'form_params'  =>
                        [
                            'title'=>'prueba',
                            'subtitle'=>'prueba sub',
                            'status'=>1,
                            'order'=>10,
                            'image'=>$request->file('file')
                        ]
                ]);
            $content = \GuzzleHttp\json_decode($response->getBody()->getContents());
            dd($content);
        }catch (ClientException $e)
        {
            dd($e->getResponse());
        }
        dd($request->file('file'));
        dd($request->all());
    }

}
