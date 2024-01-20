<?php

namespace App\Livewire;

use App\Livewire\Forms\BookForm;
use App\Models\Book;
use Livewire\Component;

class BookComponent extends Component
{
  
    public BookForm $bookForm; // Form object for handling book data

    public $isModalOpen = false; // Controls the visibility of the modal

    public $books; // Stores the list of books

    public $editingBookId = null; // ID of the book being edited
    // Mount method - initializes the form when the component is loaded

    public function mount()

    {

        $this->bookForm = new BookForm($this, 'bookForm');

    }

    // Resets the form to its initial state

    public function resetForm()

    {

        $this->bookForm = new BookForm($this, 'bookForm');

    }

    // Opens the modal for adding or editing a book

    public function showModal()
    {
        $this->isModalOpen = true;
    }
   
    // Closes the modal and resets the editing state

    public function closeModal()

    {
        $this->isModalOpen = false;

        $this->editingBookId = null;
    }

   
    // Saves a new book to the database
    public function saveBook()
    {   // Validates the form data based on the rules defined in the BookForm
        $this->validate();
        // Check if there are any validation errors
        if (!$this->getErrorBag()->isEmpty()) {
            // Keep the modal open if there are errors
            $this->isModalOpen = true;
            return;
        }
        // Save the book data to the database
        $saved = $this->bookForm->save();
        // Check if the book was successfully saved

        if ($saved) {
            // Flash a success message to the session
            session()->flash('message', 'Book added successfully.');
            // Reset the form fields to their initial state
            $this->bookForm->resetForm();
            // Close the modal after successful save
            $this->isModalOpen = false;       
        }

    }
    // Loads a book's data into the form for editing

    public function editBook($id)
    {
        // Find the book in the database by its ID
        $book = Book::find($id);
        // Fill the book form with the data of the found book
        $this->bookForm->fill($book->toArray());
        // Set the editingBookId to the ID of the book being edited
        $this->editingBookId = $id;
        // Open the modal for editing the book
        $this->isModalOpen = true;
    }
   

    // Updates an existing book's data in the database
    public function updateBook()
    {
        // Validates the form data based on the rules defined in the BookForm
        $this->bookForm->validate();
      
        // Check if there are any validation errors
        if (!$this->getErrorBag()->isEmpty()) {
            // Keep the modal open if there are errors
            $this->isModalOpen = true;
            return;
        }
   
        // Find the book in the database using the editingBookId
        $book = Book::find($this->editingBookId);
        // Update the book record with the new form data
        $book->update($this->bookForm->toArray());
   
        // Reset the editingBookId to null after the update
        $this->editingBookId = null;
        // Flash a success message to the session
        session()->flash('message', 'Book updated successfully.');
        // Reset the form fields to their initial state
        $this->bookForm->resetForm();
        // Close the modal after successful update
        $this->isModalOpen = false;
    }
    // Deletes a book from the database

    public function deleteBook($id)
    {
        Book::find($id)->delete();
        session()->flash('message', 'Book deleted successfully.');
    }
    // Renders the component with the latest list of books
    public function render()
    {
        $this->books = Book::all();
        return view('livewire.book-component');
    }
}
