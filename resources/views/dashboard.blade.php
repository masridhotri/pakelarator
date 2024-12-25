@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <div class="row gap-5" style="margin-left:7rem;">

        <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
            <div class="card-header">user</div>
            <div class="card-body">
                <h5 class="card-title">jumlah user</h5>
                <h1>5000 </h1>
                <p>100%</p>
            </div>
        </div>

        <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
            <div class="card-header">jumlah peminjam </div>
            <div class="card-body">
                <h5 class="card-title">jumlah user yang meminjam</h5>
                <h1>1</h1>
                <p>99%</p>
            </div>
        </div>

        <div class="card border-dark mb-3" style="max-width: 18rem;">
            <div class="card-header">buku </div>
            <div class="card-body">
                <h5 class="card-title">jumlah buku yang tersedia</h5>
                <h1>400000</h1>
                <p>60%</p>
            </div>
        </div>
    </div>

    <div class="row mt-5 ">
        <div class="col-8">
            <canvas class="my-4 w-100" id="myChart" width="90" height="38"></canvas>
        </div>
        <div class="col-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nama user</th>
                        <th scope="col">judul buku</th>
                        <th scope="col">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="item in cart" :key="item.id">
                        <tr>
                            <td x-text="item.name"></td>
                            <td x-text="formatPrice(item.price)"></td>
                            <td>
                                <input type="number" min="1" x-model.number="item.quantity"
                                    @change="updateCart(item.id, item.quantity)" class="form-control" style="width: 80px;">
                            </td>
                            <td x-text="formatPrice(item.price * item.quantity)"></td>
                            <td>
                                <button @click="removeFromCart(item.id)" class="btn btn-sm btn-danger">Hapus</button>
                                <button type="button" class="btn btn-success">accept all</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

        </div>
    </div>

    {{-- for user public --}}



    @foreach ($data as $kate)
        <button class="btn btn-light" id="kategor">
            <h1> {{ $kate->nama }} <i class="bi bi-arrow-right"></i></h1>
        </button>
        <div class="row gap-3 d-flex justify-content-center">
            @foreach ($kate->bukus as $buku)
                <div class="card" style="width: 20rem;">
                    <img src="{{ asset('file/' . $buku->foto) }}" class="card-img-top" alt="..."
                        style="height: 20rem;">
                    <div class="card-body">
                        <form action="" method="post">
                            <h5 class="card-title"> {{ $buku->judul }} </h5>
                            <p class="card-text"> {{ $buku->deskripsi }} </p>

                            <button class="btn-primary">go</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    <script src="/js/dashboard.js"></script>
    {{-- <script>
        const loggedInUser = "{{ Auth::user()->name }}";

        function cartData() {
            return {
                cart: [],

                // Ambil cart dari server
                fetchCart() {
                    fetch("{{ route('showbuku') }}")
                        .then(response => response.json())
                        .then(data => {
                            this.cart = data;
                        });
                },

                // Tambah item ke cart
                addToCart(id, judul) {
                    fetch("{{ route('cart.add') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            judul,
                            userName: loggedInUser // Kirim nama pengguna yang sedang login
                        })
                    }).then(() => this.fetchCart());
                }

                // Update quantity
                updateCart(id, quantity) {
                    fetch("{{ route('cart.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            quantity
                        })
                    }).then(() => this.fetchCart());
                },

                // Hapus item dari cart
                removeFromCart(id) {
                    fetch("{{ route('cart.remove') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id
                        })
                    }).then(() => this.fetchCart());
                },

                // Hitung total cart
                totalCart() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                // Format harga
                formatPrice(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(value);
                }
            }
        }
    </script> --}}
@endsection
