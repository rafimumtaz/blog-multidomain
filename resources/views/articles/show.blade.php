@extends('layouts.app')

@section('content')
<div style="max-width: 700px; margin: 30px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); background-color: #fff;">
    <h1 style="margin-bottom: 15px;">{{ $article->title }}</h1>
    <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
        Dipublikasikan pada: {{ $article->created_at->format('d M Y H:i') }}
    </p>

    <div style="white-space: pre-line; line-height: 1.6; font-size: 16px; margin-bottom: 30px;">
        {{ $article->content }}
    </div>

    <a href="{{ route('articles.index', ['institution' => $institution->subdomain]) }}" 
       style="display: inline-block; background-color: #3490dc; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
       &larr; Kembali ke Daftar Artikel
    </a>
</div>
@endsection
