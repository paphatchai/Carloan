<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\attachment;
use Illuminate\Http\Request;

class attachmentController extends Controller
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
            $attachment = attachment::where('maindata_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('path', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $attachment = attachment::latest()->paginate($perPage);
        }

        return view('admin.attachment.index', compact('attachment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.attachment.create');
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
			'name' => 'required',
			'path' => 'required'
		]);
        $requestData = $request->all();
        
        attachment::create($requestData);

        return redirect('admin/attachment')->with('flash_message', 'attachment added!');
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
        $attachment = attachment::findOrFail($id);

        return view('admin.attachment.show', compact('attachment'));
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
        $attachment = attachment::findOrFail($id);

        return view('admin.attachment.edit', compact('attachment'));
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
			'name' => 'required',
			'path' => 'required'
		]);
        $requestData = $request->all();
        
        $attachment = attachment::findOrFail($id);
        $attachment->update($requestData);

        return redirect('admin/attachment')->with('flash_message', 'attachment updated!');
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
        attachment::destroy($id);

        return redirect('admin/attachment')->with('flash_message', 'attachment deleted!');
    }
}
