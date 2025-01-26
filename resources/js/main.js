topbar.config({
    barThickness: 6,
    barColors: {
        0: "rgba(255, 0, 0)",
        ".25": "rgba(255, 0, 0)",
        ".50": "rgba(255, 0, 0)",
        ".75": "rgba(255, 0, 0)",
        "1.0": "rgba(255, 0, 0)",
    },
});

document.addEventListener("DOMContentLoaded", function () {
    var formControlList = [].slice.call(
        document.querySelectorAll(".form-control")
    );
    formControlList.map(function (formControlElement) {
        formControlElement.addEventListener("input", function (event) {
            this.classList.remove("is-invalid");
        });
    });

    // const openWingsModal = document.getElementById("openWingsModal");
    // if (openWingsModal) {
    //     var modalInstance = new bootstrap.Modal(openWingsModal);
    //     if (modalInstance) {
    //         modalInstance.show();
    //     }
    // }

    var formSelectList = [].slice.call(
        document.querySelectorAll(".form-select")
    );
    formSelectList.map(function (formSelectElement) {
        formSelectElement.addEventListener("change", function (event) {
            this.classList.remove("is-invalid");
        });
    });

    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy",
    });

    //phone number input
    var keys = "0123456789+ ";
    var checkInputTel = function (e) {
        var key = typeof e.which == "number" ? e.which : e.keyCode;
        var start = this.selectionStart,
            end = this.selectionEnd;
        var filtered = this.value.split("").filter(filterInput);
        this.value = filtered.join("");
        var move =
            filterInput(String.fromCharCode(key)) || key == 0 || key == 8
                ? 0
                : 1;
        this.setSelectionRange(start - move, end - move);
    };
    var filterInput = function (val) {
        return keys.indexOf(val) > -1;
    };

    var phoneInputList = [].slice.call(
        document.querySelectorAll(".input-phone")
    );
    phoneInputList.map(function (phoneInputElement) {
        phoneInputElement.addEventListener("input", checkInputTel);
    });

    var menuToggle = document.querySelector("#menu-toggle");
    if (menuToggle) {
        menuToggle.addEventListener("click", function (event) {
            event.preventDefault(),
                document.querySelector("#wrapper").classList.toggle("toggled");
        });
    }
});
