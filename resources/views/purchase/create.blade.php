@extends('be.master')

@section('menu')
    @include('be.menu')
@endsection

@section('purchase')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

    * { font-family: 'DM Sans', sans-serif; }

    /* ── Palette variables ───────────────────────── */
    :root {
        --bg:        #F4F5F7;
        --surface:   #FFFFFF;
        --border:    #E2E5EA;
        --accent:    #3D4A5C;
        --accent-lt: #5C6E85;
        --accent-xs: #EEF0F4;
        --text-main: #1E2530;
        --text-muted:#6B7280;
        --danger:    #B0BEC5;
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
        letter-spacing: -0.2px;
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
    }
    .form-control {
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.88rem;
        color: var(--text-main);
        background: var(--surface);
        padding: 8px 12px;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(61,74,92,0.1);
        outline: none;
    }
    select.form-control { cursor: pointer; }

    /* ── Item card ───────────────────────────────── */
    .item-card {
        background: var(--accent-xs);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px 20px 14px;
        margin-bottom: 14px;
        position: relative;
        transition: box-shadow 0.2s;
    }
    .item-card:hover {
        box-shadow: 0 4px 18px rgba(0,0,0,0.08);
    }
    .item-card .item-number {
        position: absolute;
        top: -11px;
        left: 18px;
        background: var(--accent);
        color: #fff;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-family: 'DM Mono', monospace;
    }

    /* ── Readonly fields ─────────────────────────── */
    .readonly-field {
        background: #EBEEF2 !important;
        color: var(--accent) !important;
        font-weight: 600;
        border-color: var(--border) !important;
        cursor: default;
        font-family: 'DM Mono', monospace;
        font-size: 0.84rem !important;
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
    }
    .btn-add-item:hover {
        background: var(--accent-lt);
        transform: translateY(-1px);
        color: white;
    }

    .btn-remove-item {
        background: transparent;
        color: var(--danger);
        border: 1px solid var(--border);
        border-radius: 7px;
        padding: 4px 14px;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-remove-item:hover {
        background: #f5e9e9;
        color: #c0392b;
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
        letter-spacing: 0.5px;
    }

    /* ── Action buttons row ──────────────────────── */
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
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        line-height: 1;
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
        transition: background 0.2s, transform 0.1s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        line-height: 1;
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
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
            </svg>
        </div>
        <div>
            <h5>Add New Purchase</h5>
            <p>Isi data pembelian dan item produk di bawah ini</p>
        </div>
    </div>

    <form action="{{ route('purchase.store') }}" method="POST">
    @csrf

    {{-- Info Nota --}}
    <div class="form-section">
        <div class="section-title">Info Nota</div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">No Nota</label>
                <input type="text" name="no_nota" class="form-control" placeholder="Contoh: NTB-001" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Nota</label>
                <input type="date" name="tgl_nota" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Distributor</label>
                <select name="id_distributor" class="form-control" required>
                    <option value="">-- Pilih Distributor --</option>
                    @foreach($distributors as $d)
                        <option value="{{ $d->id }}">{{ $d->nama_distributor }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Purchase Items --}}
    <div class="form-section">
        <div class="section-title">Purchase Items</div>

        <div id="items-wrapper">
            <div class="item-card item-row">
                <span class="item-number">Item #1</span>
                <input type="hidden" name="id_barang[]" class="id_barang_hidden" value="">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Product</label>
                            <select class="form-control id_barang">
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
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Stock</label>
                                <input type="text" class="form-control readonly-field stok_info" readonly value="-">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Selling Price</label>
                                <input type="text" class="form-control readonly-field harga_jual_info" readonly value="Rp 0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Purchase Price</label>
                            <input type="text" class="form-control harga_beli_rp" placeholder="Rp 0">
                            <input type="hidden" name="harga_beli[]" class="harga_beli" value="0">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Selling Margin</label>
                                <input type="number" name="margin_jual[]" class="form-control margin_jual" value="0">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="jumlah_beli[]" class="form-control jumlah_beli" value="1">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Sub Total</label>
                            <input type="text" class="form-control readonly-field subtotal_rp" readonly value="Rp 0">
                            <input type="hidden" name="subtotal[]" class="subtotal" value="0">
                        </div>
                    </div>
                </div>

                <div class="text-end mt-2">
                    <button type="button" class="btn-remove-item remove-row">✕ Remove Item</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn-add-item mt-2" id="add-item">
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
                Save Purchase
            </button>
        </div>
    </div>

    </form>
</div>
</div>
</div>

<script>
const products = {!! json_encode($products->map(function($p) { return ['id' => $p->id, 'nama' => $p->nama_barang, 'harga' => $p->harga_jual, 'stok' => $p->stok]; })->values()) !!};

function toInt(v){ return parseInt(v) || 0; }

function formatRupiah(angka){
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function recalcRow(row){
    var harga    = toInt(row.querySelector('.harga_beli').value);
    var margin   = toInt(row.querySelector('.margin_jual').value);
    var qty      = toInt(row.querySelector('.jumlah_beli').value);
    var subtotal = (harga + margin) * qty;
    row.querySelector('.subtotal').value    = subtotal;
    row.querySelector('.subtotal_rp').value = formatRupiah(subtotal);
    recalcTotal();
}

function recalcTotal(){
    var total = 0;
    document.querySelectorAll('.subtotal').forEach(function(el){ total += toInt(el.value); });
    document.getElementById('total_bayar').value   = total;
    document.getElementById('total_bayar_display').textContent = formatRupiah(total);
}

function buildProductOptions(){
    var opts = '<option value="">-- Pilih Produk --</option>';
    products.forEach(function(p){
        opts += '<option value="' + p.id + '" data-harga="' + p.harga + '" data-stok="' + p.stok + '">' + p.nama + '</option>';
    });
    return opts;
}

function updateItemNumbers(){
    document.querySelectorAll('.item-card .item-number').forEach(function(el, i){
        el.textContent = 'Item #' + (i + 1);
    });
}

function buildRow(){
    var div = document.createElement('div');
    div.className = 'item-card item-row';
    div.innerHTML =
        '<span class="item-number">Item #1</span>' +
        '<input type="hidden" name="id_barang[]" class="id_barang_hidden" value="">' +
        '<div class="row">' +
            '<div class="col-md-6">' +
                '<div class="mb-3"><label class="form-label">Product</label>' +
                '<select class="form-control id_barang">' + buildProductOptions() + '</select></div>' +
                '<div class="row">' +
                    '<div class="col-6 mb-3"><label class="form-label">Stock</label>' +
                    '<input type="text" class="form-control readonly-field stok_info" readonly value="-"></div>' +
                    '<div class="col-6 mb-3"><label class="form-label">Selling Price</label>' +
                    '<input type="text" class="form-control readonly-field harga_jual_info" readonly value="Rp 0"></div>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-6">' +
                '<div class="mb-3"><label class="form-label">Purchase Price</label>' +
                '<input type="text" class="form-control harga_beli_rp" placeholder="Rp 0">' +
                '<input type="hidden" name="harga_beli[]" class="harga_beli" value="0"></div>' +
                '<div class="row">' +
                    '<div class="col-6 mb-3"><label class="form-label">Selling Margin</label>' +
                    '<input type="number" name="margin_jual[]" class="form-control margin_jual" value="0"></div>' +
                    '<div class="col-6 mb-3"><label class="form-label">Quantity</label>' +
                    '<input type="number" name="jumlah_beli[]" class="form-control jumlah_beli" value="1"></div>' +
                '</div>' +
                '<div class="mb-2"><label class="form-label">Sub Total</label>' +
                '<input type="text" class="form-control readonly-field subtotal_rp" readonly value="Rp 0">' +
                '<input type="hidden" name="subtotal[]" class="subtotal" value="0"></div>' +
            '</div>' +
        '</div>' +
        '<div class="text-end mt-2"><button type="button" class="btn-remove-item remove-row">✕ Remove Item</button></div>';
    return div;
}

document.addEventListener('change', function(e){
    if(e.target.classList.contains('id_barang')){
        var selected = e.target.options[e.target.selectedIndex];
        var harga = selected.getAttribute('data-harga') || 0;
        var stok  = selected.getAttribute('data-stok')  || '-';
        var row   = e.target.closest('.item-row');
        row.querySelector('.id_barang_hidden').value = e.target.value;
        row.querySelector('.stok_info').value        = stok;
        row.querySelector('.harga_jual_info').value  = formatRupiah(harga);
        row.querySelector('.harga_beli').value       = harga;
        row.querySelector('.harga_beli_rp').value    = formatRupiah(harga);
        recalcRow(row);
    }
});

document.addEventListener('input', function(e){
    if(e.target.classList.contains('harga_beli_rp')){
        var value = e.target.value.replace(/[^0-9]/g, '');
        var row   = e.target.closest('.item-row');
        row.querySelector('.harga_beli').value = value;
        e.target.value = formatRupiah(value);
        recalcRow(row);
    }
    if(e.target.classList.contains('margin_jual') || e.target.classList.contains('jumlah_beli')){
        recalcRow(e.target.closest('.item-row'));
    }
});

document.getElementById('add-item').addEventListener('click', function(){
    var wrapper = document.getElementById('items-wrapper');
    wrapper.appendChild(buildRow());
    updateItemNumbers();
});

document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-row')){
        var rows = document.querySelectorAll('.item-row');
        if(rows.length > 1){
            e.target.closest('.item-row').remove();
            updateItemNumbers();
        }
        recalcTotal();
    }
});

recalcTotal();
</script>

@endsection