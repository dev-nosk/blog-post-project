window.addEventListener('beforeunload', function (e) {
    if (scannedParts.length > 0) {
        e.preventDefault();
        e.returnValue = 'You have unsaved scanned data. Are you sure you want to leave?';
    }
});