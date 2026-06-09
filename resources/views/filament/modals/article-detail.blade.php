<div class="space-y-4">

    @if ($article->thumbnail)
    <img
        src="{{ Storage::url($article->thumbnail) }}"
        alt="{{ $article->title }}"
        class="w-full rounded-lg object-cover max-h-64">
    @endif

    <div class="flex gap-2 text-sm">
        <span style="padding: 2px 10px; border-radius: 999px; background: #dbeafe; color: #1d4ed8;">
            {{ ucfirst($article->category) }}
        </span>
        <span style="padding: 2px 10px; border-radius: 999px; {{ $article->status === 'published' ? 'background: #dcfce7; color: #15803d;' : 'background: #fee2e2; color: #b91c1c;' }}">
            {{ ucfirst($article->status) }}
        </span>
    </div>

    <div class="text-sm text-gray-500">
        Penulis: <strong>{{ $article->user->name }}</strong>
        &nbsp;|&nbsp;
        {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : 'Belum dipublish' }}
    </div>

    <hr>

    <div class="prose max-w-none text-sm">
        {!! $article->body !!}
    </div>

</div>
