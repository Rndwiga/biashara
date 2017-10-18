<?php

namespace Tyondo\Biashara\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tyondo\Biashara\Helpers\Cart;
use Tyondo\Biashara\Models\Items;
use Illuminate\Http\Request;


class ItemsController extends Controller
{

    public $shoppingCart;
    public $cartSession;
    public function __construct(Cart $cart)
    {
        $this->shoppingCart = $cart;

        if (!(session()->exists('cart'))) {
            session()->put('cart');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return session('cart');


        $data = [
            'products' => $this->shoppingCart->getCart(),
            'session_dt' => \session('cart')
        ];
        //session()->push('cart.items', $data);
        echo '<pre>';
        //print_r(json_decode(session('cart'))->product);
       // print_r(session('cart')[0][0]['product']);
        print_r($data);
        echo '</pre>';
    }
    public function cart(Request $request){
       // print_r($request->all());

        //$cart = new cart();
        $action = strip_tags($request->input('action'));
        switch ($action) {
            case "add":
                $this->shoppingCart->addToCart($request->input('id'));
                break;
            case "remove":
                $this->shoppingCart->removeFromCart();
                break;
            case "empty":
                $this->shoppingCart->emptyCart();
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('biashara.views.v1.pages.products.create'),compact('orders','tags','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * {"_token":"Z4GNNLBJ1yoy7Zkmg5XQsTXYvypKyIKKNzT7Qgnz",
         * "item_name":null,"item_description":null,"item_summary":null,
         * "item_type":"machinery","item_price":"45","item_quantity":"45",
         * "item_quantity_unit":"hour","item_status":"published","featured_content":null,"featured_image":null}
         * */

       // return $request->all();
        $postData = [
            //'user_id' => Auth::user()->id,
            'user_id' => 1,
            'item_name' => $request->input('item_name'),
            'slug' => str_slug($request->input('item_name')) .'-'.time(),
            'item_summary' => $request->input('item_summary'),
            'item_description' => $request->input('item_description'),
            'item_status' => $request->input('item_status'),
            'featured_image' => $request->input('featured_image'),
            'item_price' => $request->input('item_price'),
            'item_quantity' => $request->input('item_quantity'),
            'item_quantity_unit' => $request->input('item_quantity_unit'),
        ];
        //add validation

        if ($request->input('item_type')){
            $postData['item_type'] = $request->input('item_type');
        }
        if ($request->input('featured_content')){
            $postData['featured_content'] = $request->input('featured_content');
        }


        // return $postData;
        //return $request->get('tags', []);
        $post = Items::create($postData);
        //$post->syncTags($request->get('tags', []));

        //  return $postData;


        // $user->posts()->create($input);
        Session::flash('message', 'Post Created');
        return redirect(route('biashara.item.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items)
    {

        $input = $request->all();
        //return $input;
        $post = Items::find($id);
        if($post->title != $input['title']){
            $post->title = $input['title'];
            $post->slug = str_slug($request->input('title')) .'-'.time();
        }
        $post->category_id = $input['category_id'];
        $post->post_status = $input['post_status'];
        $post->featured_content = $input['featured_content'];
        $post->post_type = $input['post_type'];
        $post->featured_image = $input['featured_image'];
        $post->summary = $input['summary'];
        $post->body = $input['body'];
        $post->save();
        $post->syncTags($request->get('tags', []));

        return redirect(route('admin.posts.manage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $items)
    {

        $post = Items::findOrFail($id);
        $post->tags()->detach();
        unlink(public_path($post->photo->file));
        $post->delete();
        Session::flash('message', 'The post has been deleted :-(');
        return redirect(route('admin.posts.manage'));
    }
}
