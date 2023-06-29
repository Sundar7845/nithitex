<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
	use Utils;

	public function CategoryView()
	{
		$categories = Category::orderBy('id', 'ASC')->get();
		if ($this->checkUserPermission(Auth::user()->hasPermissionTo('Categories'), Auth::user()->id)) {
			return view('backend.category.category_view', compact('categories'));
		} else {
			return view('401');
		}
	}

	public function CategoryStore(Request $request)
	{
		$request->validate([
			'category' => 'required|min:4|max:100',
			'category_image' => 'image|mimes:jpeg,jpg,png,webp|min:1|max:2000'
		]);

		$image = $request->file('category_image');
		$name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
		Image::make($image)->save('upload/products/category/' . $name_gen);
		$save_url = 'upload/products/category/' . $name_gen;

		Category::create([
			'category_name' => $request->category,
			'category_slug' => strtolower(str_replace(' ', '-', $request->category)),
			'category_description' => $request->category_description,
			'category_image' => $save_url
		]);

		$notification = array(
			'message' => 'Category Created Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
	}

	public function CategoryEdit($id)
	{
		$categories = Category::findOrFail($id);
		if ($this->checkUserPermission(Auth::user()->hasPermissionTo('Categories'), Auth::user()->id)) {
			return view('backend.category.category_edit', compact('categories'));
		} else {
			return view('401');
		}
	}

	public function CategoryUpdate(Request $request)
	{
		$request->validate([
			'category' => 'required',
			'category_image' => 'image|mimes:jpeg,jpg,png,webp|min:1|max:2000'
		]);
		$category_id = $request->id;
		$oldImage = $request->old_image;

		$category = Category::find($category_id);
		$category->category_name = $request->category;
		$category->category_slug = strtolower(str_replace(' ', '-', $request->category));
		$category->category_description = $request->category_description;


		if ($request->file('category_image')) {
			@unlink($oldImage);
			$image = $request->file('category_image');
			$name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
			Image::make($image)->save('upload/products/category/' . $name_gen);
			$save_url = 'upload/products/category/' . $name_gen;
			$category->category_image = $save_url;
		}
		$category->save();

		$notification = array(
			'message' => 'Category Updated Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('category.all')->with($notification);
	}

	public function CategoryDelete($id)
	{
		$product = Product::where('category_id', $id)->get()->count();
		if ($product == 0) {
			$category = Category::findOrFail($id);
			$category->delete();

			$notification = array(
				'message' => 'Category Deleted Successfully',
				'alert-type' => 'success'
			);
		} else {
			$notification = array(
				'message' => 'Delete Failed!. This category is reference with another instance.',
				'alert-type' => 'error'
			);
		}
		return redirect()->back()->with($notification);
	}
}
