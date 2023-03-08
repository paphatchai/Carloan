<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\cartype;
use Illuminate\Http\Request;

class cartypeController extends Controller
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
            $cartype = cartype::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $cartype = cartype::latest()->paginate($perPage);
        }

        return view('admin.cartype.index', compact('cartype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.cartype.create');
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        cartype::create($requestData);

        return redirect('admin/cartype')->with('flash_message', 'cartype added!');
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
        $cartype = cartype::findOrFail($id);

        return view('admin.cartype.show', compact('cartype'));
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
        $cartype = cartype::findOrFail($id);

        return view('admin.cartype.edit', compact('cartype'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $cartype = cartype::findOrFail($id);
        $cartype->update($requestData);

        return redirect('admin/cartype')->with('flash_message', 'cartype updated!');
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
        cartype::destroy($id);

        return redirect('admin/cartype')->with('flash_message', 'cartype deleted!');
    }
}
