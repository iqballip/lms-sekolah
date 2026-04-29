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

    /* ── Header ──────────────────────────────────── */
    .purchase-header {
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
    .purchase-header .icon-wrap {
        width: 44px; height: 44px;
        background: var(--accent-xs);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .purchase-header .icon-wrap svg { color: var(--accent); }
    .purchase-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-main);
    }
    .purchase-header p {
        margin: 2px 0 0;
        color: var(--text-muted);
        font-size: 0.82rem;
    }

    /* ── Card sections ───────────────────────────── */
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
        margin-bottom: 18px;
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

    /* ── Form controls ───────────────────────────── */
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
        padding: 8px 12px;
        transition: border-color 0.15s, box-shadow 0.15s;
        width: 100%;
    }
    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(61,74,92,0.1);
        outline: none;
    }
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

    /* ── Items table ─────────────────────────────── */
    .items-table-wrap {
        overflow-x: auto;
        border-radius: 10px;
        border: 1px solid var(--border);
    }
    table.items-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.83rem;
    }
    table.items-table thead tr {
        background: var(--accent-xs);
    }
    table.items-table thead th {
        padding: 10px 12px;
        font-size: 0.67rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.9px;
        color: var(--accent);
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
        text-align: center;
    }
    table.items-table thead th:first-child { text-align: left; }
    table.items-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.12s;
    }
    table.items-table tbody tr:last-child { border-bottom: none; }
    table.items-table tbody tr:hover { background: #fafbfc; }
    table.items-table td {
        padding: 10px 10px;
        vertical-align: middle;
    }
    table.items-table td .form-control {
        min-width: unset;
        font-size: 0.83rem;
        padding: 6px 10px;
    }

    /* ── Buttons ─────────────────────────────────── */
    .btn-add-item {
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 0.83rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 14px;
    }
    .btn-add-item:hover {
        background: var(--accent-lt);
        transform: translateY(-1px);
        color: white;
    }

    .btn-remove-row {
        width: 28px; height: 28px;
        border-radius: 7px;
        border: 1px solid var(--border);
        background: var(--surface);
        color: #c0392b;
        display: inline-flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: all 0.15s;
        padding: 0;
    }
    .btn-remove-row:hover {
        background: #fdf2f2;
        border-color: #f0c4c4;
    }

    /* ── Total box ───────────────────────────────── */
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
    .total-box label {
        font-size: 0.82rem;
        font-weight: 600;
        opacity: 0.8;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .total-box .total-value {
        font-size: 1.35rem;
        font-weight: 800;
        font-family: 'DM Mono', monospace;
    }

    /* ── Action buttons ──────────────────────────── */
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
</style>

<div class="container-fluid py-4">
<div class="row justify-content-center">
<div class="col-12">

    {{-- Header --}}
    <div class="purchase-header">
        <div class="icon-wrap">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
        </div>
        <div>
            <h5>Edit {{ $title }}</h5>
            <p>Perbarui data pembelian dan item produk di bawah ini</p>
        </div>
    </div>

    <form action="{{ route('purchase.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Info Nota --}}
    <div class="form-section">
        <div class="section-title">Info Nota</div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">No Nota</label>
                <input type="text" name="no_nota" class="form-control" value="{{ $data->no_nota }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Nota</label>
                <input type="date" name="tgl_nota" class="form-control" value="{{ $data->tgl_nota }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Distributor</label>
                <select name="id_distributor" class="form-control" required>
                    <option value="">-- Pilih Distributor --</option>
                    @foreach($distributors as $d)
                        <option value="{{ $d->id }}" @if($data->id_distributor == $d->id) selected @endif>
                            {{ $d->nama_distributor }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Purchase Items --}}
    <div class="form-section">
        <div class="section-title">Purchase Items</div>

        <div class="items-table-wrap">
            <table class="items-table" id="purchase-items-table">
                <thead>
                    <tr>
                        <th style="text-align:left;">Product</th>
                        <th>Stock</th>
                        <th>Selling Price</th>
                        <th>Purchase Price</th>
                        <th>Selling Margin</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($data->details as $detail)
                <tr>
                    <td style="min-width:180px;">
                        <select name="id_barang[]" class="form-control id_barang">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}"
                                    data-harga="{{ $p->harga_jual }}"
                                    data-stok="{{ $p->stok }}"
                                    @if($detail->id_barang == $p->id) selected @endif>
                                    {{ $p->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td style="min-width:80px;">
                        <input type="text" class="form-control readonly-field stok_info text-center" readonly
                            value="{{ $detail->product->stok ?? '-' }}">
                    </td>
                    <td style="min-width:130px;">
                        <input type="text" class="form-control readonly-field harga_jual_info" readonly
                            value="Rp {{ number_format($detail->product->harga_jual ?? 0, 0, ',', '.') }}">
                    </td>
                    <td style="min-width:130px;">
                        <input type="text" class="form-control harga_beli_rp"
                            value="Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}">
                        <input type="hidden" name="harga_beli[]" class="harga_beli" value="{{ $detail->harga_beli }}">
                    </td>
                    <td style="min-width:110px;">
                        <input type="number" name="margin_jual[]" class="form-control margin_jual"
                            value="{{ $detail->margin_jual }}">
                    </td>
                    <td style="min-width:90px;">
                        <input type="number" name="jumlah_beli[]" class="form-control jumlah_beli"
                            value="{{ $detail->jumlah_beli }}">
                    </td>
                    <td style="min-width:130px;">
                        <input type="text" class="form-control readonly-field subtotal_rp" readonly
                            value="Rp {{ number_format($detail->subtotal, 0, ',', '.') }}">
                        <input type="hidden" name="subtotal[]" class="subtotal" value="{{ $detail->subtotal }}">
                    </td>
                    <td class="text-center" style="width:44px;">
                        <button type="button" class="btn-remove-row remove-row" title="Remove">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td style="min-width:180px;">
                        <select name="id_barang[]" class="form-control id_barang">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}"
                                    data-harga="{{ $p->harga_jual }}"
                                    data-stok="{{ $p->stok }}">
                                    {{ $p->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" class="form-control readonly-field stok_info text-center" readonly value="-"></td>
                    <td><input type="text" class="form-control readonly-field harga_jual_info" readonly value="Rp 0"></td>
                    <td>
                        <input type="text" class="form-control harga_beli_rp" placeholder="Rp 0">
                        <input type="hidden" name="harga_beli[]" class="harga_beli" value="0">
                    </td>
                    <td><input type="number" name="margin_jual[]" class="form-control margin_jual" value="0"></td>
                    <td><input type="number" name="jumlah_beli[]" class="form-control jumlah_beli" value="1"></td>
                    <td>
                        <input type="text" class="form-control readonly-field subtotal_rp" readonly value="Rp 0">
                        <input type="hidden" name="subtotal[]" class="subtotal" value="0">
                    </td>
                    <td class="text-center" style="width:44px;">
                        <button type="button" class="btn-remove-row remove-row" title="Remove">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <button type="button" class="btn-add-item" id="add-item">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Item
        </button>
    </div>

    {{-- Total & Actions --}}
    <div class="form-section">
        <div class="total-box">
            <label>Total Bayar</label>
            <span class="total-value" id="total_bayar_display">Rp 0</span>
        </div>
        <input type="hidden" name="total_bayar" id="total_bayar" value="0">

        <div class="action-row">
            <a href="{{ route('purchase.index') }}" class="btn-cancel">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Cancel
            </a>
            <button type="submit" class="btn-save">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                Update Purchase
            </button>
        </div>
    </div>

    </form>

</div>
</div>
</div>

<script>
const productsData = {!! json_encode($products->map(function($p) {
    return ['id' => $p->id, 'nama' => $p->nama_barang, 'harga' => $p->harga_jual, 'stok' => $p->stok];
})->values()) !!};

function toInt(v){ return parseInt(v) || 0; }

function formatRupiah(angka){
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function recalcRow(tr){
    let harga    = toInt(tr.querySelector('.harga_beli').value);
    let margin   = toInt(tr.querySelector('.margin_jual').value);
    let qty      = toInt(tr.querySelector('.jumlah_beli').value);
    let subtotal = (harga + margin) * qty;
    tr.querySelector('.subtotal').value    = subtotal;
    tr.querySelector('.subtotal_rp').value = formatRupiah(subtotal);
    recalcTotal();
}

function recalcTotal(){
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(el => { total += toInt(el.value); });
    document.getElementById('total_bayar').value        = total;
    document.getElementById('total_bayar_display').textContent = formatRupiah(total);
}

function buildProductOptions(selectedId = ''){
    let opts = '<option value="">-- Pilih Produk --</option>';
    productsData.forEach(p => {
        let sel = p.id == selectedId ? 'selected' : '';
        opts += `<option value="${p.id}" data-harga="${p.harga}" data-stok="${p.stok}" ${sel}>${p.nama}</option>`;
    });
    return opts;
}

function buildNewRow(){
    let tr = document.createElement('tr');
    tr.innerHTML = `
        <td style="min-width:180px;"><select name="id_barang[]" class="form-control id_barang">${buildProductOptions()}</select></td>
        <td><input type="text" class="form-control readonly-field stok_info text-center" readonly value="-"></td>
        <td><input type="text" class="form-control readonly-field harga_jual_info" readonly value="Rp 0"></td>
        <td>
            <input type="text" class="form-control harga_beli_rp" placeholder="Rp 0">
            <input type="hidden" name="harga_beli[]" class="harga_beli" value="0">
        </td>
        <td><input type="number" name="margin_jual[]" class="form-control margin_jual" value="0"></td>
        <td><input type="number" name="jumlah_beli[]" class="form-control jumlah_beli" value="1"></td>
        <td>
            <input type="text" class="form-control readonly-field subtotal_rp" readonly value="Rp 0">
            <input type="hidden" name="subtotal[]" class="subtotal" value="0">
        </td>
        <td class="text-center" style="width:44px;">
            <button type="button" class="btn-remove-row remove-row" title="Remove">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </td>`;
    return tr;
}

document.addEventListener('change', function(e){
    if(e.target.classList.contains('id_barang')){
        let selected = e.target.options[e.target.selectedIndex];
        let harga    = selected.getAttribute('data-harga') || 0;
        let stok     = selected.getAttribute('data-stok')  || '-';
        let tr       = e.target.closest('tr');
        tr.querySelector('.stok_info').value       = stok;
        tr.querySelector('.harga_jual_info').value = formatRupiah(harga);
        tr.querySelector('.harga_beli').value      = harga;
        tr.querySelector('.harga_beli_rp').value   = formatRupiah(harga);
        recalcRow(tr);
    }
});

document.addEventListener('input', function(e){
    if(e.target.classList.contains('harga_beli_rp')){
        let value = e.target.value.replace(/[^0-9]/g, '');
        let tr    = e.target.closest('tr');
        tr.querySelector('.harga_beli').value = value;
        e.target.value = formatRupiah(value);
        recalcRow(tr);
    }
    if(e.target.classList.contains('margin_jual') || e.target.classList.contains('jumlah_beli')){
        recalcRow(e.target.closest('tr'));
    }
});

document.getElementById('add-item').addEventListener('click', function(){
    document.querySelector('#purchase-items-table tbody').appendChild(buildNewRow());
});

document.addEventListener('click', function(e){
    if(e.target.closest('.remove-row')){
        let rows = document.querySelectorAll('#purchase-items-table tbody tr');
        if(rows.length > 1){ e.target.closest('tr').remove(); }
        recalcTotal();
    }
});

recalcTotal();
</script>

@endsection