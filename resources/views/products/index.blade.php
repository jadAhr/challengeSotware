
<style>


    *{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        list-style: none;
        font-size: 20px;
    }
    #products{
        display: grid;
        grid-template-columns: auto auto auto;
        width: 1200px;
        row-gap: 50px;
        place-items: center;
        
    }
    #body{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: start;
        align-items: center;
        flex-direction: column;
        
    }


    img{
    width: 300px;

    }

    #infos{
        text-align: start;
    }
    
    #add_filter{
        display: flex;
        column-gap: 10px;
        height: 45px;
    }


</style>

<div id="body">
<div id="add_filter">
<form method="GET">
    <select name="category">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <select name="sort_by_price">
        <option value="asc">Price (Low to High)</option>
        <option value="desc">Price (High to Low)</option>
    </select>

    <button type="submit">Filter</button>
    
</form>
<a href="{{ route('products.create') }}">
    <button id="addProduct">Add</button>
</a>



</div>
<ul id="products">
   
@foreach ($products as $product)

            <li>
            <img  src="{{ url('storage/'.$product->image) }}" alt="Product Image">
            <div id="infos">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }} Dhs</p>
            </div>
            </li>
@endforeach

</ul>
</div>






