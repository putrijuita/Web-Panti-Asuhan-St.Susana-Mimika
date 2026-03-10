<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Donasi Keuangan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111827; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        p { margin: 0 0 6px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #e5e7eb; padding: 6px 8px; }
        th { background-color: #f3f4f6; font-size: 11px; text-transform: uppercase; }
        td { font-size: 11px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .small { font-size: 10px; color: #6b7280; }
    </style>
</head>
<body>
    <h1>Laporan Donasi Keuangan</h1>
    <p class="small">
        Dicetak pada: {{ $generatedAt->format('d/m/Y H:i') }}
    </p>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">#</th>
                <th>Nama Donatur</th>
                <th>Email</th>
                <th style="width:120px;">Nominal Donasi</th>
                <th style="width:140px;">Tanggal / Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donasi as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td class="text-right">
                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                </td>
                <td class="text-center">
                    {{ $item->updated_at->format('d/m/Y H:i') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    Belum ada data donasi keuangan yang tercatat.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

