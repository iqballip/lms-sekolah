@extends('be.master')

@section('menu')
    @include('be.menu')
@endsection

@section('purchase')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

    * { font-family: 'DM Sans', sans-serif; }

    :root {
        --bg:        #F4F5F7;
        --surface:   #FFFFFF;
        --border:    #E2E5EA;
        --accent:    #3D4A5C;
        --accent-lt: #5C6E85;
        --accent-xs: #EEF0F4;
        --text-main: #1E2530;
        --text-muted:#6B7280;
        --shadow:    0 1px 4px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.05);
    }

    body { background: var(--bg); }

    /* ── Page header ─────────────────────────────── */
    .page-header {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 18px 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: var(--shadow);
    }
    .page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .page-header .icon-wrap {
        width: 40px; height: 40px;
        background: var(--accent-xs);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .page-header .icon-wrap svg { color: var(--accent); }
    .page-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-main);
    }
    .page-header p {
        margin: 2px 0 0;
        color: var(--text-muted);
        font-size: 0.8rem;
    }

    .btn-add-new {
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 9px 18px;
        font-size: 0.83rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s, transform 0.1s;
        white-space: nowrap;
    }
    .btn-add-new:hover {
        background: var(--accent-lt);
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    /* ── Table card ──────────────────────────────── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    .table-card-header {
        padding: 18px 24px 14px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-card-header span {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.4px;
        color: var(--accent);
    }
    .table-card-header::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
        margin-left: 8px;
    }

    /* ── Table ───────────────────────────────────── */
    .table-responsive { overflow-x: auto; }

    table.purchase-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.82rem;
    }
    table.purchase-table thead tr {
        background: var(--accent-xs);
    }
    table.purchase-table thead th {
        padding: 10px 14px;
        font-size: 0.67rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.9px;
        color: var(--accent);
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }
    table.purchase-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.12s;
    }
    table.purchase-table tbody tr:last-child {
        border-bottom: none;
    }
    table.purchase-table tbody tr:hover {
        background: #fafbfc;
    }
    table.purchase-table td {
        padding: 10px 14px;
        color: var(--text-main);
        vertical-align: middle;
    }
    table.purchase-table td.text-center { text-align: center; }

    /* rowspan header cells */
    table.purchase-table td.cell-header {
        background: #f8f9fb;
        font-weight: 600;
        color: var(--text-main);
        border-right: 1px solid var(--border);
    }

    .mono {
        font-family: 'DM Mono', monospace;
        font-size: 0.8rem;
    }

    /* badge for no-item */
    .badge-muted {
        background: var(--accent-xs);
        color: var(--text-muted);
        border-radius: 6px;
        padding: 3px 10px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    /* product image */
    .prod-img {
        width: 40px; height: 40px;
        object-fit: cover;
        border-radius: 7px;
        border: 1px solid var(--border);
    }

    /* total badge */
    .total-badge {
        background: var(--accent);
        color: white;
        border-radius: 7px;
        padding: 4px 10px;
        font-family: 'DM Mono', monospace;
        font-size: 0.78rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* action buttons */
    .btn-action {
        width: 30px; height: 30px;
        border-radius: 7px;
        display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid var(--border);
        background: var(--surface);
        cursor: pointer;
        transition: all 0.15s;
        text-decoration: none;
    }
    .btn-action:hover { transform: translateY(-1px); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .btn-action.edit  { color: var(--accent); }
    .btn-action.edit:hover  { background: var(--accent-xs); border-color: var(--accent); }
    .btn-action.del   { color: #c0392b; }
    .btn-action.del:hover   { background: #fdf2f2; border-color: #f0c4c4; }

    /* pagination override */
    .pagination .page-link {
        border-radius: 7px !important;
        border: 1px solid var(--border);
        color: var(--accent);
        font-size: 0.82rem;
        padding: 5px 11px;
        margin: 0 2px;
    }
    .pagination .page-item.active .page-link {
        background: var(--accent);
        border-color: var(--accent);
        color: white;
    }
</style>

<div class="container-fluid py-4">
<div class="row">
<div class="col-12">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="icon-wrap">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
                </svg>
            </div>
            <div>
                <h5>{{ $title }}</h5>
                <p>Daftar semua data pembelian produk</p>
            </div>
        </div>
        <a href="{{ route('purchase.create') }}" class="btn-add-new">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New {{ $title }}
        </a>
    </div>

    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-card-header">
            <span>{{ $title }} Data</span>
        </div>

        <div class="table-responsive">
            <table class="purchase-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Distributor</th>
                        <th>Product</th>
                        <th class="text-center">Expired Date</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Selling Price</th>
                        <th class="text-center">Purchase Price</th>
                        <th class="text-center">Selling Margin</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Sub Total</th>
                        <th class="text-center">Total Pay</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $nmr = 1; @endphp
                    @foreach ($datas as $data)
                        @php $details = $data->details; $rowspan = max($details->count(), 1); @endphp

                        @if ($details->count() > 0)
                            @foreach ($details as $i => $detail)
                                <tr>
                                    @if ($i === 0)
                                        <td rowspan="{{ $rowspan }}" class="cell-header align-middle">{{ $nmr }}</td>
                                        <td rowspan="{{ $rowspan }}" class="cell-header align-middle mono">{{ $data->no_nota }}</td>
                                        <td rowspan="{{ $rowspan }}" class="cell-header align-middle">{{ $data->tgl_nota }}</td>
                                        <td rowspan="{{ $rowspan }}" class="cell-header align-middle">{{ $data->distributor->nama_distributor ?? '-' }}</td>
                                    @endif

                                    <td>{{ $detail->product->nama_barang ?? '-' }}</td>
                                    <td class="text-center mono">{{ $detail->product->tgl_expired ?? '-' }}</td>
                                    <td class="text-center mono">{{ $detail->product->stok ?? '-' }}</td>
                                    <td class="text-center mono">Rp {{ number_format($detail->product->harga_jual ?? 0) }}</td>
                                    <td class="text-center mono">Rp {{ number_format($detail->harga_beli) }}</td>
                                    <td class="text-center mono">Rp {{ number_format($detail->margin_jual) }}</td>
                                    <td class="text-center mono">{{ $detail->jumlah_beli }}</td>
                                    <td class="text-center">
                                        @if (!empty($detail->product->foto_barang))
                                            <img src="{{ asset('storage/' . $detail->product->foto_barang) }}" alt="foto" class="prod-img">
                                        @else
                                            <span class="badge-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center mono">Rp {{ number_format($detail->subtotal) }}</td>

                                    @if ($i === 0)
                                        <td rowspan="{{ $rowspan }}" class="text-center align-middle cell-header">
                                            <span class="total-badge">Rp {{ number_format($data->total_bayar) }}</span>
                                        </td>
                                        <td rowspan="{{ $rowspan }}" class="text-center align-middle cell-header">
                                            <div style="display:flex;gap:6px;justify-content:center;">
                                                <a href="{{ route('purchase.edit', $data->id) }}" class="btn-action edit" title="Edit">
                                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                </a>
                                                <form action="{{ route('purchase.destroy', $data->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action del" title="Hapus">
                                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="cell-header">{{ $nmr }}</td>
                                <td class="cell-header mono">{{ $data->no_nota }}</td>
                                <td class="cell-header">{{ $data->tgl_nota }}</td>
                                <td class="cell-header">{{ $data->distributor->nama_distributor ?? '-' }}</td>
                                <td colspan="9" class="text-center"><span class="badge-muted">No items</span></td>
                                <td class="text-center">
                                    <span class="total-badge">Rp {{ number_format($data->total_bayar) }}</span>
                                </td>
                                <td class="text-center">
                                    <div style="display:flex;gap:6px;justify-content:center;">
                                        <a href="{{ route('purchase.edit', $data->id) }}" class="btn-action edit" title="Edit">
                                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        </a>
                                        <form action="{{ route('purchase.destroy', $data->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action del" title="Hapus">
                                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @php $nmr++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-4 py-3" style="border-top: 1px solid var(--border);">
            {{ $datas->links() }}
        </div>
    </div>

</div>
</div>
</div>

<script>
    @if (session('simpan'))
        swal("Success", "{{ session('simpan') }}", "success");
    @endif
    @if (session('ubah'))
        swal("Success", "{{ session('ubah') }}", "success");
    @endif
    @if (session('hapus'))
        swal("Deleted", "{{ session('hapus') }}", "success");
    @endif
</script>

@endsection