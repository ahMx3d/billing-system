@php
    $locale =app()->getLocale();
@endphp
@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('frontend/css/pickadate/classic.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/pickadate/classic.date.css') }}" />
@if(config('app.locale') == 'ar')
    <link rel="stylesheet" href="{{ asset('frontend/css/pickadate/rtl.css') }}" />
@endif
<style>
    /* jquery Validation errors */
    form.form label.error, label.error {
        color     : red;
        font-style: italic;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin            : 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header {{ ($locale == 'ar')? 'text-right': '' }}">
                {{ __('frontend/forms/bills/create.card.head') }}
            </div>
            <div class="card-body">
                {!! Form::open([
                    'route'  => 'bills.store',
                    'method' => 'POST',
                    'class'  => 'form'
                ]) !!}
                <div class="row">
                    <div class="col-4">
                        <div class="form-group {{ ($locale !== 'ar')? '': 'text-right' }}">
                            {!! Form::label('customer_name',
                                __('frontend/forms/bills/create.customer.name')) !!}
                            {!! Form::text('customer_name', old('customer_name'), [
                                'class'       => 'form-control',
                                'placeholder' => __('frontend/forms/bills/create.customer.placeholder.name')
                            ]) !!}
                            @error('customer_name')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group {{ ($locale !== 'ar')? '': 'text-right' }}">
                            {!! Form::label('customer_email',
                                __('frontend/forms/bills/create.customer.email')) !!}
                            {!! Form::text('customer_email', old('customer_email'), [
                                'class'       => 'form-control',
                                'placeholder' => __('frontend/forms/bills/create.customer.placeholder.email')
                            ]) !!}
                            @error('customer_email')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group {{ ($locale !== 'ar')? '': 'text-right' }}">
                            {!! Form::label('customer_mobile',
                                __('frontend/forms/bills/create.customer.mobile')) !!}
                            {!! Form::tel('customer_mobile', old('customer_mobile'), [
                                'class'       => 'form-control',
                                'placeholder' => __('frontend/forms/bills/create.customer.placeholder.mobile')
                            ]) !!}
                            @error('customer_mobile')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group {{ ($locale !== 'ar')? '': 'text-right' }}">
                            {!! Form::label('company_name',
                                __('frontend/forms/bills/create.company.name')) !!}
                            {!! Form::text('company_name', old('company_name'), [
                                'class'       => 'form-control',
                                'placeholder' => __('frontend/forms/bills/create.company.placeholder.name')
                            ]) !!}
                            @error('company_name')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group {{ ($locale !== 'ar')? '': 'text-right' }}">
                            {!! Form::label('bill_number',
                                __('frontend/forms/bills/create.bill.number')) !!}
                            {!! Form::text('bill_number', old('bill_number'), [
                                'class'       => 'form-control',
                                'placeholder' => __('frontend/forms/bills/create.bill.placeholder.number')
                            ]) !!}
                            @error('bill_number')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group {{ ($locale !== 'ar')? '': 'text-right' }}">
                            {!! Form::label('bill_date', __('frontend/forms/bills/create.bill.date')) !!}
                            {!! Form::text('bill_date', old('bill_date'), [
                                'class'       => 'form-control pickdate',
                                'id'          => 'pickdate',
                                'placeholder' => __('frontend/forms/bills/create.bill.placeholder.date')
                            ]) !!}
                            @error('bill_date')
                            <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="bill-details" class="table">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{ __('frontend/forms/bills/create.product.name') }}</th>
                                <th>{{ __('frontend/forms/bills/create.product.unit.name') }}</th>
                                <th>{{ __('frontend/forms/bills/create.product.quantity.name') }}</th>
                                <th>{{ __('frontend/forms/bills/create.product.unit.price') }}</th>
                                <th>{{ __('frontend/forms/bills/create.product.subtotal.name') }}</th>
                            </tr>
                        </thead>
                        <tbody class="{{ ($locale !== 'ar')? '': 'text-right' }}">
                            <tr class="row-clone" id="0">
                                <td>#</td>
                                <td>
                                    {!! Form::text('product_name[0]', old('product_name'), [
                                        'class'       => 'product-name form-control validation-selector',
                                        'id'          => 'product-name',
                                        'placeholder' => __('frontend/forms/bills/create.product.placeholder.name')
                                    ]) !!}
                                    @error('product_name')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    {!! Form::select('unit[0]', [
                                        ''   => '---',
                                        'p'  => __('frontend/forms/bills/create.product.unit.options.piece'),
                                        'g'  => __('frontend/forms/bills/create.product.unit.options.gram'),
                                        'KG' => __('frontend/forms/bills/create.product.unit.options.kilogram')
                                    ], old('unit'),['class'=>'unit form-control validation-selector']) !!}
                                    @error('unit')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    {!! Form::number('quantity[0]', old('quantity'), [
                                        'class'       => 'calc-row-sub-total quantity form-control validation-selector',
                                        'id'          => 'quantity',
                                        'step'        => '0.01',
                                        'placeholder' => __('frontend/forms/bills/create.product.quantity.placeholder')
                                    ]) !!}
                                    @error('quantity')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    {!! Form::number('unit_price[0]', old('unit_price'), [
                                        'class'       => 'calc-row-sub-total unit-price form-control validation-selector',
                                        'id'          => 'unit-price',
                                        'step'        => '0.01',
                                        'placeholder' => __('frontend/forms/bills/create.product.unit.placeholder')
                                    ]) !!}
                                    @error('unit_price')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    {!! Form::number('row_sub_total[0]', old('row_sub_total'),[
                                        'readonly'    => 'readonly',
                                        'class'       => 'row-sub-total form-control',
                                        'id'          => 'row-sub-total',
                                        'step'        => '0.01',
                                        'placeholder' => __('frontend/forms/bills/create.product.subtotal.placeholder')
                                    ]) !!}
                                    @error('row_sub_total')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class=" {{ ($locale !== 'ar')? '': 'text-right' }}">
                                    <button class="btn-add btn btn-primary">
                                        {{ __('frontend/forms/bills/create.product.btn.add') }}
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="1">
                                    {{ __('frontend/forms/bills/create.product.subtotal.name') }}
                                </td>
                                <td colspan="2">
                                    {!! Form::number('sub_total', old('sub_total', '0.00'), [
                                        'readonly'    => 'readonly',
                                        'class'       => 'sub-total form-control',
                                        'id'          => 'sub-total',
                                        'placeholder' => __('frontend/forms/bills/create.product.subtotal.placeholder')
                                    ]) !!}
                                    @error('sub_total')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="1">
                                    {{ __('frontend/forms/bills/create.product.discount.name') }}
                                </td>
                                <td colspan="2">
                                    <div class="input-group mb-3">
                                        {!!
                                        Form::select('discount_type', [
                                            'fixed'      => __('frontend/forms/bills/create.product.discount.type.fixed'),
                                            'percentage' => __('frontend/forms/bills/create.product.discount.type.percentage')
                                        ], old('discount_type'),[
                                            'id'    => 'discount-type',
                                            'class' => 'calc-vat-total-due discount-type custom-select',
                                        ])!!}
                                        <div class="input-group-append">
                                            {!! Form::number('discount_value', old('discount_value', '0.00'), [
                                                'id'    => 'discount-value',
                                                'class' => 'calc-vat-total-due discount-value form-control',
                                                'step'  => '0.01'
                                            ]) !!}
                                        </div>
                                        {{-- @error('discount_type')
                                        <span class="help-block text-danger">{{ $message }}</span>
                                        @enderror --}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="1">{{ __('frontend/forms/bills/create.product.vat') }}</td>
                                <td colspan="2">
                                    {!! Form::number('vat_value', old('vat_value', '0.00'), [
                                        'class'    => 'vat-value form-control',
                                        'id'       => 'vat-value',
                                        'readonly' => 'readonly',
                                        'step'     => '0.01'
                                    ]) !!}
                                    {{-- @error('vat_value')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror --}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="1">{{ __('frontend/forms/bills/create.product.shipping') }}</td>
                                <td colspan="2">
                                    {!! Form::number('shipping_value', old('shipping_value', '0.00'), [
                                        'class' => 'calc-vat-total-due shipping-value form-control',
                                        'id'    => 'shipping-value',
                                        'step'  => '0.01'
                                    ]) !!}
                                    {{-- @error('shipping')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror --}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="1">{{ __('frontend/forms/bills/create.product.total-due') }}</td>
                                <td colspan="2">
                                    {!! Form::number('total_due', old('total_due', '0.00'), [
                                        'class'    => 'total-due form-control',
                                        'id'       => 'total-due',
                                        'readonly' => 'readonly',
                                        'step'     => '0.01'
                                    ]) !!}
                                    {{-- @error('total_due')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                    @enderror --}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="{{ ($locale == 'en')? 'text-right': '' }} pt-3">
                    {!! Form::button(__('frontend/forms/bills/create.form.submit'), [
                        'type'  => 'submit',
                        'name'  => 'save',
                        'class' => 'btn btn-lg btn-primary'
                    ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('frontend/js/formValidate/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/formValidate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/formValidate/additional-methods.min.js') }}"></script>
<script src="{{ asset('frontend/js/pickadate/picker.js') }}"></script>
<script src="{{ asset('frontend/js/pickadate/picker.date.js') }}"></script>
@if(config('app.locale') == 'ar')
    <script src="{{ asset('frontend/js/formValidate/messages_ar.js') }}"></script>
    <script src="{{ asset('frontend/js/pickadate/ar.js') }}"></script>
@endif

<script>
    $(() => {

        $(document).on('click', '.delegated-btn', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();

            $('#sub-total').val(totalSum('.row-sub-total'));
            $('#vat-value').val(vatCalculate());
            $('#total-due').val(totalDueSum());
        });

        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();
            const trCount = $('#bill-details').find('tr.row-clone:last').length,
                  incrNum = trCount > 0 ? +($('#bill-details').find('tr.row-clone:last').attr('id')) + 1 : 0;

            $('#bill-details').find('tbody').append($(`
                <tr class="row-clone" id="${incrNum}">
                    <td>
                        <button type="button" class="btn btn-danger btn-sm delegated-btn">
                            <i class="fa fa-minus"></i>
                        </button>
                    </td>
                    <td>
                        <input
                            type="text"
                            placeholder=@json(__('frontend/forms/bills/create.product.placeholder.name'))
                            name="product_name[${incrNum}]"
                            class="product-name form-control validation-selector" />
                    </td>
                    <td>
                        <select name="unit[${incrNum}]" class="unit form-control validation-selector">
                            <option value=""> --- </option>
                            <option value="p">
                                ${@json(__('frontend/forms/bills/create.product.unit.options.piece'))}
                            </option>
                            <option value="g">
                                ${@json(__('frontend/forms/bills/create.product.unit.options.gram'))}
                            </option>
                            <option value="kg">
                                ${@json(__('frontend/forms/bills/create.product.unit.options.kilogram'))}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input
                            type="number"
                            placeholder=@json(__('frontend/forms/bills/create.product.quantity.placeholder'))
                            name="quantity[${incrNum}]"
                            step="0.01"
                            class="calc-row-sub-total quantity form-control validation-selector" />
                    </td>
                    <td>
                        <input
                            type="number"
                            placeholder=@json(__('frontend/forms/bills/create.product.unit.placeholder'))
                            name="unit_price[${incrNum}]"
                            step="0.01"
                            class="calc-row-sub-total unit-price form-control validation-selector" />
                    </td>
                    <td>
                        <input
                            type="number"
                            placeholder=@json(__('frontend/forms/bills/create.product.subtotal.placeholder'))
                            name="row_sub_total[${incrNum}]"
                            step="0.01"
                            class="row-sub-total form-control"
                            readonly="readonly" />
                    </td>
                </tr>
            `));
        });

        const valuesCalculate = () => {
            const subTotalVal  = $('.sub-total').val() || 0,
                  discountType = $('.discount-type').val();

            const discountVal      = parseFloat($('.discount-value').val()) || 0,
                  totalDiscountVal = discountVal? (
                      discountType === 'percentage' ? subTotalVal * (discountVal / 100) : discountVal
                  ) : 0;

            return [subTotalVal, totalDiscountVal];
        }

        const totalDueSum = () => {
            let sum = 0;
            const [
                subTotalVal,
                discountVal
            ]           = valuesCalculate(),
            vatVal      = parseFloat($('.vat-value').val()) || 0,
            shippingVal = parseFloat($('.shipping-value').val()) || 0;

            sum += subTotalVal;
            sum -= discountVal;
            sum += vatVal;
            sum += shippingVal;

            return sum.toFixed(2);
        }

        const vatCalculate = () => {
            const [
                subTotalVal,
                discountVal
            ] = valuesCalculate(),
            vatVal = (subTotalVal - discountVal) * 0.05;

            return vatVal.toFixed(2);
        }

        const totalSum = (selector) => {
            let sum = 0;
            $(selector).each(function () {
                const val  = $(this).val() ||0;
                      sum += parseFloat(val);
            });
            return sum.toFixed(2);
        }

        $('#bill-details').on('keyup blur click', '.calc-vat-total-due', function () {
            $('#vat-value').val(vatCalculate());
            $('#total-due').val(totalDueSum());
        });

        $('#bill-details').on('keyup blur', '.calc-row-sub-total', function () {
            const row       = $(this).closest('tr'),
                  quantity  = row.find('.quantity').val() || 0,
                  unitPrice = row.find('.unit-price').val() || 0;

            row.find('.row-sub-total').val((quantity * unitPrice).toFixed(2));

            $('#sub-total').val(totalSum('.row-sub-total'));
            $('#vat-value').val(vatCalculate());
            $('#total-due').val(totalDueSum());
        });

        $('.pickdate').pickadate({
            format       : 'yyyy-mm-dd',
            selectMonth  : true,
            selectYear   : true,
            clear        : 'Clear',
            close        : 'Ok',
            closeOnSelect: true,
            onSet: function(context) {
                $("#pickdate-error").remove();
            }
        });

        $('form').on('submit', function (e) {
            $('.validation-selector').each(function () { $(this).rules("add", { required: true }); });
            e.preventDefault();
        });

        $('form').validate({
            rules: {
                'customer_name'  : { required: true },
                'customer_email' : { required: true, email:true },
                'customer_mobile': { required: true, digits: true, minlength: 10, maxlength: 14 },
                'company_name'   : { required: true },
                'bill_number'    : { required: true, digits: true },
                'bill_date'      : { required: true },
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

    });
</script>
@endsection
