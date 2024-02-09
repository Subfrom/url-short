<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUrlRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-url|edit-url|delete-url', ['only' => ['index','show']]);
        $this->middleware('permission:create-url', ['only' => ['create','store']]);
        $this->middleware('permission:delete-url', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('urls.index', ['urls' => Url::orderBy('id', 'DESC')->paginate(10), 'user' => auth()->user()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('urls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $short_url = Str::random(6);
        $request->merge(['short_url' => $short_url]);
        Url::create($request->all());

        return redirect()->route('urls.index')->with('success', 'Url created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        $user = User::find($url->user_id);

        return view('urls.show', ['url' => $url, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url, User $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url, User $user)
    {
        if($user->hasRole('Super Admin')){
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }
        
        $url->delete();
        return redirect()->route('urls.index')->with('success', 'Url deleted successfully');
    }

    public function shortenLink($shortener_url)
    {
        $find = Url::where('short_url', $shortener_url)->first();
        return redirect($find->real_url);
    }
}
