@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
  <div class="col-lg-5">
    {{-- form --}}
    <main class="form-registration">
      <h1 class="h3 mb-3 fw-normal text-center">Daftar Akun</h1>
      <form action="/register" method="post">
        {{-- csrf untuk menjaga keamanan --}}
        @csrf

        <div class="form-floating">
          <input type="text" name="name" class="form-control rounded-top 
          {{-- jika name eror kasih class invalid --}}
          @error('name')is-invalid @enderror" id="name" placeholder="name@example.com" required value="{{ old('name') }}">
          <label for="name">Name</label>
          {{-- jika eror maka jalankan invalid feedback --}}
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="text" name="username" class="form-control @error('username')is-invalid @enderror" id="username" placeholder="username@example.com" required {{ old('username') }}>
          <label for="username">Username</label>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('username')is-invalid @enderror" id="email" placeholder="email@example.com" required {{ old('email') }}>
          <label for="email">Email Address</label>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control rounded-bottom @error('username')is-invalid @enderror" id="password" placeholder="Password" required>
          <label for="password">Password</label>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
    
        <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Daftar</button>
      </form>
      <small class="d-block text-center mt-3">Sudah mempunyai akun ? <a href="/login">Masuk</a></small>
    </main>
  </div>
</div>

@endsection