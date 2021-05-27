<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @OA\Info(title="Wallet API", version="0.1")
     */

    /**
     * @OA\Get(
     *    path="/api/user",
     *    path="/api/user?per_page={per_page}",
     *    @OA\Parameter(in="path", name="per_page", required=false, description="Value from env API_VERSION",
     *      @OA\Schema(
     *          type="integer",
     *          default=20,
     *          )
     *    ),
     *    @OA\Response(response="200", description="An example resource")
     * )
     */
    public function index(Request $request): Paginator
    {
        $paginate = $request->has('per_page') ? $request->per_page : 20;
        return $this->repository->index($paginate);
    }
    /**
     * @OA\Post(
     *    path="/api/user",
     *    @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *
     *                 ),
     *                  @OA\Property(
     *                     property="password_confirmation",
     *                     type="string",
     *
     *                 ),
     *                  @OA\Property(
     *                     property="cpf_cnpj",
     *                     type="string",
     *                 ),
     *                 required={"name"},
     *                 required={"email"},
     *                 required={"password"},
     *                 required={"password_confirmation"},
     *             ),
     *
     *
     *         )
     *     ),
     *     @OA\Response(response="201", description="The user resource",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/user_resource")
     *     ),
     *     @OA\Response(response="422", description="Validation error"),
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(UserCreateRequest $request)
    {
        return $this->repository->create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/user/{user_id}",
     *     @OA\Parameter(in="path", name="user_id", required=true, description="User ID"),
     *     @OA\Response(response="200", description="The user resource",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/user_resource")
     *     ),
     *     @OA\Response(response="404", description="when user not found")
     * )
     */
    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * @OA\Put(
     *    path="/api/user/{user_id}",
     *      @OA\Parameter(in="path", name="user_id", required=true, description="User ID"),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/user_resource"
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="The user resource",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/user_resource")
     *     ),
     *     @OA\Response(response="422", description="Validation error"),
     * )
     */
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        return $this->repository->update($user, $request->all());
    }
    /** @OA\Delete(
     *     path="/api/user/{user_id}",
     *     @OA\Parameter(in="path", name="user_id", required=true, description="User ID"),
     *     @OA\Response(response="200", description="The user resource",
     *          @OA\JsonContent(type="object",ref="#/components/schemas/user_resource")
     *     ),
     *     @OA\Response(response="404", description="when user not found")
     * )
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return User
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $user;
    }

    public  function test(){
        $user = User::find(5);
//        dd($user);
        dd($user->type, $user->balance);

    }
}
