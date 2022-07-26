<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::query()
            ->when(request()->q,function ($customers){
                $customers = $customers->where('name','like','%'.request()->q.'%');
            })->latest()->paginate(5);

        return Inertia::render('Apps/Customers/Index',[
            'customers' => $customers,
        ]);
    }

    public function create()
    {
        return Inertia::render('Apps/Customers/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'no_telp' => 'required|unique:customers',
            'address' => 'required',
        ]);

        Customer::create([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'address' => $request->address,
        ]);

        return redirect()->route('apps.customers.index');
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Apps/Customers/Edit',[
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $this->validate([
            'name' => 'required',
            'no_telp' => 'required|unique:customers,no_telp,'.$customer->id,
            'address' => 'required',
        ]);

        $customer->update([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'address' => $request->address,
        ]);

        return redirect()->route('apps.cistomers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrfail($id);
        $customer->delete();
        return redirect()->route('apps.customers.index');
    }
}
