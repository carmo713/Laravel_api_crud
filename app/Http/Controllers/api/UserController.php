<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\TryCatch;
use Exception;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index():JsonResponse

{
    $users = User::orderBy("id","desc")->paginate(2);
    return response()->json([
        'status'=> true,
        'users'=> $users,
    ], 200);
}

   public function show(User $user)
   {

    return response()->json([
        'status'=> true,
        'user'=> $user,
    ], 200);

   }

   public function store(UserRequest $request){
    
    DB::beginTransaction();
    
   try{

    $user = User::create($request->all());  
    DB::commit();

    return response()->json([
        'status'=> true,
        'user'=> $user,
        'message'=> 'User created successfully', 
    ],  201);

   }catch (Exception $e){

    DB::rollBack();

    return response()->json([
        'status'=> false,
        'message'=> 'User not created', 
    ], 400);


    }
}

public function update(UserRequest $request, User $user): JsonResponse
{
    DB::beginTransaction();

    try{
        $user->update($request->all());
        DB::commit();

        return response()->json([
            'status'=> true,
            'user'=> $user,
            'message'=> 'User edited successfully', 
        ],  200);
    }catch (Exception $e){
        DB::rollBack();
        return response()->json([
            'status'=> false,
            'message'=> 'User not edited', 
        ], 400);
    }
    
}

public function destroy(User $user): JsonResponse
{   
    try {
        $user->delete();
        return response()->json([
            'status'=> true,
            'message'=> 'User deleted successfully', 
        ],  200);
    } catch (Exception $e) {
        return response()->json([
            'status'=> false,
            'message'=> 'User not deleted', 
        ], 400);
    }


}
}




   
