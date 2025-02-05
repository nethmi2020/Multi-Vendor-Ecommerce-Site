<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use  App\Jobs\TestJob;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $user=Auth::user();
        // // $user->removeRole('admin');
        // // $roles=$user->getRoleNames();
        // dd($user->hasRole('seller'));
        // abort('403');
        // TestJob::dispatch('hello');
        // app()->setlocale('si');
        // $user=Auth::user();
        // Auth::user()->assignRole('seller');
        // Auth::user()->removeRole('seller');
        // dd(Auth::user()->getRoleNames());
        // if(Auth::user()->hasRole('seller')){
            $categories = Category::paginate();

            return view('category.index', compact('categories'))
                ->with('i', ($request->input('page', 1) - 1) * $categories->perPage());
        // }
        // else
        // {
        //     return redirect(route('dashboard'));
        // }



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();

        return view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
      

        $path = null;
        if ($request->file('image')) {
            $path = $request->file('image')->store('category');
        }
        $category->category_image = $path;
        $category->save();

        return Redirect::route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $category = Category::find($id);

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $category = Category::find($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        // $category->update($request->validated());

        $category->name = $request->name;
        $category->description = $request->description;
      
      
        if ($request->hasFile('image')) {
            if ($category->category_image) {
                \Storage::delete($category->category_image);
            }
            $category->category_image = $request->file('image')->store('category');
        }
        $category->save();
        return Redirect::route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Category::find($id)->delete();

        return Redirect::route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
