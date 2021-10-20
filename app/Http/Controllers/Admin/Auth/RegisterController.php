<?php

namespace App\Http\Controllers\Admin\Auth;

use Bitfumes\Multiauth\Model\Role;
use Bitfumes\Multiauth\Model\Admin;
use Bitfumes\Multiauth\Http\Requests\AdminRequest;
use Bitfumes\Multiauth\Http\Controllers\RegisterController as ControllersRegisterController;
use Illuminate\Support\Facades\Hash;

class RegisterController extends ControllersRegisterController
{
    protected function create(array $data)
    {
        $admin = new Admin();

        $fields           = $this->tableFields();
        $data['password'] = bcrypt($data['password']);
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $admin->$field = $data[$field];
                $admin->active = 1;
            }
        }

        $admin->save();
        $admin->roles()->sync(request('role_id'));
        $this->sendConfirmationNotification($admin, request('password'));

        return $admin;
    }



    public function update(Admin $admin, AdminRequest $request)
    {
        $request['active'] = request('activation') ?? 0;
        unset($request['activation']);
        $request['password'] = $request->password ? Hash::make($request->password) : $admin->password;
        $admin->update($request->except('role_id'));
        $admin->roles()->sync(request('role_id'));

        return redirect(route('admin.show'))->with('message', "{$admin->name} details are successfully updated");
    }
}
