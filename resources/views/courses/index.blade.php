@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">📚 Courses</h2>
            <a href="{{ route('courses.create') }}"
               class="px-4 py-2 bg-gradient-to-r from-gray-200 to-gray-100 text-gray-800 font-medium rounded-lg shadow-sm hover:from-gray-300 hover:to-gray-200 transition">
                ➕ Add New
            </a>
        </div>

        <!-- Table -->
        <div class="p-6">
            <table id="courses-table" class="min-w-full divide-y divide-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">#</th>
                        <th class="px-4 py-2 text-left text-gray-600">Image</th>
                        <th class="px-4 py-2 text-left text-gray-600">Title</th>
                        <th class="px-4 py-2 text-left text-gray-600">Modules</th>
                        <th class="px-4 py-2 text-left text-gray-600">Price</th>
                        <th class="px-4 py-2 text-left text-gray-600">Publish</th>
                        <th class="px-4 py-2 text-left text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('style-stack')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css" />
<style>
/* macOS look tweaks */
.dataTables_wrapper {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}
#courses-table thead th {
    background: linear-gradient(to bottom, #f9fafb, #f3f4f6);
    font-weight: 600;
}
#courses-table tbody tr:hover {
    background-color: #f9fafb;
    transition: background 0.2s ease-in-out;
}
</style>
@endpush

@push('script-stack')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
<script>
$(function () {
    let table = $('#courses-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('courses.index') }}", // make sure this is your JSON endpoint
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'modules', name: 'modules_count', searchable: false },
            { data: 'price', name: 'price' },
            { data: 'published', name: 'published', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    // Toggle publish
    $(document).on('change', '.toggle-publish', function () {
        let id = $(this).data('id');
        $.post("{{ route('courses.toggle.publish') }}", {
            id: id,
            _token: '{{ csrf_token() }}'
        }, function (res) {
            table.ajax.reload(null, false);
        });
    });
});
</script>
@endpush
