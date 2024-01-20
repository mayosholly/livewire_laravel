<?php

namespace App\Livewire\Forms;

use App\Models\Book;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BookForm extends Form
{
        // Form properties for each field in the book form
        public $title;
        public $author;
        public $genre;
        public $published_date;
        // Defines the validation rules for the form fields
    
        protected function rules(): array
        {
            return [
                'title' => 'required', // Title is required
    
                'author' => 'required', // Author is required
    
                'genre' => 'required', // Genre is required
    
                'published_date' => 'required|date', // Published date is required and must be a valid date
            ];
        }
        // Saves the book data to the database
    
        public function save()
        {
            $this->validate(); // Validates the form data against the defined rules
            // Creates a new book record in the database with the form data
            Book::create([
                'title' => $this->title,
                'author' => $this->author,
                'genre' => $this->genre,
                'published_date' => $this->published_date,
            ]);
            return true; // Indicates successful save operation
        }
        // Resets the form fields to their default state
        public function resetForm()
        {
            $this->title = '';
            $this->author = '';
            $this->genre = '';
            $this->published_date = null;
        }
}
