<form method="POST" action="{{ route('articles.update', ['institution' => $institution->subdomain, 'article' => $article->id]) }}">
    @csrf
    @method('PUT')

    <label>Judul:</label><br>
    <input type="text" name="title" value="{{ old('title', $article->title) }}"><br><br>

    <label>Konten:</label><br>
    <textarea name="content">{{ old('content', $article->content) }}</textarea><br><br>

    <button type="submit">Perbarui</button>
</form>
