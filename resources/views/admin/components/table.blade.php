<form id="bulkForm" method="POST" action="{{ $bulkDeleteUrl }}">
@csrf

<div class="bg-white rounded-xl shadow overflow-x-auto">
<table class="w-full text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-center">
                <input type="checkbox" id="checkAll">
            </th>

            @foreach($columns as $col)
                <th class="p-3 text-left">{{ $col }}</th>
            @endforeach

            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $row)
        <tr class="border-t hover:bg-gray-50">

            <td class="p-3 text-center">
                <input type="checkbox" name="ids[]" value="{{ $row->$primaryKey }}">
            </td>
            {{-- ROW --}}
            {!! $rowView($row) !!}
            {{-- AKSI --}}
            <td class="p-3 text-center flex justify-center gap-2">
                <!-- DETAIL -->
                <button type="button"
                    onclick='showDetail(@json($row))'
                    class="bg-blue-500 text-white px-2 py-1 rounded">
                    Detail
                </button>

                <!-- CUSTOM ACTION -->
                @if(isset($actionView))
                    {!! $actionView($row) !!}
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="p-4 text-center text-gray-500">
                Tidak ada data
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
<div class="mt-4 flex justify-end">
    {{ $data->links() }}
</div>

</form>