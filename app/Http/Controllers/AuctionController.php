<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuctionBookRequest;
use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    function __construct() {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AuctionResource::collection(
            Auction::with('user', 'images', 'book', 'book.bookCondition', 'book.category')->latest()->paginate(50)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuctionBookRequest $request)
    {
        $validated = $request->validated();
        $data = DB::transaction(function () use ($validated) {
            
            $auction = Auction::create([
                'price' => $validated['price'],
                'user_id' => auth()->id(),
            ]);

            $book = Book::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'publish_date' => $validated['publish_date'],
                'book_condition_id' => $validated['book_condition_id'],
                'category_id' => $validated['category_id'],
                'auction_id' => $auction->id,
            ]);

            $images = [];
            if(isset($validated['images'])){
                foreach ($validated['images'] as $key=>$file) {
                    $filename = $file->store('images');
                    $images[] = Image::create([
                        'auction_id' => $auction->id,
                        'filename' => $filename
                    ]);
                }
                
            }
            return ['data' => ['auction' => $auction, 'book' => $book, 'images' => $images]];
        });
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AuctionResource(Auction::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auction = Auction::where('id', $id)->first();
        abort_if($auction->user_id !== auth()->id(), 403);

        $auction->delete();

        return response()->json(null, 204);
    }
}
