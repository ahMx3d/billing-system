<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Bill;
use App\Mail\SendBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $len = config('constants.paginationCount');
        $bills = Bill::latest('id')->paginate($len);

        return view('frontend.index', \compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data['customer_name']   = $request->customer_name;
        $data['customer_email']  = $request->customer_email;
        $data['customer_mobile'] = $request->customer_mobile;
        $data['company_name']    = $request->company_name;
        $data['bill_number']     = $request->bill_number;
        $data['bill_date']       = $request->bill_date;
        $data['sub_total']       = $request->sub_total;
        $data['discount_type']   = $request->discount_type;
        $data['discount_value']  = $request->discount_value;
        $data['vat_value']       = $request->vat_value;
        $data['shipping_value']  = $request->shipping_value;
        $data['total_due']       = $request->total_due;

        $bill = Bill::create($data);

        $billDetails = [];
        for ($i = 0; $i < count($request->product_name); $i++) {
            $billDetails[$i]['product_name']  = $request->product_name[$i];
            $billDetails[$i]['unit']          = $request->unit[$i];
            $billDetails[$i]['quantity']      = $request->quantity[$i];
            $billDetails[$i]['unit_price']    = $request->unit_price[$i];
            $billDetails[$i]['row_sub_total'] = $request->row_sub_total[$i];
        }

        $details = $bill->details()->createMany($billDetails);

        if ($details) {
            return redirect()->back()->with([
                'message' => __('frontend/session/messages.success.created'),
                'type'    => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('frontend/session/messages.danger.created'),
                'type'    => 'danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  object  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        return view('frontend.show', \compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        $bill = $bill->load('details');
        return view('frontend.edit', \compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $data['customer_name']   = $request->customer_name;
        $data['customer_email']  = $request->customer_email;
        $data['customer_mobile'] = $request->customer_mobile;
        $data['company_name']    = $request->company_name;
        $data['bill_number']     = $request->bill_number;
        $data['bill_date']       = $request->bill_date;
        $data['sub_total']       = $request->sub_total;
        $data['discount_type']   = $request->discount_type;
        $data['discount_value']  = $request->discount_value;
        $data['vat_value']       = $request->vat_value;
        $data['shipping_value']  = $request->shipping_value;
        $data['total_due']       = $request->total_due;

        $bill->update($data);
        $bill->details()->delete();

        $billDetails = [];
        for ($i = 0; $i < count($request->product_name); $i++) {
            $billDetails[$i]['product_name']  = $request->product_name[$i];
            $billDetails[$i]['unit']          = $request->unit[$i];
            $billDetails[$i]['quantity']      = $request->quantity[$i];
            $billDetails[$i]['unit_price']    = $request->unit_price[$i];
            $billDetails[$i]['row_sub_total'] = $request->row_sub_total[$i];
        }

        $details = $bill->details()->createMany($billDetails);

        if ($details) {
            return redirect()->back()->with([
                'message' => __('frontend/session/messages.success.updated'),
                'type'    => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('frontend/session/messages.danger.updated'),
                'type'    => 'danger'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect(route('bills.index'))->with([
            'message' => __('frontend/session/messages.success.deleted'),
            'type'    => 'success'
        ]);
    }

    /**
     * Print the incoming bill view.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function print(Bill $bill)
    {
        return view('frontend.print', \compact('bill'));
    }

    /**
     * Export the incoming bill to pdf.
     *
     * @param  \App\Models\Bill  $bill
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function export(Bill $bill, string $type = 'pdf')
    {
        if ($type == 'pdf') {
            return $this->pdf($bill)->stream("{$bill->bill_number}.pdf");
        } else {
            return redirect()->route('bills.show', $bill);
        }
    }

    /**
     * Send the Bill pdf file to email.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function send(Bill $bill)
    {
        $this->pdf($bill)->save(public_path("assets\\bills\\{$bill->bill_number}.pdf"));

        Mail::to($bill->customer_email)
            ->locale(config('app.locale'))
            ->send(new SendBill($bill));

        return redirect(route('bills.index'))->with([
            'message' => __('frontend/session/messages.success.sent'),
            'type'    => 'success'
        ]);
    }

    /**
     * Prepare PDF File.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    private function pdf(Bill $bill)
    {
        $data['bill_id']   = $bill->id;
        $data['bill_date'] = $bill->bill_date;
        $data['customer']  = [
            __('frontend/bills/pdf.customer_name')   => $bill->customer_name,
            __('frontend/bills/pdf.customer_mobile') => $bill->customer_mobile,
            __('frontend/bills/pdf.customer_email')  => $bill->customer_email
        ];
        $items = [];
        foreach ($bill->details as $item) {
            $items[] = [
                'product_name'  => $item->product_name,
                'unit'          => $item->translated_unit,
                'quantity'      => $item->quantity,
                'unit_price'    => $item->unit_price,
                'row_sub_total' => $item->row_sub_total,
            ];
        }
        $data['items'] = $items;

        $data['bill_number']    = $bill->bill_number;
        $data['created_at']     = $bill->created_at->format('Y-m-d');
        $data['sub_total']      = $bill->sub_total;
        $data['discount_value'] = $bill->discount_text;
        $data['vat_value']      = $bill->vat_value;
        $data['shipping_value'] = $bill->shipping_value;
        $data['total_due']      = $bill->total_due;

        return PDF::loadView('frontend.export.pdf', $data);
    }
}
