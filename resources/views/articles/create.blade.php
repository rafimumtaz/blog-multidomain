@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 30px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <h1 style="margin-bottom: 20px;">Tambah Artikel untuk {{ $institution->name }}</h1>

    <form action="{{ route('articles.store', ['institution' => $institution->domain]) }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Judul:</label>
            <input id="title" type="text" name="title" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="content" style="display: block; font-weight: bold; margin-bottom: 5px;">Konten:</label>
            <textarea id="content" name="content" required style="width: 100%; height: 120px; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>

        <button type="submit" style="background-color: #3490dc; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Simpan</button>
    </form>
</div>
@endsection
