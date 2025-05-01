document.addEventListener("DOMContentLoaded", function () {
    alertify.set("notifier", "position", "top-center");
    document.querySelectorAll(".increment").forEach(function (button) {
        button.addEventListener("click", function () {
            const qtyInput = this.closest(".qtyBox").querySelector(".quantityInput");
            const prodId = this.closest(".qtyBox").querySelector(".prodId").value;
            let quantity = parseInt(qtyInput.value);

            if (!isNaN(quantity)) {
                quantity++;
                qtyInput.value = quantity;

                updateProductTotal(this, prodId, quantity);
                alertify.success("Quantity Increased!");
            }
        });
    });

    document.querySelectorAll(".decrement").forEach(function (button) {
        button.addEventListener("click", function () {
            const qtyInput = this.closest(".qtyBox").querySelector(".quantityInput");
            const prodId = this.closest(".qtyBox").querySelector(".prodId").value;
            let quantity = parseInt(qtyInput.value);

            if (!isNaN(quantity) && quantity > 1) {
                quantity--;
                qtyInput.value = quantity;

                updateProductTotal(this, prodId, quantity);
                alertify.error("Quantity Decreased!");
            }
        });
    });

    function updateProductTotal(button, prodId, quantity) {
        const row = button.closest("tr");
        const priceCell = row.querySelector("td:nth-child(3)");
        const totalPriceCell = row.querySelector("td:nth-child(5)");

        const price = parseFloat(priceCell.textContent);

        if (!isNaN(price)) {
            const totalPrice = price * quantity;
            totalPriceCell.textContent = totalPrice.toLocaleString(); 
        }

        updateSessionProduct(prodId, quantity);
    }

    function updateSessionProduct(prodId, quantity) {
        fetch("update-session.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ product_id: prodId, quantity: quantity }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    console.log("Session updated successfully");
                } else {
                    console.error("Failed to update session");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
});
