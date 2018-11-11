<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Form;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sort = "title", $type = 'ASC')
    {
      $products = Product::orderby($sort, $type)->paginate(10);
      return view('product.index', compact('products'));
    }

}
