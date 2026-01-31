<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .container {
            padding: 30px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 20px;
        }
        .company-info h1 {
            color: #0d6efd;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-info h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }
        .invoice-meta {
            color: #666;
        }
        .invoice-meta strong {
            color: #333;
        }
        .parties {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .party {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .party h3 {
            color: #0d6efd;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .party p {
            margin-bottom: 3px;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table.items th {
            background-color: #0d6efd;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        table.items td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        table.items tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table.items .text-right {
            text-align: right;
        }
        table.items .text-center {
            text-align: center;
        }
        .totals {
            width: 300px;
            margin-left: auto;
        }
        .totals table {
            width: 100%;
        }
        .totals td {
            padding: 8px 10px;
        }
        .totals .label {
            text-align: left;
        }
        .totals .value {
            text-align: right;
            font-weight: bold;
        }
        .totals .grand-total {
            background-color: #0d6efd;
            color: white;
            font-size: 14px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }
        .status-draft { background-color: #6c757d; color: white; }
        .status-sent { background-color: #ffc107; color: #333; }
        .status-paid { background-color: #28a745; color: white; }
        .notes {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .notes h4 {
            margin-bottom: 5px;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <table style="width: 100%; margin-bottom: 30px; border-bottom: 2px solid #0d6efd; padding-bottom: 20px;">
            <tr>
                <td style="width: 50%;">
                    <h1 style="color: #0d6efd; font-size: 24px; margin-bottom: 5px;">EkspImpor</h1>
                    <p>Jl. Sudirman No. 123</p>
                    <p>Jakarta Pusat 10220</p>
                    <p>Indonesia</p>
                    <p>Tel: +62 21 1234 5678</p>
                </td>
                <td style="width: 50%; text-align: right;">
                    <h2 style="font-size: 28px; color: #333; margin-bottom: 10px;">INVOICE</h2>
                    <p><strong>No:</strong> {{ $invoice->invoice_number }}</p>
                    <p><strong>Tanggal:</strong> {{ $invoice->issue_date->format('d/m/Y') }}</p>
                    <p><strong>Jatuh Tempo:</strong> {{ $invoice->due_date->format('d/m/Y') }}</p>
                    <p style="margin-top: 10px;">
                        <span class="status-badge status-{{ $invoice->status }}">{{ strtoupper($invoice->status) }}</span>
                    </p>
                </td>
            </tr>
        </table>

        <!-- Customer Info -->
        <table style="width: 100%; margin-bottom: 30px;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <h3 style="color: #0d6efd; font-size: 14px; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Kepada:</h3>
                    <p><strong>{{ $invoice->sale->customer->name }}</strong></p>
                    @if($invoice->sale->customer->company)
                        <p>{{ $invoice->sale->customer->company }}</p>
                    @endif
                    <p>{{ $invoice->sale->customer->address }}</p>
                    <p>{{ $invoice->sale->customer->country }}</p>
                    <p>Email: {{ $invoice->sale->customer->email }}</p>
                    @if($invoice->sale->customer->phone)
                        <p>Tel: {{ $invoice->sale->customer->phone }}</p>
                    @endif
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <h3 style="color: #0d6efd; font-size: 14px; margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Referensi Penjualan:</h3>
                    <p><strong>No. Sale:</strong> {{ $invoice->sale->sale_number }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($invoice->sale->status) }}</p>
                    @if($invoice->sale->eta)
                        <p><strong>ETA:</strong> {{ $invoice->sale->eta->format('d/m/Y') }}</p>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Items Table -->
        <table class="items">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Kode</th>
                    <th style="width: 35%;">Deskripsi</th>
                    <th style="width: 10%;" class="text-center">Qty</th>
                    <th style="width: 10%;">Unit</th>
                    <th style="width: 12%;" class="text-right">Harga</th>
                    <th style="width: 13%;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->sale->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->product->code }}</td>
                    <td>
                        {{ $item->product->name }}
                        @if($item->product->hs_code)
                            <br><small style="color: #666;">HS: {{ $item->product->hs_code }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td>{{ $item->product->unit }}</td>
                    <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals">
            <table>
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="value">Rp {{ number_format($invoice->sale->subtotal, 0, ',', '.') }}</td>
                </tr>
                @if($invoice->sale->tax_amount > 0)
                <tr>
                    <td class="label">Pajak ({{ $invoice->sale->tax_rate }}%):</td>
                    <td class="value">Rp {{ number_format($invoice->sale->tax_amount, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="grand-total">
                    <td class="label" style="background-color: #0d6efd; color: white; padding: 10px;">TOTAL:</td>
                    <td class="value" style="background-color: #0d6efd; color: white; padding: 10px;">Rp {{ number_format($invoice->sale->total, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <!-- Notes -->
        @if($invoice->sale->notes)
        <div class="notes" style="margin-top: 30px;">
            <h4>Catatan:</h4>
            <p>{{ $invoice->sale->notes }}</p>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda.</p>
            <p>Invoice ini digenerate secara otomatis oleh sistem EkspImpor.</p>
            <p style="margin-top: 10px;">© {{ date('Y') }} EkspImpor - Export Import Solutions</p>
        </div>
    </div>
</body>
</html>
