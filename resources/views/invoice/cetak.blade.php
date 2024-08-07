<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Cetak Invoice</h3>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Nama Lengkap</th>
                                <th>No Telp</th>
                                <th>Total Item</th>
                                <th>Subtotal</th>
                                <th>Pajak</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $invoice->customer->name }}</td>
                                <td>{{ $invoice->customer->phone }}</td>
                                <td><span class="badge badge-success">{{ $invoice->detail->first()->qty }}
                                        Item</span>
                                </td>
                                <td>Rp {{ number_format($invoice->total) }}</td>
                                <td>Rp {{ number_format($invoice->tax) }}</td>
                                <td>Rp {{ number_format($invoice->total_price) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="float-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
