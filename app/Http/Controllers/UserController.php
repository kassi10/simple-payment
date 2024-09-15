<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\UseCase\UserUseCase;

class UserController extends Controller
{

    protected $userUseCase;


    public function __construct(UserUseCase $userUseCase)
    {
        $this->userUseCase = $userUseCase;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "ksdmksd";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $user = $this->userUseCase->save([
                'name' =>  $request->name,
                'cpf_cnpj' =>  $request->cpf_cnpj,
                'email' => $request->email,
                'password' => $request->password,
                'type' => $request->type,
                'balance' => $request->balance
            ] );

            return response()->json(['message' => 'User created'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        try {
            $userEntity = $this->userUseCase->find($id);
            
            return response()->json([
                'name' => $userEntity->getName(),
                'cpf_cnpj' => $userEntity->getCpfCnpj(),
                'email' => $userEntity->getEmail(),
                'balance' => $userEntity->getBalance()
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
