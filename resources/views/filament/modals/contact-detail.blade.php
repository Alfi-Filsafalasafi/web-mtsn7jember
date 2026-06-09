<div class="space-y-4">

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <p style="color: #6b7280; margin-bottom: 2px;">Nama</p>
            <p style="font-weight: 600;">{{ $message->name }}</p>
        </div>
        <div>
            <p style="color: #6b7280; margin-bottom: 2px;">Email</p>
            <p style="font-weight: 600;">{{ $message->email }}</p>
        </div>
        <div>
            <p style="color: #6b7280; margin-bottom: 2px;">No. Telepon</p>
            <p style="font-weight: 600;">{{ $message->phone ?? '-' }}</p>
        </div>
        <div>
            <p style="color: #6b7280; margin-bottom: 2px;">Dikirim</p>
            <p style="font-weight: 600;">{{ $message->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <hr>

    <div>
        <p style="color: #6b7280; margin-bottom: 6px; font-size: 13px;">Isi Pesan</p>
        <div style="background: #f9fafb; border-radius: 8px; padding: 16px; font-size: 14px; line-height: 1.6;">
            {{ $message->message }}
        </div>
    </div>

    <div>
        <span style="padding: 2px 10px; border-radius: 999px; font-size: 12px; {{ $message->is_read ? 'background: #dcfce7; color: #15803d;' : 'background: #fee2e2; color: #b91c1c;' }}">
            {{ $message->is_read ? 'Sudah dibaca' : 'Belum dibaca' }}
        </span>
    </div>

</div>
