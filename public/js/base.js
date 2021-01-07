// toast
function toast({
    title = '',
    message = '',
    type = 'info',
    duration = 3000,
}){
    const main = document.getElementById('toast');
    if(main){
        const toast = document.createElement('div');
        toast.onclick = function(e){
            if(e.target.closest('.toast__close')){
                main.removeChild(toast);
            }
        };
        const icons = {
            success: 'fas fa-check-circle',
            info: 'fas fa-info-circle',
            warning: 'fas fa-exclamation-circle',
            error: 'fas fa-exclamation-circle',
        }
        const icon = icons[type];
        toast.classList.add('toast', `toast--${type}`);
        toast.innerHTML = `
        <div class="toast__icon">
            <i class="${icon}"></i>
        </div>
        <div class="toast__body">
            <h3 class="toast__title">${title}</h3>
            <p class="toast__message">${message}</p>
        </div>
        <div class="toast__close">
            <i class="fas fa-times"></i>
        </div>
        `;
        main.appendChild(toast);
    }
}

//post function
async function postData(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'Content-Type': 'application/json',
            // 'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    if (response.redirected) {
        window.location.href = response.url;
    }
    return response.json(); // parses JSON response into native JavaScript objects
}

//get parent element
function getParent(element, selector) {
    while(element.parentElement){
        if (element.parentElement.matches(selector)){
            return element.parentElement;
        }
        element = element.parentElement;
    }
}

//update cart item count
function updateCart(options){
    const {diff, quantity} = options
    let cartCountElement = document.querySelector('.header__cart-count');
    if(diff === 0){
        cartCountElement.innerHTML = quantity;
    } else {
        cartCountElement.innerHTML = parseInt(cartCountElement.innerHTML) + diff;
    }
}