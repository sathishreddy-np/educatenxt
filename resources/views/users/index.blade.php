<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    {{-- jQuery DataTables --}}
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

    {{-- Bootstrap5 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    {{-- Search Panes --}}
    <link href="https://cdn.datatables.net/searchpanes/2.3.3/css/searchPanes.bootstrap5.css" rel="stylesheet">

    {{-- Select --}}
    <link href="https://cdn.datatables.net/select/2.1.0/css/select.bootstrap5.css" rel="stylesheet">

    {{-- Buttons --}}
    <link href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

    {{-- Responsive --}}
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css" rel="stylesheet">

    {{-- ColReorder --}}
    <link href="https://cdn.datatables.net/colreorder/2.0.4/css/colReorder.bootstrap5.css" rel="stylesheet">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>

    {{-- jQuery DataTables --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>

    {{-- Datatables --}}
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js" defer></script>

    {{-- SearchPanes --}}
    <script src="https://cdn.datatables.net/searchpanes/2.3.3/js/dataTables.searchPanes.js" defer></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.3/js/searchPanes.bootstrap5.js" defer></script>

    {{-- Select Rows --}}
    <script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.js" defer></script>
    <script src="https://cdn.datatables.net/select/2.1.0/js/select.bootstrap5.js" defer></script>

    {{-- Buttons --}}
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.colVis.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" defer></script>

    {{-- Responsive --}}
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js" defer></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js" defer></script>

    {{-- ColReorder --}}
    <script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.js" defer></script>
    <script src="https://cdn.datatables.net/colreorder/2.0.4/js/colReorder.bootstrap5.js" defer></script>

    {{-- Bootstrap5 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js" defer></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    <!-- DataTable Scripts -->
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
</body>

</html>
