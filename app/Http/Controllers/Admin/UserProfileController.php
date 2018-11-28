<?php

namespace SON\Http\Controllers\Admin;

use SON\Forms\UserProfileForm;
use SON\Http\Controllers\Controller;
use SON\Models\User;

class UserProfileController extends Controller
{

    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserProfileForm::class,
            [
                'url' => route('admin.users.profile.update',['user' => $user->id]),
                'method' => 'PUT',
                'model' => $user->profile,
                'data' => ['user' => $user]
            ]);
        return view('admin.users.profile.edit', compact('form'));
    }

    public function update(User $user)
    {
        $form = \FormBuilder::create(UserProfileForm::class);

        if (!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $user->profile->address ? $user->profile->update($data) : $user->profile()->create($data);

        session()->flash('message','Perfil alterado com sucesso');
        return redirect()->route('admin.users.profile.update', ['user' => $user->id]);
    }
}