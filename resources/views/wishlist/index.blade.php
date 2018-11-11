@extends('layouts.app')

@section('content')

<div class="container">
  @if( \Session::has('flash_message'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ \Session::get('flash_message') }}</strong>
    </div>
  @endif

  @if (Auth::user() && Auth::user()->id == $user_id)
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Sharing link: http://127.0.0.1:8000/sharedwishlist/{{$user_id}}</strong>
  </div>
  @endif
    <div class="row justify-content-center">
          {{ $wishlists->links() }}
          @foreach ($wishlists as $wishlist)
              <div class="col-md-12 panel panel-default  panel--styled">
      					<div class="panel-body">
      						<div class="row panelTop">
      							<div class="col-sm-12 col-md-3 no-padding">
      								<img class="img-responsive" src="{{ $wishlist->product->img_url }}" alt=""/>
      							</div>
      							<div class="col-sm-12 col-md-9">
                      <div class="row description">
        								<a href="{{ $wishlist->product->real_url }}" target="_blank"><h2 class="col-12">{{ $wishlist->product->title }}</h2></a>
        								<p class="col-12">{{ $wishlist->product->description }}</p>
                      </div>
                      <div class="row panelBottom">
                        <div class="col-md-6 text-center">
                        @if (Auth::user() && Auth::user()->id == $user_id)
                          {{ Form::open(array('url' => 'wishlist/' . $wishlist->id, null)) }}
                              {{ Form::hidden('_method', 'DELETE') }}
                              {{ Form::submit('Remove from Whislist', array('class' => 'btn btn-lg btn-add-to-cart')) }}
                          {{ Form::close() }}
                        @endif
                        </div>
                        <div class="col-md-6 text-center">
                          <h5>Price <span class="itemPrice">{{ $wishlist->product->price }}</span></h5>
                        </div>
                        </div>
                      </div>
      							</div>
      					</div>
      				</div>
          @endforeach
          {{ $wishlists->links() }}
    </div>
</div>
@endsection
