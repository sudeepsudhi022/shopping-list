<!-- resources/views/shoppinglist.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Shopping List</title>
</head>
<style>
    body{
        margin: 0%;
        padding: 0%;
        box-sizing: border-box;
        background: black;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%;
        color: #fff;
        font-size: 20px;
        text-align: center;
    }
    form{
        width: 60%;
        height: 100%;
        /* background: blue; */
        margin: 20px auto;
        text-align: center;
        font-size: 20px;
        color: #fff;
        padding: 20px;
    }
    input{
        width: 80%;
        height: 35px;
        margin: 10px auto;
        border: none;
        border-radius: 20px;
        font-size: 16px;
        padding: 10px;
    }
    button{
        width: 20%;
        height: 35px;
        margin: 10px auto;
        font-size: 20px;
        color: #fff;
        background: linear-gradient(45deg , black , rgb(181, 32, 189) );
        border: none;
        border-radius: 10px 5px 20px 0px;
        box-shadow: 2px 2px 10px 1px #fff;
    }

</style>
<body>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('shopping.calculate') }}" method="post">
        @csrf
        <div id="products-container">
            <h1>Shopping-list</h1>
            <div class="product">
                <label for="product_name">Product Name:</label>
                <input type="text" name="products[0][name]" required>
                <label for="product_price">Product Price:</label>
                <input type="number" name="products[0][price]" step="0.01" required>
            </div>
        </div>
        <button type="button" id="add_product">Add Product</button>
        <br>
        <button type="submit">Calculate</button>
    </form>

    @isset($totalCost)
        <p>Total Price: {{ $totalCost }}</p>
    @endisset

    @isset($maxProduct)
        <p>Highest Price: {{ $maxProduct['name'] }} - {{ $maxProduct['price'] }}</p>
    @endisset

    @isset($minProduct)
        <p>Lowest Price: {{ $minProduct['name'] }} - {{ $minProduct['price'] }}</p>
    @endisset

    <script>
        document.getElementById('add_product').addEventListener('click', function() {
            var productsContainer = document.getElementById('products-container');
            var productCount = productsContainer.getElementsByClassName('product').length;

            var newProduct = document.createElement('div');
            newProduct.classList.add('product');
            newProduct.innerHTML = `
                <label for="product_name">Product Name:</label>
                <input type="text" name="products[${productCount}][name]" required>
                <label for="product_price">Product Price:</label>
                <input type="number" name="products[${productCount}][price]" step="0.01" required>
            `;

            productsContainer.appendChild(newProduct);
        });
    </script>

</body>
</html>
