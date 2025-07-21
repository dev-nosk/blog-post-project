let scannerReady = false;
let barcodeBuffer = '';
localStorage.setItem('scannedParts', '[]'); // Don't overwrite on every load
let scannedParts = JSON.parse(localStorage.getItem('scannedParts') || '[]');
let lastKeyTime = Date.now();

document.addEventListener('visibilitychange', function () {
    if (document.hidden && scannerReady) {
        scannerReady = false;
        $('#status').text('❌ Scanner lost focus (tab/window changed). Please scan STARTSCAN again')
            .css('color', 'red')
            .removeClass('alert-success')
            .addClass('alert-danger')
            .fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    }
});

window.addEventListener('blur', function () {
    if (scannerReady) {
        scannerReady = false;
        $('#status').text('❌ Scanner lost focus (tab/window changed). Please scan STARTSCAN again')
            .css('color', 'red')
            .removeClass('alert-success')
            .addClass('alert-danger')
            .fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    }
});

$('.nav-link[data-tab]').on('click', function (e) {
    e.preventDefault();
    var tab = $(this).data('tab');

    if (tab !== 'scanned' && scannerReady) {
        scannerReady = false;
        $('#status').text('❌ Scanner removed from focus. Please scan STARTSCAN again').css('color', 'red').removeClass('alert-success').addClass('alert-danger')
            .fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    }
    $('.nav-link[data-tab]').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').addClass('d-none');
    $('#tab-' + tab).removeClass('d-none');
});

// $('#scannerInput').focus();
$(document).on('keydown', function (e) {
    let branch_selected = localStorage.getItem('branch_selected' || '[]');
    if (branch_selected == null) {
        errorAlert('Please select Branch first');
        return false;
    }
    $('#scannerInput').focus();
    scannedParts = JSON.parse(localStorage.getItem('scannedParts'));
    const currentTime = Date.now();
    const timeDiff = currentTime - lastKeyTime;

    lastKeyTime = currentTime;
    if (e.key.length === 1) {
        barcodeBuffer += e.key;
    }

    if (window.barcodeTimeout) clearTimeout(window.barcodeTimeout);

    window.barcodeTimeout = setTimeout(function () {
        const barcode = barcodeBuffer.trim();

        if (barcode.length > 0) {
            2
            let barcode = barcodeBuffer.replace(/-/g, '');
            if (barcode === 'STARTSCAN' || barcode === 'STARTSCAN\n' || barcode == '123') {
                if (scannerReady) {
                    $(function () {
                        Toastify({
                            text: "Scanner already ready",
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            style: { background: "#f39c12" },
                            stopOnFocus: true
                        }).showToast();
                    });
                    return false;
                }
                scannerReady = true;
                $('#status')
                    .text('✅ Scanner Ready')
                    .css('color', 'green').removeClass('alert-danger').addClass('alert-success')
                    .fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100); // simple blink animation
                $('#save-btn').attr('disabled', true);
                // scannedParts.push({barcode, date: new Date().toISOString()});
                // $('#scannedList').append(`<li>${barcode} <small>${new Date().toLocaleString()}</small></li>`);
            } else if (barcode === 'STOPSCAN' || barcode == '789') {
                scannerReady = false;
                $('#status').text('❌ Scanner stopped').css('color', 'red').removeClass('alert-success').addClass('alert-danger')
                    .fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                $('#save-btn').attr('disabled', false);
                // $('#scannerInput').focus();
                // scannedParts = []; // clear all scanned
                // $('#scannedList').empty();
            } else {
                if (scannerReady) {
                    if (/STARTSCAN|STOPSCAN/i.test(barcode)) {

                        barcodeBuffer = '';
                        return false;
                    }
                    if (barcode.length < 9) {
                        $(function () {
                            Toastify({
                                text: "Invalid barcode scanned: " + barcode,
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                style: { background: "#f13d3d" },
                                stopOnFocus: true
                            }).showToast();
                        });
                        barcodeBuffer = '';
                        return false;
                    }
                    const now = new Date();
                    // Determine next index based on max index in scannedParts
                    let index = 1;
                    if (Array.isArray(scannedParts) && scannedParts.length > 0) {
                        index = Math.max(...scannedParts.map(item => item.index || 0)) + 1;
                    }
                    var part_list = JSON.parse(localStorage.getItem('partList') || '[]');

                    // var part_list = JSON.parse(post_js.partList);

                    let partDetails = part_list.find(part => part.PartRef == barcode && part.BranchCode == branch_selected);
                    console.log(partDetails, 'partDetails');


                    let partname = (partDetails && partDetails.PartDescription) ? partDetails.PartDescription : 'Unknown Part';
                    let isValid = partDetails ? 1 : 0;
                    const barcodeObj = {
                        index: index,
                        barcode: barcode,
                        partname: partname,
                        isValid: isValid,
                        date: now.toISOString()
                    };

                    let partName = '<span class="text-muted">' + partname + '</span>';
                    scannedParts.push(barcodeObj);
                    $('.scanned-row').removeClass('color-new');
                    updateScannedData()

                    $(function () {
                        Toastify({
                            text: "Added barcode: " + barcode,
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            style: { background: "#75d982" },
                            stopOnFocus: true
                        }).showToast();
                    });
                } else {
                    scannerReady = false;
                    $('#status').text('❌ Please scan STARTSCAN barcode first ! Scanner Not Ready').css('color', 'red').removeClass('alert-success').addClass('alert-danger')
                        .fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                    // $('#save-btn').attr('disabled', true);
                    // scannedParts = []; // clear all scanned
                    // $('#scannedList').empty();
                }
            }
            localStorage.setItem('scannedParts', JSON.stringify(scannedParts));
            updateDisplay();
            updateTableScanned()
            updateScannedData()

        }
        barcodeBuffer = '';
    }, 100);
});

