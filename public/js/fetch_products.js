function loadProductTable() {
    fetch("/products")
        .then((res) => res.json())
        .then((products) => {
            if (!Array.isArray(products)) return;

            products.sort(
                (a, b) => new Date(b.datetime) - new Date(a.datetime)
            );

            let rows = "";
            let totalSum = 0;

            products.forEach((p, i) => {
                const total = p.quantity * p.price;
                totalSum += total;

                rows += `
                    <tr>
                        <td>${p.product_name}</td>
                        <td>${p.quantity}</td>
                        <td>$ ${p.price}</td>
                        <td>${p.datetime}</td>
                        <td>$${total.toFixed(2)}</td>
                        <td>
                            <a href="/edit?index=${i}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>`;
            });

            rows += `
                <tr class="fw-bold">
                    <td colspan="4">Total</td>
                    <td>$${totalSum.toFixed(2)}</td>
                    <td></td>
                </tr>`;

            document.getElementById("productTableContainer").innerHTML = `
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price (USD)</th>
                            <th>Datetime</th>
                            <th>Total Value</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>`;
        });
}

loadProductTable();
