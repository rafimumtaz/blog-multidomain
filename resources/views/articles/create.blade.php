@extends('layouts.app')

@section('content')
    <h1>Tambah Artikel untuk {{ $institution->name }}</h1>

    <form action="{{ route('articles.store', ['institution' => $institution->domain]) }}" method="POST">
        @csrf
        <label>Judul:</label>
        <input type="text" name="title" required>

        <label>Konten:</label>
        <textarea name="content" required></textarea>

        <button type="submit">Simpan</button>
    </form>
@endsection
