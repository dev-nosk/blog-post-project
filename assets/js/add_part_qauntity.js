$(document).on('click', '.add-part', function () {
    let barcode = $(this).data('barcode')
    async function showSaveAlert() {
        const { value: quantity } = await Swal.fire({
            title: "Edit Quantity",
            input: "text",
            inputLabel: "Enter quantity",
            inputValue: "",
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "You need to enter a quantity!";
                }
            }
        });

        if (quantity) {
            scannedParts = JSON.parse(localStorage.getItem('scannedParts') || '[]');
            // Find the first matching item by barcode
            let firstMatch = scannedParts.find(item => item.barcode == barcode);
            if (firstMatch.isValid == 0) {
                Toastify({
                    text: "cant add invalid parts",
                    duration: 2000,
                    gravity: "top",
                    position: "right",
                    style: { background: "#dc3545" },
                    stopOnFocus: true
                }).showToast();
                return false;
            }
            if (firstMatch) {
                // Remove all items with this barcode
                scannedParts = scannedParts.filter(item => item.barcode != barcode);
                // Find the current max index in scannedParts
                let maxIndex = scannedParts.length > 0 ? Math.max(...scannedParts.map(item => item.index || 0)) : 0;
                // Insert new items with unique index and updated date
                for (let j = 0; j < Number(quantity); j++) {
                    let newItem = Object.assign({}, firstMatch);
                    newItem.index = maxIndex + 1 + j;
                    newItem.date = new Date().toISOString();
                    scannedParts.push(newItem);
                }
            }
            localStorage.setItem('scannedParts', JSON.stringify(scannedParts));
            updateDisplay();
            updateTableScanned()
            updateScannedData()
        }
    }

    showSaveAlert()
})
