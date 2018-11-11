<?php

namespace App\Http\Controllers;
use App\Wishlist;
use Auth;
use Form;

use Illuminate\Http\Request;

class SharedWishlistController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {

      $wishlists = Wishlist::where("user_id", "=", $user_id)->orderby('id', 'desc')->paginate(10);
      return view('wishlist.index', compact('user_id', 'wishlists'));
    }

}
