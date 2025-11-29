@extends('layout.itsidebar')

@section('content')

<div class="content">
    <h1 class="mb-3" style="color:#0f172a;">Management User</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Daftar User</h5>

            {{-- Tombol Export di kanan --}}
            <div class="d-flex justify-content-end mb-3">
                <a href="#" class="btn btn-success">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
                </a>
            </div>

            <div class="table-responsive custom-table-wrapper">
                <table class="table table-striped mt-3">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Section</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Kode User</th>
                            <th>Is Active</th>
                            <th>Level</th>
                            <th>Is User Computer</th>
                            <th>Created At</th>
                            <th>Image Sign</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- Dummy Data Contoh --}}
                        <tr>
                            <td>1</td>
                            <td>Aji Rofi</td>
                            <td>IT</td>
                            <td>ajirofi</td>
                            <td>•••••••</td>
                            <td>aji@example.com</td>
                            <td>08123456789</td>
                            <td>AICC-001</td>
                            <td>Yes</td>
                            <td>Admin</td>
                            <td>Yes</td>
                            <td>2024-11-10</td>
                            <td><img src="/images/sign/aji.png" width="60"></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Titin</td>
                            <td>HR</td>
                            <td>titin123</td>
                            <td>•••••••</td>
                            <td>titin@example.com</td>
                            <td>08129876543</td>
                            <td>AICC-002</td>
                            <td>No</td>
                            <td>User</td>
                            <td>No</td>
                            <td>2024-11-12</td>
                            <td><img src="/images/sign/titin.png" width="60"></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
