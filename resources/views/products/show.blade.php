<x-layout>
    <x-slot:title>
        Show a product
    </x-slot>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>{{ $product->name }}</h1>
    <h4>Quantity: {{ $product->quantity }}</h4>
    <p>{{ $product->description }}</p>

    <a href="{{ route('products.edit', $product) }}">Edit</a>
    <form action="{{ route('products.destroy', $product) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">

        <h3>Tags</h3>
        <div id="tag-container"></div>


    </form>
    <div>
        <input type="text" id="tag-input" placeholder="Add new tag..." autocomplete="off">
    </div>
    <ul id="list"></ul>
    <input type="hidden" name="tags" id="tags-hidden">
</x-layout>