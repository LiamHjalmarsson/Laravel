const filterbtnClears = () => {
    // let filterOpen = document.getElementById("openFilters");

    // filterOpen.addEventListener("click", (e) => {
    //     document.getElementById("filtering-form").style.display = "none";
    // });

    let filterButtons = document.querySelectorAll('.relative button');

    filterButtons.forEach(button => {
        let input = button.getAttribute("data-input-name");

        button.addEventListener('click', () => {
            document.getElementById(input).value = "";

            document.getElementById('filtering-form').submit();
        });
    });
}


const settingsBtn = () => {

    let loginBtn = document.getElementById('loginSettings-btn');
    let otherDetailBtn = document.getElementById('otherSettings-btn');

    if (otherDetailBtn && loginBtn) {

        otherDetailBtn.addEventListener("click", (e) => {
            let box = document.querySelector("#otherSettings");
            
            if (box.classList.contains("active")) { 
                box.classList.remove("active");
            } else {
                box.classList.add("active");
            }
        });

        loginBtn.addEventListener("click", (e) => {
            let box = document.querySelector("#loginSettings");
            
            if (box.classList.contains("unactive")) { 
                box.classList.remove("unactive");
            } else {
                box.classList.add("unactive");
            }
        });
    }
}

filterbtnClears();
settingsBtn();