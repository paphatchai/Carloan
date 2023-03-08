<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\transaction;
use Illuminate\Http\Request;

class transactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $transaction = transaction::where('date', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('staff_Id', 'LIKE', "%$keyword%")
                ->orWhere('maindata_Id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $transaction = transaction::latest()->paginate($perPage);
        }

        return view('admin.transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'date' => 'required',
			'status' => 'required',
			'note' => 'required',
			'staff_Id' => 'required',
			'maindata_Id' => 'required'
		]);
        $requestData = $request->all();
        
        transaction::create($requestData);

        return redirect('admin/transaction')->with('flash_message', 'transaction added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $transaction = transaction::findOrFail($id);

        return view('admin.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $transaction = transaction::findOrFail($id);

        return view('admin.transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'date' => 'required',
			'status' => 'required',
			'note' => 'required',
			'staff_Id' => 'required',
			'maindata_Id' => 'required'
		]);
        $requestData = $request->all();
        
        $transaction = transaction::findOrFail($id);
        $transaction->update($requestData);

        return redirect('admin/transaction')->with('flash_message', 'transaction updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        transaction::destroy($id);

        return redirect('admin/transaction')->with('flash_message', 'transaction deleted!');
    }
}
