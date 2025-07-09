/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Approve/Reject Modal Logic
    let selectedRequestId = null;
    let selectedRow = null;
    const approveModal = new bootstrap.Modal(document.getElementById('approveModal'));
    // Use event delegation for Approve buttons
    document.getElementById('datatablesSimple').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('approve-btn')) {
            selectedRequestId = e.target.getAttribute('data-request');
            selectedRow = e.target.closest('tr');
            approveModal.show();
        }
    });
    document.getElementById('approveRequestBtn').addEventListener('click', function() {
        approveModal.hide();
        if (selectedRow) {
            // Status is the 5th cell (index 4), flag is the 1st cell (index 0)
            selectedRow.cells[4].textContent = 'Approved';
            const flagIcon = selectedRow.cells[0].querySelector('i');
            if (flagIcon) flagIcon.style.color = '#00b300';
        }
    });
    document.getElementById('rejectRequestBtn').addEventListener('click', function() {
        approveModal.hide();
        if (selectedRow) {
            // Status is the 5th cell (index 4), flag is the 1st cell (index 0)
            selectedRow.cells[4].textContent = 'Rejected';
            const flagIcon = selectedRow.cells[0].querySelector('i');
            if (flagIcon) flagIcon.style.color = '#000';
        }
    });

});
