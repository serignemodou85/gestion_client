        // Get the modals
        var adminModal = document.getElementById("adminModal");
        var clientModal = document.getElementById("clientModal");
        var addAdminModal = document.getElementById("addAdminModal");

        // Get the buttons that open the modals
        var adminBtn = document.getElementById("adminButton");
        var clientBtn = document.getElementById("clientButton");
        var addAdminBtn = document.getElementById("addAdminBtn");

        // Get the <span> elements that close the modals
        var adminClose = document.getElementById("adminClose");
        var clientClose = document.getElementById("clientClose");
        var addAdminClose = document.getElementById("addAdminClose");

        // When the user clicks the button, open the respective modal
        adminBtn.onclick = function() {
            adminModal.style.display = "block";
        }

        clientBtn.onclick = function() {
            clientModal.style.display = "block";
        }

        function openAddAdminModal() {
            addAdminModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        adminClose.onclick = function() {
            adminModal.style.display = "none";
        }

        clientClose.onclick = function() {
            clientModal.style.display = "none";
        }
        addAdminClose.onclick = function() {
            addAdminModal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == adminModal) {
                adminModal.style.display = "none";
            }
            if (event.target == clientModal) {
                clientModal.style.display = "none";
            }
            if (event.target == addAdminModal) {
                addAdminModal.style.display = "none";
            }
        }
