<?php
namespace App\Http\Controllers; // Define the namespace for Controllers
use Illuminate\Support\Str; // Import the Str class

use App\Models\User; // Use the User model with the correct namespace
use Illuminate\Http\Request;
use App\Http\Controllers\userscontroller; // Import the Controller class

class userscontroller extends Controller
{
    //
    public function index()
    {
        session_start();
        $token = $_SESSION['token'];

    // Retrieve users whose remember token does not match the token stored in the session
        $users = User::where('remember_token', '!=', $token)->get();

    // Retrieve the current user based on their remember token
        $currentUser = User::where('remember_token', $token)->first();

        return view('chatspage', ['users' => $users, 'currentUser' => $currentUser]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newuser');
    }

  
    /**
     * Display the specified resource.
     */
    public function store(Request $request)
    {
        session_start();
        $_SESSION['token'] = Str::random(60);

        $validatedData = $request->validate([
            'name' => 'required|unique:users|max:255', 
            // Add validation rules for other fields if needed
        ]);
    
        $existingUser = User::where('name', $request->name)->first();
    
        if ($existingUser) {
            return back()->with('error', 'User with this name already exists.');
        }
    
        $user = new User(); // Create a new instance of the User model
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->remember_token =  $_SESSION['token'];
        $user->save();
    
        // Optionally, you can redirect the user after successful creation
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        //
    }
}
