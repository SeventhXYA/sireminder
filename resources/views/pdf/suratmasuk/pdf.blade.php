<!DOCTYPE html>
<html>

<head>
    <title>Daftar Surat Masuk</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 110px;
        }

        h1 {
            font-family: Verdana, sans-serif;
        }

        .badge {
            font-family: "Segoe UI", Arial, sans-serif;
        }

        tr {
            page-break-inside: avoid;
            font-size: 12px;
        }

        .hiding {
            position: fixed;
            top: 0;
            z-index: 1;
            background-color: white;
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="hiding">
        <img src="assets/images/header2.png" width="1025">
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pengirim</th>
                <th>Nomor Surat</th>
                <th style="width: 5rem;">Tanggal Surat</th>
                <th style="width: 5rem;">Tanggal Masuk</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $suratmasuk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $suratmasuk->pengirim }}</td>
                    <td>{{ $suratmasuk->no_surat }}</td>
                    <td>
                        @if ($suratmasuk->tgl_surat)
                            {{ \Carbon\Carbon::parse($suratmasuk->tgl_surat)->format('d-M-Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $suratmasuk->created_at->format('d-M-Y') }}</td>
                    <td>{{ $suratmasuk->perihal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
