<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('asset') }}/invoice/style.css" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset('asset') }}/invoice/logo.png">
        </div>
        <h1>INVOICE - {{ $data->kode_transaksi }}</h1>
        <div id="company" class="clearfix">
            <div>Company Name</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div>
        @php
            $tgl1 = $data->tgl_transaksi;
            $date1 = Carbon\Carbon::parse($tgl1);
            $formattedDate1 = $date1->locale('id')->translatedFormat('l, j F Y');
            $tigaHariSetelahIni = Carbon\Carbon::now()
                ->addDays(2)
                ->locale('id') // set locale ke Indonesia
                ->translatedFormat('l, j F Y'); // format tanggal
        @endphp
        <div id="project">
            <div><span>CLIENT NAME</span> {{ $custom->nama }}</div>
            <div><span>CLIENT ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
            <div><span>CLIENT EMAIL</span> <a href="mailto:john@example.com">{{ $user->email }}</a></div>
            <div><span>TRANSACTION DATE </span> {{ $formattedDate1 }}</div>
            <div><span>TRANSACTION DUE DATE</span> {{ $tigaHariSetelahIni }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">PRODUCT CODE</th>
                    <th class="desc">PRODUCT NAME</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    @php
                        $product = App\Models\Produk::where('id', $item->produk_id)->first();
                    @endphp
                    <tr>
                        <td class="service">{{ $product->kode_produk }}</td>
                        <td class="desc">{{ $product->title }}</td>
                        <td class="unit">Rp {{ number_format($product->harga) }}</td>
                        <td class="qty">{{ $item->qty }}</td>
                        <td class="total">Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="total">Rp {{ number_format($subTotal) }}</td>
                </tr>
                <tr>
                    <td colspan="4">TAX 12%</td>
                    <td class="total">Rp {{ number_format($tax) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">Rp {{ number_format($totalfix) }}</td>
                </tr>
            </tbody>
        </table>
        {{-- <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div> --}}
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
<script>
    setTimeout(function() {
        // Menggunakan AJAX request untuk menghapus cookie di sisi server
        fetch('{{ route('deletePaymentCookie') }}', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(function(response) {
            // Redirect ke halaman History Transaksi setelah cookie dihapus
            window.location.href = '{{ route('history') }}';
        });
    }, 10000); // Waktu dalam milidetik (10 detik)
</script>

</html>
