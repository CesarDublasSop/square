<?php

namespace App\Http\Controllers;
use App\Wishlist;
use Auth;
use Form;

use Illuminate\Http\Request;

class WishlistController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id=null)
    {
      if ($user_id == null){
        $user_id = Auth::user()->id;
      }

      $wishlists = Wishlist::where("user_id", "=", $user_id)->orderby('id', 'desc')->paginate(10);
      return view('wishlist.index', compact('user_id', 'wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $status = Wishlist::where('user_id', Auth::user()->id)
        ->where('product_id',$request->product_id)
        ->first();

        if(isset($status->user_id) and isset($request->product_id))
         {
             return redirect()->back()->with('flash_message', 'This item is already in your
             wishlist!');
         }
         else
         {
             $wishlist = new Wishlist;

             $wishlist->user_id = Auth::user()->id;
             $wishlist->product_id = $request->product_id;
             $wishlist->save();

             return redirect()->back()->with('flash_message',
                           'Item, '. $wishlist->product->title.' Added to your wishlist.');
         }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $wishlist = Wishlist::findOrFail($id);
      $wishlist->delete();

      return redirect()->route('wishlist.index')
          ->with('flash_message',
           'Item successfully deleted');
    }
}
