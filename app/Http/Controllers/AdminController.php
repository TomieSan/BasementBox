<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
  /**
   * Show the form for admin user login
   */
  public function showLogin()
  {
    $ADMIN = 2;
    if (Auth::check() && Auth::user()->level === $ADMIN) {
      return redirect('/admin/users');
    }
    return view('frontend.admin.login');
  }

  /**
   * Process user login request
   */
  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), ['usernameOrEmail' => 'required',
                                                   'password' => 'required']);

    if($validator->fails())
    {
      return redirect()->back()
                       ->withInput($request->except('password'))
                       ->withErrors(['result'=>'The credentials are incorrect. Please check the spelling and try logging in again.']);
    }

    $validated = $validator->validated();

    $user = User::where('username', $validated['usernameOrEmail'])
                ->orWhere('email', $validated['usernameOrEmail'])
                ->first();
    
    if(!Hash::check($validated['password'], $user->password))
    {
      return redirect()->back()
                       ->withInput($request->except('password'))
                       ->withErrors(['result'=>'The credentials are incorrect. Please check the spelling and try logging in again.']);
    }

    $ADMIN = 2;
    if($user->level !== $ADMIN)
    {
      return redirect()->back()
                       ->withInput($request->except('password'))
                       ->withErrors(['result'=>'The account does not have admin permissions!']);
    }

    Auth::login($user);

    $request->session()->regenerate();
 
    return redirect()->intended('/admin/users');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
  }

  /**
   * Show the form for admin user login
   */
  public function showUsers(Request $request)
  {
    $ADMIN = 2;
    if (!Auth::check() || Auth::user()->level !== $ADMIN) {
      return redirect('/admin/login');
    }

    if(!$request['criteria'])
      $request['criteria'] = 'id';
      
    if(!$request['direction'])
      $request['direction'] = 'asc';

    $levels = ['BUYER', 'SELLER', 'ADMIN'];
    $user = User::orderBy($request['criteria'], $request['direction']); // Sort
    if($request['search'] ?? false)
    {
      $user = $user->where('username', 'like', '%'.$request['search'].'%')
                   ->orWhere('email', 'like', '%'.$request['search'].'%');
    }
    $users = $user->paginate(5);
    $links = $users->links();
    $users = $users->toArray()['data'];

    for($i = 0; $i < count($users); $i++)
      $users[$i]['level'] = $levels[$users[$i]['level']];

    $fields = ['ID', 'Username', 'Email', 'Privilege Level', 'Date Created', 'Date Modified'];
    
    return view('frontend.admin.users', ['fields'=>$fields, 'entries'=>$users, 'links'=>$links]);
  }

  /**
   * Show the form for admin user login
   */
  public function showGames(Request $request)
  {
    $ADMIN = 2;
    if (!Auth::check() || Auth::user()->level !== $ADMIN) {
      return redirect('/admin/login');
    }

    if(!$request['criteria'])
      $request['criteria'] = 'id';
      
    if(!$request['direction'])
      $request['direction'] = 'asc';
    
    $games = Game::orderBy($request['criteria'], $request['direction']); // Sort
    if($request['search'] ?? false)
    {
      $games = $games->where('name', 'like', '%'.$request['search'].'%')
                     ->orWhere('excerpt', 'like', '%'.$request['search'].'%')
                     ->orWhere('description', 'like', '%'.$request['search'].'%')
                     ->orWhere('tags', 'like', '%'.$request['search'].'%');
    }
    $games = $games->paginate(5);
    $links = $games->links();
    $games = $games->toArray()['data'];

    $excludeFields = [
      'description',
      'excerpt',
      'tags',
      'logo',
      'gamePic1',
      'gamePic2',
      'gamePic3',
      'gamePic4'
    ];

    for($i = 0; $i < count($games); $i++)
    {
      $games[$i]['publisher_id'] = User::find($games[$i]['publisher_id'])->username;
      foreach ($excludeFields as $field) 
        unset($games[$i][$field]);
    }

    $fields = ['ID', 'Name', 'Publisher', 'Price', 'Rating', 'Date Created', 'Date Modified'];
    
    return view('frontend.admin.games', ['fields'=>$fields, 'entries'=>$games, 'links'=>$links]);
  }

  public function getUser(string $id)
  {
    $user = User::find($id);
    if($user ?? false)
      return response()->json($user);
    else
      return response()->json([],404);
  }

  public function editUser(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'username' => 'required|min:4|max:30',
      'email'    => 'required|email|min:5',
      'level'    => '',
      'password' => [
        'required',
        'confirmed',
        Password::min(12)
          ->letters()
          ->mixedCase()
          ->numbers()
          ->symbols()
      ]
    ]);

    if($validator->fails())
    {
      return redirect()->back()
                       ->withInput($request->except('password', 'password_confirmation'))
                       ->withErrors($validator, 'edit');
    }

    $validated = $validator->validated();
    $validated['password'] = Hash::make($validated['password']);
    User::find($request['id'])->update($validated);
    return redirect()->back();
  }

  public function getGame(string $id)
  {
    $game = Game::find($id);
    if($game ?? false)
      return response()->json($game);
    else
      return response()->json([],404);
  }

  public function editGame(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:5120',
      'publisher_id' => 'required|numeric|exists:users,id',
      'price' => 'required|numeric',
      'excerpt' => 'max:1024',
      'description' => 'max:5120',
      'tags' => 'required',
      'logo' => 'image',
      'gamePic1' => 'image',
      'gamePic2' => 'image',
      'gamePic3' => 'image',
      'gamePic4' => 'image'
    ]);

    
    if($validator->fails())
    {
      return redirect()->back()
                       ->withInput($request->all())
                       ->withErrors($validator, 'edit');
    }

    $validated = $validator->validated();

    $validated['tags'] = $request['tags'];

    $imgs = ['logo'];
    for ($i=1; $i <= 4; $i++)
      $imgs[] = 'gamePic'.$i;


    foreach($imgs as $img)
    {
      if(array_key_exists($img, $validated))
      {
        $path = $request->file($img)->store('public/uploads');
        $path = str_replace('public/', 'storage/', $path);
        $validated[$img] = $path;
      }
    }

    // Elevate user to seller if they aren't already
    $user = User::find($validated['publisher_id']);
    if($user->level < 1)
    {
      $user->level = 1;
      $user->save();
    }

    Game::find($request['id'])->update($validated);
    return redirect()->back();
  }

  public function deleteUsers(Request $request)
  {
    if($request->has('entries') && count($request['entries']) > 0)
    {
      foreach ($request['entries'] as $id) {
        User::where('id',$id)->delete();
      }
    }

    return redirect()->back();
  }

  public function deleteGames(Request $request)
  {
    if($request->has('entries') && count($request['entries']) > 0)
    {
      foreach ($request['entries'] as $id) {
        Game::where('id',$id)->delete();
      }
    }

    return redirect()->back();
  }
}