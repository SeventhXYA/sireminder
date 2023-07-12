<!DOCTYPE html>
<html>

<head>
    <title>Daftar Rencana Kerja Bupati</title>
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
            margin-top: -13px
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="hiding">
        <img src="assets/images/header.png" width="700">
    </div>

    <table style="margin-top: 110px">
        <thead>
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Rencana Kerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $rencanakerja)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <b>Waktu:</b> {{ \Carbon\Carbon::parse($rencanakerja->start_date)->format('d-M-Y H:i') }}
                        <b>s/d</b>
                        {{ \Carbon\Carbon::parse($rencanakerja->end_date)->format('d-M-Y') }} <br>
                        <b>Lokasi:</b> {{ $rencanakerja->lokasi }} <br>
                        <b>Kategori:</b>
                        @if ($rencanakerja->kategori == 1)
                            <span class="badge bg-danger text-white">Luar
                                Daerah
                                Luar
                                Provinsi</span>
                        @elseif($rencanakerja->kategori == 2)
                            <span class="badge bg-primary text-white">Luar
                                Daerah Dalam
                                Provinsi</span>
                        @elseif($rencanakerja->kategori == 3)
                            <span class="badge bg-success text-white">Dalam
                                Daerah Dalam
                                Kabupaten</span>
                        @endif
                    </td>
                    <td>{{ $rencanakerja->rencana }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
