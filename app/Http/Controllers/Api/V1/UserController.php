<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Traits\Uploadable;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Uploadable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * @SWG\Get(
     *     path="/users/{id}",
     *     summary="Get user by id",
     *     tags={"Users"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="User id",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/User")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @SWG\Response(
     *         response="403",
     *         description="Have no premissions",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="User is not found",
     *     )
     * )
     */

    public function show($id)
    {
        $user = User::select(['name', 'family', 'second', 'birthday', 'img'])->findOrFail($id);

        return response()->json(['user' => $user], 200);
    }

    /**
     * @SWG\Put(
     *     path="/users/{id}",
     *     summary="Update user by id",
     *     tags={"Users"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="family",
     *         in="formData",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="second",
     *         in="formData",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="birthday",
     *         in="formData",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="attachment",
     *         in="formData",
     *         required=false,
     *         type="file",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @SWG\Response(
     *         response="403",
     *         description="Have no premissions",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="User is not found",
     *     )
     * )
     */

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'second' => $request->second,
            'birthday' => $request->birthday,
            'img' => $this->upload($request->attachment),
        ]);

        return response()->json(['msg' => "Данные пользователя $id успешно обновлены"],200);
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
}
