document
    .getElementById("productForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        const alertContainer = document.getElementById("alertContainer");
        const formData = new FormData(this);

        try {
            const response = await fetch("/submit", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: formData,
            });

            const data = await response.json();
            const isSuccess = data.success;

            alertContainer.innerHTML = `
            <div class="alert alert-${
                isSuccess ? "success" : "danger"
            } alert-dismissible fade show" role="alert">
                ${
                    isSuccess
                        ? "Product submitted successfully."
                        : "Failed to submit product."
                }
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

            if (isSuccess) this.reset();
        } catch (err) {
            alertContainer.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                An error occurred: ${err.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        }
    });
