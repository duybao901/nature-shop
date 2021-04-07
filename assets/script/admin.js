document.addEventListener("DOMContentLoaded", function () {
    // status control
    const statusButtons = document.querySelectorAll('.content .order__table .order__tabel-status .status__buton');
    const statusButtonsLength = statusButtons.length;

    const statusControl = document.querySelectorAll(`.status__control`);

    const statusControlItem = document.querySelectorAll('.status__control-item');
    const statusControlItemLegth = statusControlItem.length;

    // Hide status__control
    for (let i = 0; i < statusButtonsLength; i++) {
        statusButtons[i].addEventListener('click', function (e) {
            // hide when click x        
            const buttonID = e.path[0].id;
            const statusControlSibling = document.getElementById(`${buttonID}`).nextElementSibling;
            const statusControl = document.querySelectorAll(`.status__control`);
            for (let j = 0; j < statusControl.length; j++) {
                statusControl[j].style.opacity = "0";
                statusControl[j].style.visibility = "hidden";
            }
            statusControlSibling.style.opacity = "1";
            statusControlSibling.style.visibility = "visible";
        })
    }
    // Hide status__control when click x
    const statusControlClose = document.querySelectorAll(".status__control-close");
    for (let i = 0; i < statusControlClose.length; i++) {
        statusControlClose[i].addEventListener('click', function () {
            for (let j = 0; j < statusControl.length; j++) {
                statusControl[j].style.opacity = "0";
                statusControl[j].style.visibility = "hidden";
            }
        })
    }


    // Hide when clich status__control-item & switck status
    for (let i = 0; i < statusControlItemLegth; i++) {
        statusControlItem[i].addEventListener('click', function () {
            if (statusControlItem[i].dataset.status == 'delivered') {
                addText("delivered", 'status--delivery', statusControlItem[i].dataset.id);
            }
            else {
                addText("cancel", 'status--cancel', statusControlItem[i].dataset.id);
            }
            for (let j = 0; j < statusControl.length; j++) {
                statusControl[j].style.opacity = "0";
                statusControl[j].style.visibility = "hidden";
            }
        })
    }


    // switch status
    function addText(text, classes, id) {
        const node = document.getElementById(id);
        if (text == "delivered") {
            node.classList.remove("status--cancel");
            node.classList.add(classes);
        } else {
            node.classList.remove("status--delivery");
            node.classList.add(classes);
        }
        node.innerHTML = text;
    }
})

// Open Tab
document.getElementById('tabDefaultOpen').click();

function openTab(e, tab) {
    const tabButtons = document.querySelectorAll('.menu .menu__list li');
    const tabContents = document.querySelectorAll('.content__body-box');

    const tabButtonsLength = tabButtons.length;
    const tabContentLength = tabContents.length;

    for (let i = 0; i < tabButtonsLength; i++) {
        tabButtons[i].classList.remove('menu__list--active')
    }

    for (let i = 0; i < tabContentLength; i++) {
        tabContents[i].classList.remove('content__body-box--active');
    }

    e.target.classList.add('menu__list--active');
    document.getElementById(tab).classList.add('content__body-box--active')
}
