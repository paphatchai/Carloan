<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
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
            $history = History::where('maindata_id', 'LIKE', "%$keyword%")
                ->orWhere('node', 'LIKE', "%$keyword%")
                ->orWhere('action', 'LIKE', "%$keyword%")
                ->orWhere('staff_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $history = History::latest()->paginate($perPage);
        }

        return view('admin.history.index', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.history.create');
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
			'maindata_id' => 'required',
			'node' => 'required',
			'action' => 'required',
			'staff_id' => 'required'
		]);
        $requestData = $request->all();
        
        History::create($requestData);

        return redirect('admin/history')->with('flash_message', 'History added!');
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
        $history = History::findOrFail($id);

        return view('admin.history.show', compact('history'));
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
        $history = History::findOrFail($id);

        return view('admin.history.edit', compact('history'));
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
			'maindata_id' => 'required',
			'node' => 'required',
			'action' => 'required',
			'staff_id' => 'required'
		]);
        $requestData = $request->all();
        
        $history = History::findOrFail($id);
        $history->update($requestData);

        return redirect('admin/history')->with('flash_message', 'History updated!');
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
        History::destroy($id);

        return redirect('admin/history')->with('flash_message', 'History deleted!');
    }
}
