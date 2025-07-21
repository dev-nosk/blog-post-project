$(document).on('click', '.remove-barcode-btn', function () {
    const index = $(this).data('index');
    scannedParts = JSON.parse(localStorage.getItem('scannedParts'));
    updated = scannedParts.filter(item => item.index !== index);
     console.log('removed', scannedParts);
    localStorage.setItem('scannedParts', JSON.stringify(updated));
   
    updateDisplay();
    updateTableScanned()
    updateScannedData()
    
    Toastify({
        text: "Removed barcode: " + index,
        duration: 2000,
        gravity: "top",
        position: "right",
        style: { background: "#dc3545" },
        stopOnFocus: true
    }).showToast();
});