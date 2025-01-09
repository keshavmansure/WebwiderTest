@extends('layouts.app')


@section('body')
    <h1>Admin Login Page</h1>

      @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
      @endif

   <div class="row ">
    <div class="card col-6 ">
      <form action="{{ route('admins.login') }}" method="POST">
          @csrf
          <div class="mb-3">
              <label for="email">Email</label>
              <input type="text" class="form-control"  name="email" id="email" placeholder="Enter Your Email">
              @error('email')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password"  class="form-control" name="password" id="password" placeholder="Enter Your Password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
          <button type="submit">Submit</button>
        </div>

      </form>

  </div>
   </div>
@endsection
