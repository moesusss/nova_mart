<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Services\UserService;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * AgentController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService,RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd('hi');
        $users = $this->userService->getUsers($request);
        return view('backend.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleService->getRolesPluckName();
        return view('backend.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->userService->create($request->all());
        return redirect()->route('users.index')->with('status', 'User has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = $this->roleService->getRolesPluckName();
        $userRole = $this->userService->getUserRolesPluckName($user);
        return view('backend.user.show',compact('user','roles','userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $this->roleService->getRolesPluckName();
        $userRole = $this->userService->getUserRolesPluckName($user);
        return view('backend.user.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->userService->update($user, $request->all());
        return redirect()->route('users.index')->with('status', 'User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        return redirect()->route('users.index')->with('status', 'User has been deleted successfully');
    }
}
