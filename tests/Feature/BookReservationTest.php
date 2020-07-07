<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_libary()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Laravel TDD',
            'author' => 'Ian Schinder'
        ]);
        
        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'authour' => 'Ian Schinder'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Laravel TDD',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => 'Laravel TDD',
            'author' => 'Ian Schinder'
        ]);
        
        $book = Book::first();
        $response = $this->patch("/books/$book->id", [
            'title' => 'New updated title',
            'author' => 'New updated author'
        ]);
        
        $this->assertEquals('New updated title', Book::first()->title);
        $this->assertEquals('New updated author', Book::first()->author);
    }
}
