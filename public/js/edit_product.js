document.getElementById("productForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const index = document.getElementById("productIndex").value;
    const product_name = document.getElementById("productName").value.trim();
    const quantity = parseInt(document.getElementById("quantity").value);
    const price = parseFloat(document.getElementById("price").value);

    const updatedProduct = {
        product_name,
        quantity,
        price,
    };

    fetch("/products/update/" + index, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(updatedProduct),
    })
        .then((res) => res.json())
        .then((data) => {
            let alertBox = "";
            if (data.success) {
                alertBox = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Product updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;

                setTimeout(() => {
                    window.location.href = "/form";
                }, 1500);
            } else {
                alertBox = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to update product.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
            }

            document.getElementById("alertContainer").innerHTML = alertBox;
        })
        .catch((error) => {
            document.getElementById("alertContainer").innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    An error occurred: ${error.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
        });
});
