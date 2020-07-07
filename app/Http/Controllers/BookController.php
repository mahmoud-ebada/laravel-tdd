<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    /**
     * 
     */
    public function store(){
        $data = request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
        Book::create($data);
    }

    /**
     * @param Book
     */
    public function update(Book $book){
        $data = request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
        $book->update($data);
    }
}
