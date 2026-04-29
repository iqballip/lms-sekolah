@extends('be.master')

@section('menu')
    @include('be.menu')
@endsection

@section('sale')

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

    .page-header {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 22px 28px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: var(--shadow);
    }
    .page-header .icon-wrap {
        width: 44px; height: 44px;
        background: var(--accent-xs);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .page-header .icon-wrap svg { color: var(--accent); }
    .page-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-main);
    }
    .page-header p {
        margin: 2px 0 0;
        color: var(--text-muted);
        font-size: 0.82rem;
    }

    .form-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 24px 28px;
        margin-bottom: 16px;
        box-shadow: var(--shadow);
    }
    .section-title {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.4px;
        color: var(--accent);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    .form-label {
        font-size: 0.76rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
    }
    .form-control {
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.88rem;
        color: var(--text-main);
        background: var(--surface);
        padding: 9px 13px;
        transition: border-color 0.15s, box-shadow 0.15s;
        width: 100%;
        box-sizing: border-box;
    }
    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(61,74,92,0.1);
        outline: none;
    }
    .form-control::placeholder { color: #B0B8C4; }
    select.form-control { cursor: pointer; }

    .readonly-field {
        background: #EBEEF2 !important;
        color: var(--accent) !important;
        font-weight: 600;
        border-color: var(--border) !important;
        cursor: default;
        font-family: 'DM Mono', monospace;
        font-size: 0.84rem !important;
    }

    .input-group-custom {
        display: flex;
        align-items: stretch;
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .input-group-custom:focus-within {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(61,74,92,0.1);
    }
    .input-group-custom .prefix {
        background: var(--accent-xs);
        color: var(--accent-lt);
        font-size: 0.78rem;
        font-weight: 700;
        padding: 0 12px;
        display: flex;
        align-items: center;
        border-right: 1px solid var(--border);
        white-space: nowrap;
        font-family: 'DM Mono', monospace;
    }
    .input-group-custom .form-control {
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        flex: 1;
    }

    .subtotal-preview {
        background: var(--accent-xs);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .subtotal-preview .label {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .subtotal-preview .value {
        font-family: 'DM Mono', monospace;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--accent);
    }

    .total-box {
        background: var(--accent);
        border-radius: 10px;
        padding: 18px 24px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .total-box .total-label {
        font-size: 0.82rem;
        font-weight: 600;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .total-box .total-value {
        font-family: 'DM Mono', monospace;
        font-size: 1.4rem;
        font-weight: 800;
    }

    .action-row {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
    }
    .btn-cancel {
        background: transparent;
        color: var(--text-muted);
        border: 1px solid var(--border);
        border-radius: 9px;
        padding: 10px 28px;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        line-height: 1;
        transition: all 0.2s;
    }
    .btn-cancel:hover {
        background: var(--accent-xs);
        color: var(--text-main);
        border-color: #ccc;
        text-decoration: none;
    }
    .btn-save {
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 9px;
        padding: 10px 28px;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        line-height: 1;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-save:hover {
        background: var(--accent-lt);
        transform: translateY(-1px);
        color: white;
    }

    /* ── Sale Datas Table ───────────────────────── */
    .sale-table-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 24px 28px;
        margin-top: 24px;
        box-shadow: var(--shadow);
    }
    .sale-table-section table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }
    .sale-table-section thead th {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-muted);
        padding: 10px 14px;
        border-bottom: 1px solid var(--border);
        text-align: left;
    }
    .sale-table-section tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--border);
        color: var(--text-main);
        vertical-align: middle;
    }
    .sale-table-section tbody tr:last-child td {
        border-bottom: none;
    }
    .sale-table-section tbody tr:hover {
        background: var(--accent-xs);
    }
    .badge-struk {
        font-family: 'DM Mono', monospace;
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--accent-xs);
        color: var(--accent);
        padding: 3px 10px;
        border-radius: 6px;
    }
    .money {
        font-family: 'DM Mono', monospace;
        font-weight: 600;
        color: var(--accent);
    }
    .empty-state {
        text-align: center;
        padding: 40px 0;
        color: var(--text-muted);
        font-size: 0.85rem;
    }
</style>

<div class="container-fluid py-4">
<div class="row justify-content-center">
<div class="col-12 col-xl-8">

    {{-- Header --}}
    <div class="page-header">
        <div class="icon-wrap">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                <rect x="9" y="3" width="6" height="4" rx="1"/>
                <line x1="9" y1="12" x2="15" y2="12"/>
                <line x1="9" y1="16" x2="13" y2="16"/>
            </svg>
        </div>
        <div>
            <h5>Add New {{ $title }}</h5>
            <p>Isi data penjualan produk di bawah ini</p>
        </div>
    </div>

    <form action="{{ route('sale.store') }}" method="POST">
    @csrf

    {{-- Invoice Info --}}
    <div class="form-section">
        <div class="section-title">Invoice Info</div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Product</label>
                <select class="form-control" name="id_produk" id="select_produk" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}"
                            data-harga="{{ $p->harga_jual }}"
                            data-stok="{{ $p->stok }}">
                            {{ $p->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Stok Tersedia</label>
                <input type="text" class="form-control readonly-field" id="info_stok" readonly value="-">
            </div>
        </div>
    </div>

    {{-- Pricing --}}
    <div class="form-section">
        <div class="section-title">Pricing & Quantity</div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label">Selling Price</label>
                <div class="input-group-custom">
                    <span class="prefix">Rp</span>
                    <input type="text" class="form-control readonly-field" id="selling_price_display" placeholder="0" readonly>
                </div>
                <input type="hidden" name="selling_price" id="selling_price" value="0">
            </div>
            <div class="col-md-6 mb-4">
                <label class="form-label">Selling Amount (Qty)</label>
                <input type="number" class="form-control" name="selling_amount" id="selling_amount" placeholder="1" min="1" value="1" required>
            </div>
        </div>

        <div class="subtotal-preview">
            <span class="label">Subtotal</span>
            <span class="value" id="subtotal_display">Rp 0</span>
        </div>
        <input type="hidden" name="subtotal" id="subtotal" value="0">
    </div>

    {{-- Total & Actions --}}
    <div class="form-section">
        <div class="total-box">
            <span class="total-label">Total Bayar</span>
            <span class="total-value" id="total_display">Rp 0</span>
        </div>
        <input type="hidden" name="total_bayar" id="total_bayar" value="0">

        <div class="action-row">
            <a href="{{ route('sale.index') }}" class="btn-cancel">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
                Cancel
            </a>
            <button type="submit" class="btn-save">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Save New Sale Data
            </button>
        </div>
    </div>

    </form>

    {{-- Sale Datas Table --}}
    <div class="sale-table-section">
        <div class="section-title">Sale Datas</div>
        @if(isset($datas) && $datas->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>No Struk</th>
                    <th>Tanggal Jual</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><span class="badge-struk">{{ $d->no_struk }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($d->tgl_jual)->format('d M Y') }}</td>
                    <td class="money">Rp {{ number_format($d->total_bayar, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">Belum ada data penjualan.</div>
        @endif
    </div>

</div>
</div>
</div>

<script>
function toInt(v){ return parseInt(('' + v).replace(/[^0-9]/g, '')) || 0; }

function formatRupiah(n){
    return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function recalc(){
    var price    = toInt(document.getElementById('selling_price').value);
    var qty      = toInt(document.getElementById('selling_amount').value);
    var subtotal = price * qty;

    document.getElementById('subtotal').value               = subtotal;
    document.getElementById('subtotal_display').textContent = formatRupiah(subtotal);
    document.getElementById('total_bayar').value            = subtotal;
    document.getElementById('total_display').textContent    = formatRupiah(subtotal);
}

document.getElementById('select_produk').addEventListener('change', function(){
    var selected = this.options[this.selectedIndex];
    var harga    = selected.getAttribute('data-harga') || 0;
    var stok     = selected.getAttribute('data-stok')  || '-';

    document.getElementById('selling_price').value         = harga;
    document.getElementById('selling_price_display').value = harga ? formatRupiah(harga) : '0';
    document.getElementById('info_stok').value             = stok;

    recalc();
});

document.getElementById('selling_amount').addEventListener('input', recalc);

recalc();
</script>

@endsection