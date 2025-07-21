
function loading(loadingText) {
    $('body').append('<div id="blur-overlay" style="position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(255,255,255,0.7);z-index:9999;backdrop-filter:blur(3px);display:flex;align-items:center;justify-content:center;"><span style="font-size:1.5em;">' + loadingText + ' ...</span></div>');
}

function removeLoading() {
    $('#blur-overlay').remove();
}

function successAlert(message) {
    Toastify({
        text: message,
        duration: 2000,
        gravity: "bottom",
        position: "right",
        style: { background: "#27ae60" }, // green for success
        stopOnFocus: true
    }).showToast();
}

function errorAlert(message) {
    Toastify({
        text: message,
        duration: 3000,
        gravity: "bottom",
        position: "right",
        style: { background: "#e74c3c" }, // red for error
        stopOnFocus: true
    }).showToast();
}

function warningAlert(message) {
    Toastify({
        text: message,
        duration: 2500,
        gravity: "bottom",
        position: "right",
        style: { background: "#f39c12" }, // orange for warning
        stopOnFocus: true
    }).showToast();
}

function updateScannedData() {
    let scanned_data = JSON.parse(localStorage.getItem('scannedParts')) || [];
    let row = '';
    scanned_data.forEach((item, index) => {
        row += `<tr class="scanned-row color-new">
                    <td>${item.index}</td>
                    <td>${item.barcode}</td>
                    <td>${item.partname}</td>
                    <td>${item.date}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-barcode-btn" data-index="${item.index}">Remove</button>
                    </td>
                </tr>`;
    });
    if ($('#scannedListTable').length === 0) {
        $('#scannedList').html(`
                                    <table class="table table-bordered table-sm" id="scannedListTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Barcode</th>
                                                 <th>Part Name</th>
                                                <th>Scanned Date/Time</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${row}
                                        </tbody>
                                    </table>
                                `);
    } else {
        $('#scannedListTable tbody').html(row);
    }
}

function updateTableScanned() {
    scanned_data = JSON.parse(localStorage.getItem('scannedParts'));
    if (!scanned_data || !Array.isArray(scanned_data)) scanned_data = [];

    const partMap = {};
    scanned_data.forEach(item => {
        if (!partMap[item.barcode]) {
            partMap[item.barcode] = {
                barcode: item.barcode,
                partname: item.partname,
                quantity: 1
            };
        } else {
            partMap[item.barcode].quantity += 1;
        }
    });

    let tableHtml = `
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>PartsCode</th>
                    <th>Part name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    `;
    Object.values(partMap).forEach(part => {
        tableHtml += `
            <tr>
            <td>${part.barcode}</td>
            <td>${part.partname}</td>
            <td>
                ${part.quantity}
                <button style="float:right" class="btn btn-success btn-sm add-part" disabled="${part.isValid == 0 ? true : false}" data-barcode="${part.barcode}">
                    edit
                </button>
            </td>
            <td>
                <button class="btn btn-danger btn-sm remove-part" data-barcode="${part.barcode}">
                remove  
                </button>
            </td>
            </tr>
        `;
    });
    tableHtml += `
            </tbody>
        </table>
    `;
    $('#view-quantity').html(tableHtml);

    // Optional: attach event for remove button
    $('.remove-part').on('click', function () {
        const barcode = $(this).data('barcode');
        console.log('barcode', barcode);
        let scannedParts = JSON.parse(localStorage.getItem('scannedParts')) || [];
        console.log('all data', scannedParts);
        let removed_d = scannedParts.filter(item => item.barcode != barcode);
        console.log('removed', removed_d);
        localStorage.setItem('scannedParts', JSON.stringify(removed_d));
        updateTableScanned();
        updateDisplay();
        updateScannedData()
    });
    // $('#view-quantity').text('updating')
}

function updateDisplay() {
    scannedParts = JSON.parse(localStorage.getItem('scannedParts') || '[]');
    var pdata = JSON.stringify(scannedParts, null, 2)
    $('#object-total').text(' ' + scannedParts.length + ' Total Data')
    $('#dataDisplay').text(pdata);
}

function getMyList(action = 0) {
    // 0 get only first session load
    // 1 set the session to [] and get the data to databae with reload animation
    // 2 set the session to [] and get the data to databae (this is for inserting data to load the data in MY list)
    if (action == 1) {
        loading('updating your list');
    }
    $('#my-list-body').html(`<tr><td colspan="7"><center>updating your list...</center></td></tr>`)
    $.ajax({
        url: 'get-my-list/' + action,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (action == 1) {
                setTimeout(function () {
                    removeLoading();
                }, 2000)
            }
            let data = response.list_data;
            let tr = '';
            $.each(data, function (k, v) {
                tr += `<tr>
                                <td>${v.BranchCode}</td>
                                <td>${v.PartNumber == 0 ? v.PartRef : v.PartNumber}</td>
                                <td>${v.PartDescription}</td>
                                <td>${v.Price}</td>
                                <td>${v.Supplier}</td>
                                <td>${v.AccountedQty}</td>
                                <td>${v.LastScannedDate}</td>
                          </tr>`;
            })

            $('#my-list-body').html(tr)
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to get list. Please reload the page'
            });
        }
    });
}

function updateParts(month = 0) {
    // Add blur and loading overlay
    loading('Updating, please wait');
    $.ajax({
        url: 'update-parts/' + month,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log('res')
            // $('#blur-overlay').remove();
            if (response.status == 'success') {
                localStorage.setItem('partList', JSON.stringify(response.data));
                successAlert('Parts list updated successfully!');
            } else {
                errorAlert('Failed to update parts list.Please check your connection');
            }
            removeLoading();
        },
        error: function (xhr, status, error) {
            removeLoading();
            console.error('AJAX error:', error);
            alert('An error occurred while updating. Please check your connection');
        }

    });
}

function generateBranch(branchCode, btn) {
    loading('Generating, please wait');
    $.ajax({
        url: 'generate-branch',
        type: 'POST',
        dataType: 'json',
        data: {
            branch: branchCode
        },
        success: function (response) {
            removeLoading();
            console.log(response.status == true);
            if (response.status == true) {
                successAlert(response.message)
                // $(btn).parent().html('Branch Ready');
                updateParts();
            }
            else {
                errorAlert(response.message)
            }
        },
        error: function (xhr, status, error) {
            removeLoading();
            console.error('AJAX error:', error);
            alert('An error occurred while updating. Please check your connection');
        }
    });
}

function checkConnection() {
    $.ajax({
        url: 'check-connection',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response == true) {
                $('#set-connected').html(`<span style="color:green">Online</span>`)
            } else {
                $('#set-connected').html(`<span style="color:red">Offline Mode</span>`)
            }
        },
        error: function (xhr, status, error) {
            $('#set-connected').html(`<span style="color:red">Offline Mode</span>`)
        }
    });
}

function getListPartsByBranch(branch, month) {
    if ($.fn.DataTable.isDataTable('#materialsTable')) {
        $('#materialsTable').DataTable().clear().destroy();
    }

    table = $('#materialsTable').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
            url: 'get-parts-by-branch',
            type: 'POST',
            data: {
                branch_code: branch,
                month: month
            }
        },
        columns: [
            { data: 'id' },
            { data: 'BranchName' },
            { data: 'PartNumber' },
            { data: 'PartDescription' },
            { data: 'Price' },
            { data: 'Supplier' },
            { data: 'SystemCount' },
            { data: 'AccountedQty' },
            { data: 'MissingQty' },
            { data: 'DamagedQty' },
            { data: 'SoldQty' },
            { data: 'OthersQty' },
            { data: 'Remarks' }
        ],
        responsive: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        language: {
            emptyTable: "🚫 no data found please generate branch first",
            zeroRecords: "🔍 No matching parts found.",
            // processing: "<span class='spinner-border spinner-border-sm'></span> Loading..."
        }
    });




    //  $.ajax({
    //         url: 'get-parts-by-branch/'+branch,
    //         type: 'POST',
    //         dataType: 'json',
    //         success: function (response) {
    //             $.each(response.parts,function(k,v){

    //             })

    //             $('#parts-table-body').html('tr');
    //         },
    //         error: function (xhr, status, error) {
    //             $('#set-connected').html(`<span style="color:red">Disconnected to server</span>`)
    //         }
    //     });
}

// function getBranchByMonth(monthCode){
//  if ($.fn.DataTable.isDataTable('#materialsTable')) {
//         $('#materialsTable').DataTable().clear().destroy();
//     }

//     table = $('#materialsTable').DataTable({
//         processing: true,
//         serverSide: true,
//         deferRender: true,
//         ajax: {
//             url: 'get-branches-by-month',
//             type: 'POST',
//             data: {
//                 month_code: monthCode
//             }
//         },
//         columns: [
//             { data: 'id' },
//             { data: 'BranchName' },
//             { data: 'PartNumber' },
//             { data: 'PartDescription' },
//         ],
//         responsive: true,
//         pageLength: 10,
//         lengthMenu: [10, 25, 50, 100],
//         ordering: true,
//         language: {
//             emptyTable: "🚫 no data found please generate branch first",
//             zeroRecords: "🔍 No matching parts found.",
//             // processing: "<span class='spinner-border spinner-border-sm'></span> Loading..."
//         }
//     });
// }


/// load call 
checkConnection();
getMyList();
$(document).on('click', '#update-my-list', function () {
    getMyList(1);
})

// $(document).on('click', '.generate-branch-parts', function () {
//     let branchCode = $(this).data('branch');
//     if (confirm('This will take time to generate branch')) {
//         let btn = $(this)
//         generateBranch(branchCode, btn);
//     }
// })

$(document).on('click', '#transmit-data', function () {
    loading('Transmitting, please wait');
    if (confirm('Are you sure you want to transfer this data?')) {
        $.ajax({
            url: 'transmit-data',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                removeLoading();
                console.log(response.status == true);
                if (response.status == true) {
                    successAlert(response.message);
                    getMyList(2);
                }
                else {
                    errorAlert(response.message)
                }
            },
            error: function (xhr, status, error) {
                removeLoading();
                console.error('AJAX error:', error);
                alert('An error occurred while updating. Please check your connection');
            }
        });
    } else {
        return false;
    }
})


$(document).on('click', '#generate-branch-parts', function () {
    let branch = $('#branch-select').val();

    if (branch == null) {
        errorAlert('Please select branch');
        return;
    }
    if (confirm('This will take time to generate branch')) {
        let btn = $(this)
        generateBranch(branch, btn);
    }

})

