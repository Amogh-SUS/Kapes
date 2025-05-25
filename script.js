const products = [
    { name: "Customized T-Shirt", image: "tshirt.jpg" },
    { name: "Customized Coffee Mug", image: "mug.jpg" },
    { name: "Customized Keychain", image: "keychain.jpg" },
    { name: "Customized Mouse Pad", image: "mousepad.jpg" }
];

function handleViewButtonClick(event) {
    const productUrl = event.target.dataset.product;
    if (productUrl) {
        window.location.href = productUrl;
    } else {
        alert("Product details not available.");
    }
}

const viewButtons = document.querySelectorAll('.view');
viewButtons.forEach(button => {
    button.addEventListener('click', handleViewButtonClick);
});


        function handleCustomizeButtonClick() {
            alert("Customize button clicked!");
        }

        
        const customizeButtons = document.querySelectorAll('.customize');
        customizeButtons.forEach(button => {
            button.addEventListener('click', handleCustomizeButtonClick);
            
        });

        document.addEventListener('DOMContentLoaded', function() {
            const modeToggleButton = document.getElementById('modeToggleButton');
            const lightTheme = document.getElementById('light-theme');
            const darkTheme = document.getElementById('dark-theme');

            modeToggleButton.addEventListener('click', function() {
                lightTheme.disabled = !lightTheme.disabled;
                darkTheme.disabled = !darkTheme.disabled;
            });
        }); 



function customizeProduct() {
    const productType = document.getElementById("productType").value;
    const color = document.getElementById("color").value;
    const design = document.getElementById("design").value;
    const text = document.getElementById("text").value;

    const customizationDetails = {
        productType: productType,
        color: color,
        design: design,
        text: text
    };

    alert("Product Customized:\n\n" + JSON.stringify(customizationDetails));
}

function displayProducts() {
    const productDisplay = document.getElementById("productDisplay");
    products.forEach(product => {
        const productElement = document.createElement("div");
        productElement.classList.add("product");
        productElement.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <p>${product.name}</p>
        `;
        productDisplay.appendChild(productElement);
    });
}

window.onload = function() {
    displayProducts();
};
