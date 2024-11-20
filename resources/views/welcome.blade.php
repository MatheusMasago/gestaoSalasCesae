@extends('util.master')


@section('content')
<div >
    <img src="{{asset('images/background1.png')}}" width="300" height="300" alt="">
</div>

<div class="position-absolute top-50 start-50 translate-middle">
    <form>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>

<div class="position-absolute top-100 start-100 translate-middle">
    <img src="{{asset('images/background2.png')}}" width="300" height="300" alt="">
</div>
@endsection
