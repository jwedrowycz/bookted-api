<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
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
    public function store(Request $request)
    {
        $data = DB::transaction(function () use ($request) {
            $book = Book::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'publish_date' => $request['publish_date'],
                'book_condition_id' => $request['book_condition_id'],
                'category_id' => $request['category_id'],
            ]);

            $auction = Auction::create([
                'price' => $request['price'],
                'user_id' => $request['user_id'], // replace with auth()->id()
                'book_id' => $book->id,
            ]);
            return ['data' => ['auction' => $auction, 'book' => $book]];
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
        //
    }
}
