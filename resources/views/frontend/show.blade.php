@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>{{ __('frontend/bills/show.card.header.title', ['bill_number' => $bill->bill_number]) }}</h2>
                    <a href="{{ route('bills.index') }}"
                        class="btn btn-primary">
                        <i class="fa fa-home"></i>
                        {{ __('frontend/bills/show.card.header.link') }}
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table card-table m-0">
                        <tr>
                            <th>{{ __('frontend/bills/show.table.header.customer_name') }}</th>
                            <td>{{ $bill->customer_name }}</td>
                            <th>{{ __('frontend/bills/show.table.header.customer_email') }}</th>
                            <td>{{ $bill->customer_email }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('frontend/bills/show.table.header.customer_mobile') }}</th>
                            <td>{{ $bill->customer_mobile }}</td>
                            <th>{{ __('frontend/bills/show.table.header.company_name') }}</th>
                            <td>{{ $bill->company_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('frontend/bills/show.table.header.bill_number') }}</th>
                            <td>{{ $bill->bill_number }}</td>
                            <th>{{ __('frontend/bills/show.table.header.bill_date') }}</th>
                            <td>{{ $bill->bill_date }}</td>
                        </tr>
                    </table>

                    {{-- <h3 class="text-center">{{ __('frontend/bills/show.card.body.title') }}</h3> --}}

                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('frontend/bills/show.table.header.product_name') }}</th>
                                <th>{{ __('frontend/bills/show.table.header.unit') }}</th>
                                <th>{{ __('frontend/bills/show.table.header.quantity') }}</th>
                                <th>{{ __('frontend/bills/show.table.header.unit_price') }}</th>
                                <th>{{ __('frontend/bills/show.table.header.product_subtotal') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bill->details as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->translated_unit }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->row_sub_total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center font-weight-bolder">
                                        <span class="text-muted">
                                            {{ __('frontend/bills/show.table.header.empty') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <th>{{ __('frontend/bills/show.table.header.sub_total') }}</th>
                                <td>{{ $bill->sub_total }}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <th>{{ __('frontend/bills/show.table.header.discount_value') }}</th>
                                <td>{{ $bill->discount_text }}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <th>{{ __('frontend/bills/show.table.header.vat_value') }}</th>
                                <td>{{ $bill->vat_value }}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <th>{{ __('frontend/bills/show.table.header.shipping_value') }}</th>
                                <td>{{ $bill->shipping_value }}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <th>{{ __('frontend/bills/show.table.header.total_due') }}</th>
                                <td>{{ $bill->total_due }}</td>
                            </tr>

                        </tfoot>
                    </table>
                </div>

                <div class="row my-3 mx-0 {{ config('app.locale') === 'ar' ? 'text-right' : '' }}">
                    <div class="col-9">
                        <a href="{{ route('bills.print', $bill) }}"
                            class="btn btn-primary btn-lg">
                            <i class="fa fa-print"></i>
                            {{ __('frontend/bills/show.card.body.print') }}
                        </a>
                        <a href="{{ route('bills.export', ['bill'=>$bill, 'type'=>'pdf']) }}"
                            class="btn btn-secondary btn-lg">
                            <i class="fa fa-file-pdf"></i>
                            {{ __('frontend/bills/show.card.body.export') }}
                        </a>
                        <a href="{{ route('bills.send', $bill) }}"
                            class="btn btn-success btn-lg">
                            <i class="fa fa-envelope"></i>
                            {{ __('frontend/bills/show.card.body.send') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
