<!-- Polls the component every 5 seconds to refresh data and manages the modal open/close state -->
<div wire:poll.5s x-data="{ isOpen: @entangle('isModalOpen') }">
    <!-- Button to open the modal for adding a new book -->
    <button @click="isOpen = true; @this.set('isModalOpen', true)" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-3 ml-5 mt-5 transition duration-300">Add New Book</button>
  <!-- Modal that appears when 'isOpen' is true, with a fade transition effect -->
    <div x-cloak x-show="isOpen" x-transition:opacity.duration.500ms class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center" tabindex="-1">
        <div class="bg-white rounded-lg w-1/2">
            <div class="">
                <div class="bg-gray-200 p-3 flex justify-between items-center rounded-t-lg">
                   <!-- Displays 'Edit Book' if editing an existing book, otherwise 'Add New Book' -->
                    <h5 class="text-lg font-semibold">{{ $editingBookId ? 'Edit Book' : 'Add New Book' }}</h5>
                    <!-- Button to close the modal, changes color on hover for better user interaction -->
                    <button type="button" class="text-gray-700 hover:text-gray-900 transition duration-300" @click="isOpen = false; @this.set('isModalOpen', false)" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-5">
                  <!-- Submits the form to 'updateBook' if editing, otherwise to 'saveBook' -->
                    <form wire:submit="{{ $editingBookId ? 'updateBook' : 'saveBook' }}">
                        <!-- Title Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input type="text" class="w-full p-2 border rounded" wire:model="bookForm.title">
                            @error('bookForm.title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <!-- Author Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Author</label>
                            <input type="text" class="w-full p-2 border rounded" wire:model="bookForm.author">
                            @error('bookForm.author') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <!-- Genre Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Genre</label>
                            <input type="text" class="w-full p-2 border rounded" wire:model="bookForm.genre">
                            @error('bookForm.genre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <!-- Published Date Field -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Published Date</label>
                            <input type="date" class="w-full p-2 border rounded" wire:model="bookForm.published_date">
                            @error('bookForm.published_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition duration-300">
                            {{ $editingBookId ? 'Update' : 'Add' }} Book
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Display Message After CRUD Operations -->
    @if (session()->has('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-3" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <!-- Books Table -->
    <table class="min-w-full bg-white mt-4 shadow-md rounded-lg">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-left">Title</th>
                <th class="py-2 px-4 border-b text-left">Author</th>
                <th class="py-2 px-4 border-b text-left">Genre</th>
                <th class="py-2 px-4 border-b text-left">Published Date</th>
                <th class="py-2 px-4 border-b text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                <td class="py-2 px-4 border-b">{{ $book->genre }}</td>
                <td class="py-2 px-4 border-b">{{ $book->published_date }}</td>
                <td class="py-2 px-4 border-b flex space-x-2">
                    <button wire:click="editBook({{ $book->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                    <button wire:click="deleteBook({{ $book->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>