<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use Exception;
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
        $obj->category_id = (int)$r->subcat;
        $obj->created_id = auth()->id();
        $obj->created_by = 'administrator';
        
        try {
            $obj->save();
        } catch (Exception $e) {
            //
        }

        return redirect()->route('administrator.businesses_add')->with('success', 'Business created successfully');
    }

    public function business_list()
    {
        $business = Business::where('is_active', 1)
            ->where('deleted_at', null)
            ->with(['category', 'user','administrator'])
            ->orderBy('id', 'DESC')
            ->get();

        $business->filter(function($k) {
            if($k->ccreated_by == 'user')
            {
                $k->created_by = $k->user->name;
            }
        });

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

        foreach ($business as $r) {
            $html['id'] = $r->id;
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

        $category = Category::where('parent_id', null)->where('is_active', 1)->get();

        $fetch_parent_cat = Category::where('id', $html['category_id'])->where('is_active', 1)->first();

        $fetch_sub_cat = Category::where('parent_id', $fetch_parent_cat->parent_id)->where('is_active', 1)->get();

        $html['category'] = '';

        foreach ($category as $item) {

            if ($item->id == $fetch_parent_cat->parent_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }

            $html['category'] .= '<option value="' . $item->id . '"  ' . $selected . ' >' . $item->name . '</option>';
        }

        $html['sub_category'] = '';

        foreach ($fetch_sub_cat as $item) {

            if ($item->id == $fetch_parent_cat->parent_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }

            $html['sub_category'] .= '<option value="' . $item->id . '"  ' . $selected . ' >' . $item->name . '</option>';
        }

        echo json_encode($html);
    }

    public function business_update(Request $r)
    {
        $id = $r->business_id;

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

        $obj = Business::find($id);

        $obj->name = $r->business_name;
        $obj->slug  = Str::slug($r->business_slug, '_');
        $obj->about  = $r->business_about;
        $obj->website  = $r->business_website;
        $obj->service_form = $r->business_service_form;
        $obj->service_to = $r->business_service_to;
        $obj->category_id = $r->subcat;
        $obj->user_id = auth()->user()->id;
        $obj->update();

        return redirect()->route('administrator.business_list')->with('success', 'Business updated successfully');
    }
}
