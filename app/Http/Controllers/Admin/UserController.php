<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use App\Models\Zone;
use App\Enums\PaginationEnum;
use App\Enums\FlashMessagesEnum;
use App\Http\Requests\Admin\UserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(User::all());
      $records = User::paginate( PaginationEnum::Show10Records );
      return view('admin.user.index', compact('records') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $roles = Role::pluck( 'name', 'id' )->prepend('Select Role', '');
       $zones = Zone::pluck('name', 'id')->prepend('Select Zone', '');
       return view('admin.user.create', compact('roles', 'zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       $user =  User::create(
            $request->fillUserDetails()
        );
      $user->zone()->sync($request->zone_id);
      return redirect()->route('admin.user.index')->with('success',FlashMessagesEnum::CreatedMsg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user )
    {
       $roles = Role::pluck( 'name', 'id' )->prepend('Select Zone', '');
       $zones = Zone::pluck('name', 'id')->prepend('Select Zone', '');
        return view('admin/user/edit', [
            'record' => $user,
            'roles' => $roles,
            'zones' => $zones,
            'userZone' => optional($user->zone->first())->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update(
            $request->updateUserDetails()
        );
        if ( $request->zone_id ) {
            $user->zone()->sync($request->zone_id);
        }
      return redirect()->route('admin.user.index')->with('success',FlashMessagesEnum::UpdateMsg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success',FlashMessagesEnum::DeletedMsg);

    }
}
