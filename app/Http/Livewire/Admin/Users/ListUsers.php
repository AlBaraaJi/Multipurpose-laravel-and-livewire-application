<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
//use PHPUnit\Util\Xml\Validator;
use Illuminate\Support\Facades\Validator;

class ListUsers extends Component
{
    public $userIdBeingRemoved = null;
    public $user;
    public $showEditModal = false;
    public $state = [];
    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users', compact('users') );
    }
    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }
    public function edit(User $user){
        $this->user = $user;
        $this->showEditModal = true;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
//        dd($user);

    }
    public function updateUser(User $user){
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|required',
        ])->validate();
        if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);

        }

        $this->user->update($validatedData);
        $this->dispatchBrowserEvent('user-added', ['message' => 'User updated successfully!']);
        $this->dispatchBrowserEvent('hide-form');


        $this->reset('state');
    }
    public function createUser(){

     $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ])->validate();
$validatedData['password'] = Hash::make($validatedData['password']);
     User::create($validatedData);
        $this->dispatchBrowserEvent('user-added', ['message' => 'User added successfully!']);

        $this->dispatchBrowserEvent('hide-form');
        $this->reset('state');

    }
    public function confirmUserRemoval($userId){

        $this->userIdBeingRemoved = $userId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function deleteUser()
    {
        // Find the user by ID
        $user = User::findOrFail($this->userIdBeingRemoved);

        // Delete the user
        $user->delete();

        // Notify and close modal
        $this->dispatchBrowserEvent('user-deleted', ['message' => 'User deleted successfully!']);
        $this->dispatchBrowserEvent('hide-delete-modal');
    }



}
