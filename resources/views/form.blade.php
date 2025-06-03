<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4">Product Entry Form</h2>

        <div id="alertContainer"></div>

        <form id="productForm" class="border p-4 bg-light rounded shadow-sm">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="product_name" required />
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity in Stock</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="0" required />
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price per Item ($)</label>
                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required />
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <hr class="my-5" />

        <h4>Submitted Products</h4>
        <div id="productTableContainer">
            <!-- Table will be populated by JavaScript -->
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/submit_product.js') }}"></script>
    <script src="{{ asset('js/fetch_products.js') }}"></script>
</body>

</html>