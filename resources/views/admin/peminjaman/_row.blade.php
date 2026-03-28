@php
    $status = 'Dipinjam';
    $warna = 'bg-yellow-500';

    if (!empty($row->tanggal_kembali)) {
        $status = 'Dikembalikan';
        $warna = 'bg-green-500';
    } elseif (now()->gt($row->batas_kembali)) {
        $status = 'Terlambat';
        $warna = 'bg-red-500';
    }

    $denda = 0;
    if (empty($row->tanggal_kembali) && now()->gt($row->batas_kembali)) {
        $hari = now()->diffInDays($row->batas_kembali);
        $denda = $hari * 10000;
    }
@endphp

<td class="p-3">{{ $row->nama_siswa }}</td>
<td class="p-3">{{ $row->judul }}</td>
<td class="p-3">{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d-m-Y') }}</td>
<td class="p-3">{{ \Carbon\Carbon::parse($row->batas_kembali)->format('d-m-Y') }}</td>
<td class="p-3">
    <span class="text-white px-2 py-1 rounded {{ $warna }}">
        {{ $status }}
    </span>
</td>
<td class="p-3">
    Rp {{ number_format($denda, 0, ',', '.') }}
</td>