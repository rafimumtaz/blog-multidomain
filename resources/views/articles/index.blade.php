@extends('layouts.app')

@section('content')
    <h1>Daftar Artikel untuk {{ $institution->name }}</h1>

    <a href="{{ route('articles.create', ['institution' => $institution->subdomain]) }}">Tambah Artikel</a>


    <ul>
        @foreach($articles as $article)
            <li>
                <a href="{{ route('articles.show', ['institution' => $institution->subdomain, 'article' => $article->id]) }}">Lihat</a>
                {{ $article->title }} - {{ $article->created_at->format('d M Y') }}
                | 
                <a href="{{ route('articles.edit', ['institution' => $institution->subdomain, 'article' => $article->id]) }}">Edit</a>

        @endforeach
    </ul>
@endsection
