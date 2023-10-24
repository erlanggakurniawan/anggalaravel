   
    {{-- Mengambil apa yang ada di dalam main.blade.php --}}
    @extends('layouts.main')

    {{-- Isi nya @yield('container') --}}
    @section('container')
    <h1>Halaman {{ $title }}</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
    <img src="img/angga.jpg" alt="{{ $name }}" width="200px" class="img-thumbnail rounded-circle">
    @endsection