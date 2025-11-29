<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management User – PT AICC</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fafb;
        }
        .content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('layout.itsidebar')

    <div class="content">
        <h1 class="mb-3" style="color:#0f172a;">Management User</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Daftar User</h5>

                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh dummy data --}}
                        <tr>
                            <td>1</td>
                            <td>Aji Rofi</td>
                            <td>aji@example.com</td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Titin</td>
                            <td>titin@example.com</td>
                            <td>User</td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        {{-- Nanti bisa diganti foreach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
