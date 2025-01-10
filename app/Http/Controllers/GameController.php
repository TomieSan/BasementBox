<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Game;
use App\Models\PurchaseDetail;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
  public function showIndexGames()
  {
    $newGames = Game::latest()->take(10)->get();
    $popGames = Game::orderBy('rating', 'desc')->take(10)->get();
    return view('frontend.index',['newGames'=>$newGames, 'popGames'=>$popGames]);
  }

  public function showGames(Request $request)
  {
    if(!$request['criteria'])
      $request['criteria'] = 'name';
      
    if(!$request['direction'])
      $request['direction'] = 'asc';
    
    $games = Game::orderBy($request['criteria'], $request['direction']); // Sort
    // Filter
    if($request['search'] ?? false)
    {
      $games = $games->where('name', 'like', '%'.$request['search'].'%')
                     ->orWhere('tags', 'like', '%'.$request['search'].'%');
    }
    return view('frontend.browsegames',['games'=>$games->paginate(20)]);
  }

  public function showGame(string $id)
  {
    $game = Game::find($id);
    return view('frontend.gamepage', ['game'=>$game]);
  }

  public function reviewGame(Request $request)
  {
    if (!Auth::check()) {
      return redirect('/login');
    }
    
    $validator = Validator::make($request->all(), [
      'game_id'=>'required|numeric',
      'rating'=>'required|numeric',
      'title'=>'max:1024',
      'body'=>'max:5120'
    ]);

    if($validator->fails())
    {
      return redirect()->back()
                       ->withInput($request->all())
                       ->withErrors($validator,'review');
    }

    $validated = $validator->validated();
    $validated['user_id'] = Auth::id();

    $new_review = new Review();
    $new_review->create($validated);

    $game = Game::find($validated['game_id']);
    $game->rating = $game->reviews()->avg('rating');
    $game->save();

    session()->flash('success', 'Your review has been posted!');
    return redirect()->back();
  }

  /**
   * Show the form for user registration
   */
  public function showPublish()
  {
    if (!Auth::check()) {
      return redirect('/login');
    }
    return view('frontend.publish');
  }

  /**
   * Store a newly created account in storage.
   */
  public function publish(Request $request)
  {
    if (!Auth::check()) {
      return redirect('/login');
    }

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
                       ->withErrors($validator, 'add');
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

    $new_game = new Game($validated);
    $new_game->save();

    if(str_contains(url()->previous(), 'admin'))
      return redirect('/admin/games');
    else
      return redirect(sprintf('/games/%s', $new_game->id));
  }

  public function addToCart(Request $request)
  {
    if (!Auth::check()) {
      return redirect('/login');
    }

    if(!$request['quantity'])
      $request['quantity'] = 1;

    $request['user_id'] = Auth::id();

    $new_item = new CartItems();
    $request = $new_item->create($request->all());

    return redirect('/cart');
  }

  public function showCart()
  {
    if (!Auth::check()) {
      return redirect('/login');
    }

    $items = User::find(Auth::id())->cart()->get();
    return view('frontend.cart', ['items'=>$items]);
  }

  public function modifyQuantity(Request $request)
  {
    if (!Auth::check()) {
      return redirect('/login');
    }
    foreach($request['quantity'] as $id => $new_quantity)
      CartItems::where('id', $id)->update(['quantity'=>$new_quantity]);

    return redirect('/cart');
  }

  public function deleteFromCart(Request $request)
  {
    if (!Auth::check()) {
      return redirect('/login');
    }
    CartItems::where('id',$request['id'])->delete();
    return redirect('/cart');
  }

  public function showCheckout()
  {
    if (!Auth::check()) {
      return redirect('/login');
    }

    $items = User::find(Auth::id())->cart()->get();
    return view('frontend.checkout', ['items'=>$items]);
  }

  public function checkout(Request $request)
  {
    if (!Auth::check()) {
      return redirect('/login');
    }

    $validator = Validator::make($request->all(),[
      "firstName" => "required",
      "lastName" => "required",
      "address1" => "required",
      "address2" => "",
      "province" => "required",
      "zip" => "required",
      "sameAddress" => "",
      "paymentMethod" => "required",
      "nameOnCard" => "required",
      "ccNumber" => "required",
      "ccExpiration" => "required",
      "ccCvv" => "required"
    ]);

    if($validator->fails())
    {
      return redirect()->back()
                      ->withInput($request->all())
                      ->withErrors($validator);
    }

    $validated = $validator->validated();

    $validated['user_id'] = Auth::id();

    $address2 = ($validated['address2'] ?? false) ? $validated['address2'] : '';
    $validated['address'] = $validated['address1'].' '.$address2;
    unset($validated['address1']);
    if($validated['address2'])
      unset($validated['address2']);

    $validated['sameAddress'] = ($validated['sameAddress'] ?? false) ? true : false;

    $new_purchase = new PurchaseDetail();
    $new_purchase->create($validated);

    CartItems::where('user_id', Auth::id())->delete();

    return redirect('/thanks');
  }
}
