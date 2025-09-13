@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">🔖 Categories</h2>
            <a href="{{ route('categories.create') }}"
               class="px-4 py-2 bg-gradient-to-r from-gray-200 to-gray-100 text-gray-800 font-medium rounded-lg shadow-sm hover:from-gray-300 hover:to-gray-200 transition">
                ➕ Add New
            </a>
        </div>
    {{-- <h2 class="text-2xl font-semibold mb-6">Categories</h2> --}}
    <table id="categories-table" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-gray-700">#</th>
                <th class="px-4 py-2 text-left text-gray-700">Name</th>
                <th class="px-4 py-2 text-left text-gray-700">Content</th>
                <th class="px-4 py-2 text-left text-gray-700">Created At</th>
                <th class="px-4 py-2 text-left text-gray-700">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        </tbody>
    </table>
</div>
@endsection
@push('style-stack')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css" />
@endpush
@push('script-stack')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables TailwindCSS integration -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
<script>
    $(function () {
        $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('categories.index') }}", 
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'text', name: 'text', render: function (data, type, row) {
                    if (!data) return '';
                    let short = data.length > 100 ? data.substr(0, 100) + '...' : data;
                    return `<span title="${data}">${short}</span>`;
                }},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        console.log('fired');
    });
</script>
@endpush
