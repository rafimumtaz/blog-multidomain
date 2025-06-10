@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 30px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); background-color: #fff;">
    <h1 style="margin-bottom: 20px;">Daftar Artikel untuk <span style="color: #3490dc;">{{ $institution->name }}</span></h1>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('articles.create', ['institution' => $institution->subdomain]) }}"
           style="display: inline-block; background-color: #38c172; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;">
           + Tambah Artikel
        </a>
    </div>  

    @if($articles->isEmpty())
        <p style="color: #888;">Belum ada artikel.</p>
    @else
        <ul style="list-style: none; padding-left: 0;">
            @foreach($articles as $article)
                <li style="border-bottom: 1px solid #eee; padding: 12px 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong style="font-size: 18px;">{{ $article->title }}</strong><br>
                            <small style="color: #666;">{{ $article->created_at->format('d M Y') }}</small>
                        </div>
                        <div>
                            <a href="{{ route('articles.show', ['institution' => $institution->subdomain, 'article' => $article->id]) }}"
                               style="margin-right: 10px; color: #3490dc; text-decoration: none;">Lihat</a>

                            <a href="{{ route('articles.edit', ['institution' => $institution->subdomain, 'article' => $article->id]) }}"
                               style="margin-right: 10px; color: #ff9800; text-decoration: none;">Edit</a>
                            
                            <form action="{{ route('articles.destroy', ['institution' => $institution->subdomain, 'article' => $article->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #e53e3e; text-decoration: none; background: none; border: none; cursor: pointer; padding: 0;">Hapus</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection