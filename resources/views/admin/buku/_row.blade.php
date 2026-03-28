<td class="p-3">
    <img src="{{ asset('storage/'.$row->gambar) }}"
    class="w-16 h-16 object-cover cursor-pointer hover:scale-105 transition"
    onclick="showImage('{{ asset('storage/'.$row->gambar) }}')">
</td>
<td class="p-3">{{ $row->kode_buku }}</td>
<td class="p-3">{{ $row->nama_buku }}</td>
<td class="p-3">{{ $row->penulis }}</td>
<td class="p-3">{{ $row->stok }}</td>