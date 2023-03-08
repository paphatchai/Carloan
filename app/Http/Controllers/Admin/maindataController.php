<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\maindatum;
use Illuminate\Http\Request;

class maindataController extends Controller
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
            $maindata = maindatum::where('code', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('tel', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('generation', 'LIKE', "%$keyword%")
                ->orWhere('color', 'LIKE', "%$keyword%")
                ->orWhere('licenseplate', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('percent', 'LIKE', "%$keyword%")
                ->orWhere('interest', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $maindata = maindatum::latest()->paginate($perPage);
        }

        return view('admin.maindata.index', compact('maindata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.maindata.create');
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
			'code' => 'required',
			'date' => 'required',
			'name' => 'required',
			'tel' => 'required',
			'type' => 'required',
			'description' => 'required',
			'generation' => 'required',
			'color' => 'required',
			'licenseplate' => 'required',
			'amount' => 'required',
			'percent' => 'required',
			'interest' => 'required',
			'image' => 'required'
		]);
        $requestData = $request->all();
        
        maindatum::create($requestData);

        return redirect('admin/maindata')->with('flash_message', 'maindatum added!');
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
        $maindatum = maindatum::findOrFail($id);

        return view('admin.maindata.show', compact('maindatum'));
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
        $maindatum = maindatum::findOrFail($id);

        return view('admin.maindata.edit', compact('maindatum'));
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
			'code' => 'required',
			'date' => 'required',
			'name' => 'required',
			'tel' => 'required',
			'type' => 'required',
			'description' => 'required',
			'generation' => 'required',
			'color' => 'required',
			'licenseplate' => 'required',
			'amount' => 'required',
			'percent' => 'required',
			'interest' => 'required',
			'image' => 'required'
		]);
        $requestData = $request->all();
        
        $maindatum = maindatum::findOrFail($id);
        $maindatum->update($requestData);

        return redirect('admin/maindata')->with('flash_message', 'maindatum updated!');
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
        maindatum::destroy($id);

        return redirect('admin/maindata')->with('flash_message', 'maindatum deleted!');
    }
}
