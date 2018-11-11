@extends('layouts.app')

@section('content')

<div class="container">
  @if( \Session::has('flash_message'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ \Session::get('flash_message') }}</strong>
    </div>
  @endif
    <div class="row justify-content-center">
          {{ $products->links() }}
          @foreach ($products as $product)
              <div class="col-md-12 panel panel-default  panel--styled">
      					<div class="panel-body">
      						<div class="row panelTop">
      							<div class="col-sm-12 col-md-3 no-padding">
      								<img class="img-responsive" src="{{ $product->img_url }}" alt=""/>
      							</div>
      							<div class="col-sm-12 col-md-9">
                      <div class="row description">
        								<a href="{{ $product->real_url }}" target="_blank"><h2 class="col-12">{{ $product->title }}</h2></a>
        								<p class="col-12">{{ $product->description }}</p>
                      </div>
                      <div class="row panelBottom">
                        <div class="col-md-6 text-center">
                          <form action="/wishlist" method="post">
                             @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn btn-lg btn-add-to-cart"> Add to Whislist</button>
                          </form>
                        </div>
                        <div class="col-md-6 text-center">
                          <h5>Price <span class="itemPrice">{{ $product->price }}</span></h5>
                        </div>
                        </div>
                      </div>
      							</div>
      					</div>
      				</div>
          @endforeach
          {{ $products->links() }}
    </div>
</div>
@endsection
