@php
$seller_url = "";
if(Auth::check()) {
    if (Auth::user()->userrole_id == 2) {
        $seller_url = "seller/";
    }
}
@endphp
<div class="sidebar-wrapper sidebar-wrapper-mrg-right">
    <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
        <h4 class="sidebar-widget-title">Categories </h4>
        <div class="shop-catigory">
            <ul>
                @php 
                    $categories_list = App\Models\Category::orderby('category_name','ASC')->get();
                @endphp
                @foreach ($categories_list as $category_view)
                <li>
                  <a href="{{ url(($seller_url == "" ? "" : $seller_url).'category/product/'.$category_view->id) }}">{{$category_view->category_name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @php 
        $tags = App\Models\Product::where('tags','!=',NULL)->groupBy('tags')->select('tags')->limit('8')->get();
        $tagscount = App\Models\Product::where('tags','!=',NULL)->get()->count();
    @endphp
    @if($tagscount > 0)
        <div class="sidebar-widget shop-sidebar-border pt-40">
            <h4 class="sidebar-widget-title">Popular Tags</h4>
            <div class="tag-wrap sidebar-widget-tag">
                @foreach ($tags as $product_tag)
                    <a href="{{url(($seller_url == "" ? "" : $seller_url).'product/tag/'.$product_tag->tags) }}">{{ str_replace(',',' ',$product_tag->tags)}}</a>
                @endforeach
            </div>
        </div>
    @endif
</div>
