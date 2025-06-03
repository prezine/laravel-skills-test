<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Product</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4">Product Entry Form</h2>

        <div id="alertContainer"></div>

        <form id="productForm" class="border p-4 bg-light rounded shadow-sm">
            <input type="hidden" id="productIndex" name="index" />

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

            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
        </form>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/edit_product.js') }}"></script>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const editIndex = urlParams.get('index');

        if (editIndex !== null) {
            fetch('/products')
                .then(res => res.json())
                .then(products => {
                    const product = products[editIndex];
                    if (product) {
                        document.getElementById('productIndex').value = editIndex;
                        document.getElementById('productName').value = product.product_name;
                        document.getElementById('quantity').value = product.quantity;
                        document.getElementById('price').value = product.price;
                        document.getElementById('submitBtn').innerText = 'Update';
                    }
                });
        }
    </script>
</body>

</html>