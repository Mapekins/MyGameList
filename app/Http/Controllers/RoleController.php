<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class RoleController extends Controller
{
    public function change(Request $request)
    {
        $request->validate(
            [
             'user_id' => 'required',
             'current_user_id' => 'required',
             'role_name' => 'required'
            ]
        );
        $currentUser = User::find($request->current_user_id);
        if ($currentUser && $currentUser->hasRole('Admin')) {
            // Retrieve the user to change role based on $request->user_id
            $user = User::find($request->user_id);

            if ($user) {
                // Sync roles for the user based on selected role_name
                $user->syncRoles([$request->role_name]);
            } else {
                return redirect()->back()->with('error', __('user_not_found'));
            }
        } else {
            return redirect()->back()->with('error', __('dont_have_permission_role_change'));
        }
        return redirect()->route('user.show', ['id' => $user->id]);
    }
}
