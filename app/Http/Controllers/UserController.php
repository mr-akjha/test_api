<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(25);
        return response()->json([ 'status' => 200, 'data' => new UserCollection($users),'links' => $users->getOptions()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        User::create($request->all());
    
        return response()->json([
            'status' => 200,
            'message' => "User created successfully"
        ]);
    }

}
