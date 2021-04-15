@extends('layouts.app')

@section('style')
    <style>
        .pagination {
            margin: 0;
        }

    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>{{ __('frontend/bills/index.card.header.title') }}</h2>
                    <a href="{{ route('bills.create') }}"
                        class="btn btn-primary my-auto">
                        <i class="fa fa-plus"></i>
                        {{ __('frontend/bills/index.card.header.link') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table card-table my-0">
                        <thead>
                            <tr>
                                <th>{{ __('frontend/bills/index.table.header.name') }}
                                </th>
                                <th>{{ __('frontend/bills/index.table.header.date') }}
                                </th>
                                <th>{{ __('frontend/bills/index.table.header.total') }}
                                </th>
                                <th>{{ __('frontend/bills/index.table.header.actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bills as $bill)
                                <tr>
                                    <td>
                                        <a href="{{ route('bills.show', $bill) }}">
                                            {{ $bill->customer_name }}
                                        </a>
                                    </td>
                                    <td>{{ $bill->bill_date }}</td>
                                    <td>{{ $bill->total_due }}</td>
                                    <td>
                                        <a href="{{ route('bills.edit', $bill) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a onclick="
                                                                        event.preventDefault();
                                                                        if(confirm('{{ __('frontend/bills/index.table.confirm') }}')){
                                                                            document.getElementById('delete-{{ $bill->id }}').submit();
                                                                        }else{
                                                                            return false;
                                                                        }"
                                            href="{{ route('bills.destroy', $bill) }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('bills.destroy', $bill) }}"
                                            method="post"
                                            id="delete-{{ $bill->id }}"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="text-center font-weight-bolder">
                                        <span class="text-muted">
                                            {{ __('frontend/bills/index.table.header.empty') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <div class="float-right">
                                        {!! $bills->appends(request()->input())->links() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
