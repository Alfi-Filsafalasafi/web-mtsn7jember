<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Teacher;
use App\Models\WadulGusDar;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Route as RouteFacade;

class StatsOverview extends BaseWidget
{
    /**
     * Ambil URL route dengan aman; kembalikan null kalau nama route-nya tidak ada
     * (biar tidak error kalau nama Resource Filament kamu berbeda).
     */
    protected function safeUrl(string $routeName): ?string
    {
        return RouteFacade::has($routeName) ? route($routeName) : null;
    }

    protected function getStats(): array
    {
        $pesanBelumDibaca = ContactMessage::where('is_read', false)->count();
        $wadulBaru = WadulGusDar::where('status', 'baru')->count();
        $artikelPublished = Article::where('status', 'published')->count();
        $guruAktif = Teacher::where('status', 'aktif')->count();

        return [
            Stat::make('Pesan Kontak Belum Dibaca', $pesanBelumDibaca)
                ->description($pesanBelumDibaca > 0 ? 'Perlu ditindaklanjuti' : 'Semua sudah dibaca')
                ->descriptionIcon($pesanBelumDibaca > 0 ? 'heroicon-m-exclamation-circle' : 'heroicon-m-check-circle')
                ->color($pesanBelumDibaca > 0 ? 'danger' : 'success')
                ->url($this->safeUrl('filament.admin.resources.contact-messages.index')),

            Stat::make('Wadul Gus Dar Baru', $wadulBaru)
                ->description($wadulBaru > 0 ? 'Menunggu tindak lanjut' : 'Tidak ada yang baru')
                ->descriptionIcon($wadulBaru > 0 ? 'heroicon-m-exclamation-circle' : 'heroicon-m-check-circle')
                ->color($wadulBaru > 0 ? 'danger' : 'success')
                ->url($this->safeUrl('filament.admin.resources.wadul-gus-dars.index')),

            Stat::make('Artikel Published', $artikelPublished)
                ->description('Berita & pengumuman tayang')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->url($this->safeUrl('filament.admin.resources.articles.index')),

            Stat::make('Guru & Staf Aktif', $guruAktif)
                ->description('Total guru berstatus aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->url($this->safeUrl('filament.admin.resources.teachers.index')),
        ];
    }
}
