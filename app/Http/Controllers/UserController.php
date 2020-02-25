<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    /**
     * @OA\Get(
     *     path="/api/getUser",
     *     description="Get user infor",
     *     @OA\Parameter(
     *         name="role",
     *         in="query",
     *         description="User role",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             maximum="2",
     *             default="1"
     *         )
     *     ),
     *     security={{
     *       "bearerAuth":{}
     *     }},
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function getUser(Request $request)
    {
        $user = [
            'username' => 'fabbi-hoibq',
            'email' => 'hoibq@fabbi.io',
            'age' => 18,
            'role' => $request->query('role') == 1 ? 'admin' : 'editor'
        ];

        return response()->json($user);
    }
}
