<template>
    <Head>
        <title>Transactions - Aplikasi Kasir</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 rounded-3 shadow">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                                    <input type="text" class="form-control" placeholder="Scan or Input Barcode">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Qty</label>
                                    <input type="number" class="form-control text-center" placeholder="Qty" min="1">
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-warning btn-md border-0 shadow text-uppercase mt-3 me-2">CLEAR</button>
                                    <button class="btn btn-success btn-md border-0 shadow text-uppercase mt-3">ADD ITEM</button>
                                </div>
                            </div>
                            <!-- card-body -->
                        </div>
                        <!-- card border-0 rounded-3 shadow -->
                    </div>
                    <!-- col-md-4 -->
                    <div class="col-md-8">
                        <div class="card border-0 rounded-3 shadow border-top-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        <h4 class="fw-bold">GRAND TOTAL</h4>
                                    </div>
                                    <div class="col-md-8 col-8 text-end">
                                        <h4 class="fw-bold">Rp. 0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card border-0 rounded-3 shadow border-top-success -->
                    </div>
                    <!-- col-md-8 -->
                    <div class="card border-0 rounded-3 shadow">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fw-bold">Cashier</label>
                                </div>
                                <div class="col-md-6 float-end">
                                    <label class="fw-bold">Customer</label>
                                </div>
                            </div>
                            <!-- row mb-3 -->
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr style="background-color: #e6e6e7;">
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <hr>
                            <div class="d-flex align-items-end flex-column bd-highlight mb-3">
                                <div class="mt-auto bd-highlight">
                                    <label>Discount (Rp.)</label>
                                    <input type="number" class="form-control" placeholder="Discount (Rp.)">
                                </div>
                                <div class="bd-highlight mt-4">
                                    <label>Pay (Rp.)</label>
                                    <input type="number" class="form-control" placeholder="Pay (Rp.)">
                                </div>
                                <div class="text-end mt-4">
                                    <button class="btn btn-warning btn-md border-0 shadow text-uppercase me-2">Cancel</button>
                                    <button class="btn btn-purple btn-md border-0 shadow text-uppercase">Pay Order & Print</button>
                                </div>
                            </div>
                            <!-- d-flex align-items-end flex-column bd-highlight mb-3 -->
                        </div>
                        <!-- card body -->
                    </div>
                    <!-- card border-0 rounded-3 shadow -->
                </div>
                <!-- row -->
            </div>
            <!-- fade in -->
        </div>
        <!-- Contianer fluid -->
    </main>
</template>

<script>
import LayoutApp from '../../../Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: LayoutApp,
    components: {
        Head,
    },
    setup() {

    },
}
</script>
