<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    public function add_business()
    {
        $category = Category::where('parent_id', null)->where('is_active', 1)->get();
        return view('administrator.business.index', ['category' => $category]);
    }

    public function fetch_subcat(Request $r)
    {
        $id = $r->id;
        $html['category'] = '';

        if ($id !== null) {

            $query = Category::where('parent_id', $id)->where('is_active', 1)->get();

            if (count($query) > 0) {
                foreach ($query as $item) {

                    $html['category'] .= '<option value="' . $item->id . '">' . $item->name . '</option>';
                }
                echo json_encode($html);
            } else {
                $html['category'] .= '<option value="">Category is not selected</option>';
                echo json_encode($html);
            }
        } else {
            $html['category'] .= '<option value="">Select a category</option>';
            echo json_encode($html);
        }
    }

    public function businesse_create(Request $r)
    {
        $this->validate($r, [
            'cat' => 'required',
            'subcat' => 'required',

            'business_name' => 'required',
            'business_about' => 'required',
            'business_slug' => 'required',
            'business_website' => 'required',

            'business_service_form' => 'required',
            'business_service_to' => 'required',
        ]);

        $obj = new Business();
        $obj->name = $r->business_name;
        $obj->slug  = Str::slug($r->business_slug, '_');
        $obj->about  = $r->business_about;
        $obj->website  = $r->business_website;
        $obj->service_form = $r->business_service_form;
        $obj->service_to = $r->business_service_to;
        $obj->category_id = $r->subcat;
        $obj->user_id = auth()->user()->id;
        $obj->save();

        return redirect()->route('administrator.businesses_add')->with('success', 'Business created successfully');
    }

    public function business_list()
    {
        $business = Business::where('is_active', 1)
            ->where('deleted_at', null)
            ->with('category', 'user')
            ->get();

        return view('administrator.business.list', ['business' => $business]);
    }

    public function business_delete($id)
    {
        $del = Business::find($id);
        $obj = $del->delete();
        return redirect()->route('administrator.business_list')->with('success', 'Business deleted successfully');
    }

    public function business_edit()
    {
        $bid = $_GET['id'];

        $business = Business::where('is_active', 1)->where('id', $bid)->get();

        $category = Category::where('parent_id', null)->where('is_active', 1)->get();

        foreach ($business as $r) {

            $html['name'] = $r->name;
            $html['slug'] = $r->slug;
            $html['about'] = $r->about;
            $html['website'] = $r->website;
            $html['service_form'] = $r->service_form;
            $html['service_to'] = $r->service_to;
            $html['service_to'] = $r->service_to;
            $html['category_id'] = $r->category_id;
            $html['user_id'] = $r->user_id;
        }

        echo json_encode($html);
    }
}